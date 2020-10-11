<?php
$DEBUG = FALSE;

class SubMarine
{
    protected $myMap = [];
    protected $upOrDown = 'N';

     /**
     * Get the value of upOrDown
     */
    public function getUpOrDown()
    {
        return $this->upOrDown;
    }

    /**
     * Set the value of upOrDown
     *
     * @return  self
     */
    public function setUpOrDown($upOrDown)
    {
        $this->upOrDown = $upOrDown;

        return $this;
    }

    /**
     * Get the value of myMap
     */
    public function getMyMap()
    {
        return $this->myMap;
    }

    /**
     * Set the value of myMap
     *
     * @return  self
     */
    public function setMyMap($myMap)
    {
        $this->myMap = $myMap;

        return $this;
    }

    public function __construct($map)
    {
        $this->setMyMap($map);
        // error_log(var_export($this->getMyMap(), true));
    }

    public function toto($line, $column)
    {
        return $line + $column;
    }

    public function checkPossibleMove($line, $column, $map)
    {
        $return = [];
        if ($line - 1 >= 0 && $map[$line - 1][$column] != 'x') {
            $return[] = 'N';
        }
        if ($line + 1 < 15 && $map[$line + 1][$column] != 'x') {
            $return[] = 'S';
        }
        if ($column - 1 >= 0 && $map[$line][$column - 1] != 'x') {
            $return[] = 'W';
        }
        if ($column + 1 < 15 && $map[$line][$column + 1] != 'x') {
            $return[] = 'E';
        }

        // error_log(var_export($return, true));
        return $return;
    }

    public function isStartPosition($line,$column,$map)
    {
            // error_log(var_export($return, true));
            return $map[$line][$column]=='x' ? FALSE : TRUE ;


    }

    public function getStartPosition($map)
    {
        $line = $col = 14;
        $end = FALSE;

        do{
            $this->isStartPosition($line,$col,$map)?$end=TRUE:$col--;
        }while(!$end);

        return [$line,$col] ;
    }

    public function adaptMyMap($currentLine,$currentCol)
    {
        $map = $this->getMyMap();
        $map[$currentLine][$currentCol] = 'x';
        $this->setMyMap($map);
    }

    public function move($currentLine,$currentCol)
    {
        $this->adaptMyMap($currentLine,$currentCol);
        $move = $this->checkPossibleMove($currentLine,$currentCol,$this->getMyMap());

        // error_log(var_export($move, true));

        if($move != []){
            if($currentLine == 0){
                $this->setUpOrDown('S');
            }elseif($currentLine == 14){
                $this->setUpOrDown('N');
            }

            // $return = $move[array_rand($move)];
            if(in_array('W',$move)){
                $return = 'W';
            }elseif(in_array('E',$move)){
                $return = 'E';
            }elseif(in_array($this->getUpOrDown(),$move) ){
                $return = $this->getUpOrDown();
            }else{
                $return = $move[0];
            }
        }else{
            $return = FALSE;
        }

        return $return ;
    }


}


class Utils
{
    protected $ennemyMap = [];

    /**
     * Get the value of myMap
     */
    public function getEnnemyMap()
    {
        return $this->ennemyMap;
    }

    /**
     * Set the value of myMap
     *
     * @return  self
     */
    public function setEnnemyMap($ennemyMap)
    {
        $this->ennemyMap = $ennemyMap;

        return $this;
    }

    public function __construct($ennemyMap)
    {
        $this->setEnnemyMap($ennemyMap);
        // error_log(var_export($this->getMyMap(), true));
    }

    public function adaptEnnemyMap($opponentOrders){
        $orders = explode("|",$opponentOrders);
        error_log(var_export($orders, true));
        // if torpedo
        // if move
        // if silence
        //if surface
    }

}


if (!$DEBUG) {
    fscanf(STDIN, "%d %d %d", $width, $height, $myId);
    for ($i = 0; $i < $height; $i++) {
        // explode each X line
        $map[$i] = str_split(stream_get_line(STDIN, $width + 1, "\n"));
    }
} else {
    $width = 15;
    $height = 15;
    $myId = 0;
    $map =[
        [ '.', '.', '.', 'x', 'x', 'x', '.', '.', 'x', 'x', '.', 'x', 'x', '.', '.',],
        [ '.', '.', '.', 'x', 'x', 'x', '.', '.', 'x', 'x', '.', 'x', 'x', '.', '.',],
        [ 'x', 'x', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.',],
        [ 'x', 'x', '.', 'x', 'x', '.', '.', '.', '.', '.', 'x', 'x', 'x', 'x', '.',],
        [ '.', '.', '.', 'x', 'x', '.', '.', '.', '.', '.', 'x', 'x', 'x', 'x', '.',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', 'x', 'x', '.', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', 'x', 'x', '.', '.', '.', 'x', 'x',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', 'x', 'x',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', 'x', 'x', 'x', '.', 'x', 'x', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', 'x', 'x', 'x', '.', 'x', 'x', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.',],
        [ '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.', '.',],
      ];
}
// error_log(var_export($map, true));

//Start position
$s = new SubMarine($map);
$u = new Utils($map);
$start = $s->getStartPosition($map);
echo ("$start[1] $start[0]\n");
$s->adaptMyMap($start[0], $start[1]);

// game loop
do {
    // add if to put debug vars
    if (!$DEBUG) {
        fscanf(STDIN, "%d %d %d %d %d %d %d %d", $column, $line, $myLife, $oppLife, $torpedoCooldown, $sonarCooldown, $silenceCooldown, $mineCooldown);
        fscanf(STDIN, "%s", $sonarResult);
        $opponentOrders = stream_get_line(STDIN, 200 + 1, "\n");
    }else{
        $line= $column=12;
    }
    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug: error_log(var_export($var, true)); (equivalent to var_dump)
    // error_log(var_export($opponentOrders, true));


    $move = $s->move($line,$column);
    // error_log(var_export($move, true));
    if($move){
        echo ("MOVE $move TORPEDO\n");
    }else{
        echo("SURFACE\n");
        $s->setMyMap($map);
    }


    $u->adaptEnnemyMap($opponentOrders);




} while (TRUE && !$DEBUG);


//objectifs :
// 1 rester le plus logntemps possible sous l'eau
// 2 trouver l'ennemi
// 3 tirer sur l ennemi a portée


// 1 tableau de la map
// 1 tableau mes déplacement
// 1 tableau deplacement adverse + positions possible de l'adversaire
//
// 1 function qui calcule la portée d'une torpille
// 1 function qui calcule les position posible en partant de la torpille
//
