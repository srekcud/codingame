<?php

class Cell
{
    protected $index;
    protected $richness;
    protected $neighbours;

    /**
     * Get the value of index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set the value of index
     *
     * @return  self
     */
    public function setIndex( $index )
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Get the value of richness
     */
    public function getRichness()
    {
        return $this->richness;
    }

    /**
     * Set the value of richness
     *
     * @return  self
     */
    public function setRichness( $richness )
    {
        $this->richness = $richness;

        return $this;
    }

     /**
     * Get the value of neighbours
     */
    public function getNeighbours()
    {
        return $this->neighbours;
    }

    /**
     * Set the value of neighbours
     *
     * @return  self
     */
    public function setNeighbours( $neighbours )
    {
        $this->neighbours = $neighbours;

        return $this;
    }

    public function __construct( $index, $richness, $neighbours )
    {
        $this->setIndex( $index );
        $this->setRichness( $richness );
        $this->setNeighbours ( $neighbours );
    }
}

class Tree
{
    protected $index;
    protected $dormant;
    protected $size;

    /**
     * Get the value of index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set the value of index
     *
     * @return  self
     */
    public function setIndex( $index )
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Get the value of dormant
     */
    public function getDormant()
    {
        return $this->dormant;
    }

    /**
     * Set the value of dormant
     *
     * @return  self
     */
    public function setDormant( $dormant )
    {
        $this->dormant = $dormant;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize( $size )
    {
        $this->size = $size;

        return $this;
    }

    public function __construct( $index, $dormant, $size )
    {
        $this->setIndex( $index );
        $this->setDormant( $dormant );
        $this->setSize( $size );
    }

}

// $numberOfCells: 37
fscanf(STDIN, "%d", $numberOfCells);
for ($i = 0; $i < $numberOfCells; $i++) {
    // $index: 0 is the center cell, the next cells spiral outwards
    // $richness: 0 if the cell is unusable, 1-3 for usable cells
    // $neigh0: the index of the neighbouring cell for each direction
    fscanf(STDIN, "%d %d %d %d %d %d %d %d", $index, $richness, $neigh0, $neigh1, $neigh2, $neigh3, $neigh4, $neigh5);
    $cells[$index] = new Cell( $index, $richness, [$neigh0, $neigh1, $neigh2, $neigh3, $neigh4, $neigh5]);
}
$S = 0;
$d = -1;
$trees = 0;
// game loop
while (TRUE) {
    $myTree=[];
    $possibleAction=[];
    $T=[0,0,0,0];
    $seed = "";
    // $day: the game lasts 24 days: 0-23
    fscanf(STDIN, "%d", $day);
    // $nutrients: the base score you gain from the next COMPLETE action
    fscanf(STDIN, "%d", $nutrients);
    // $sun: your sun points
    // $score: your current score
    fscanf(STDIN, "%d %d", $sun, $score);
    if($day > $d){
        $S += $sun;
        $d = $day;
        error_log(var_export($S,true));
    }
    // $oppSun: opponent's sun points
    // $oppScore: opponent's score
    // $oppIsWaiting: whether your opponent is asleep until the next day
    fscanf(STDIN, "%d %d %d", $oppSun, $oppScore, $oppIsWaiting);
    // $numberOfTrees: the current amount of trees
    fscanf(STDIN, "%d", $numberOfTrees);
    for ($i = 0; $i < $numberOfTrees; $i++) {
        // $cellIndex: location of this tree
        // $size: size of this tree: 0-3
        // $isMine: 1 if this is your tree
        // $isDormant: 1 if this tree is dormant
        fscanf(STDIN, "%d %d %d %d", $cellIndex, $size, $isMine, $isDormant);
        if( $isMine ){
            if( !$isDormant || $size == 0 ){
                $myTree[$size][] = new Tree( $cellIndex, $isDormant, $size );
            }
            $T[0]++;
            switch ( $size )
            {
                case 1:
                    $T[1]+= 1;
                break;
                case 2:
                    $T[2]+= 1;
                break;
                case 3:
                    $T[3]+= 1;
                break;
            }
        }

    }
    // $numberOfPossibleActions: all legal actions
    fscanf(STDIN, "%d", $numberOfPossibleActions);
    $max = 0 ;
    $min = 40;
    for ($i = 0; $i < $numberOfPossibleActions; $i++) {

        $action = preg_split("/[\s]+/",stream_get_line(STDIN, 31 + 1, "\n"));// try printing something from here to start with
        //error_log(var_export($action,true));

        if($action[0] == "SEED" &&
          !in_array($action[2],$cells[$action[1]]->getNeighbours()) &&
          $cells[$action[2]]->getRichness() >= $max ){
            error_log(var_export($action,true));
            error_log(var_export($cells[$action[1]]->getNeighbours(),true));
            $seed = "SEED {$action[1]} {$action[2]}\n";
            $max = $cells[$action[2]]->getRichness();
            $min = $action[1];
        }
    }
    // GROW cellIdx | SEED sourceIdx targetIdx | COMPLETE cellIdx | WAIT <message>

    if( isset($myTree[3]) &&
             count($myTree[3]) > 0  &&
             ($nutrients <= ($T[0]*1.5 ) || ( $cells[$myTree[3][0]->getIndex()]->getRichness() == 3 && $nutrients < 20 ) || $day >= 22)&&
             $sun >= 4
             ) {
        //error_log(var_export("3", true));
        $id = $myTree[3][0]->getIndex();
        echo("COMPLETE {$id}\n");

    }elseif( isset($myTree[2]) &&
             count($myTree[2]) > 0 &&
             $sun >= ( 7 + $T[3] )
             ) {
        //error_log(var_export("2", true));
        $id = $myTree[2][0]->getIndex();
        echo("GROW {$id}\n");

    }elseif( isset($myTree[1]) &&
             count($myTree[1]) > 0 &&
             $sun >= ( 3 + $T[2] )
             ) {
        //error_log(var_export("1", true));
        $id = $myTree[1][0]->getIndex();
        echo("GROW {$id}\n");

    }elseif( isset($myTree[0]) && $sun >= ( 1 + $T[1])) {
        //error_log(var_export("0", true));
        $id = $myTree[0][0]->getIndex();
        echo("GROW {$id}\n");

    }elseif( (!isset($myTree[0]) || ( isset($myTree[0]) && count($myTree[0]) < 1 ) ) && $seed != '' && $trees <= 10 ) {
        //seed
        echo( $seed );
        $trees ++;
    }else{
        echo( "WAIT\n");
    }
// TODO check for Level 2 neighbours
}
