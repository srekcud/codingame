<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

$nodes = [];
class Node
{
    protected $id;
    protected $neighbours = [];
    protected $previous;
    protected $totalNeighbours;


    public function __construct($id)
    {
        $this->setId($id);
        $this->setPrevious(-1);
        $this->setTotalNeighbours(0);

    }

    /**
     * @return mixed
     */
    public function getTotalNeighbours()
    {
        return $this->totalNeighbours;
    }

    /**
     * @param mixed $totalNeighbours
     */
    public function setTotalNeighbours($totalNeighbours)
    {
        $this->totalNeighbours = $totalNeighbours;
    }



    public function getNeighbours()
    {
        return $this->neighbours;
    }

    public function addNeighbour($nghbr)
    {
        $this->neighbours[] =$nghbr;
//        sort($this->neighbours);
    }

    public function removeNeighbour($nghbr)
    {
        $id = array_search($nghbr,$this->neighbours);
        unset($this->neighbours[$id]);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id ;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function setPrevious($previous)
    {
        $this->previous = $previous;
    }
}

class Path
{
    protected $paths = [] ;
    protected $fifo = [];

    public function addToPath($current,$nodes)
    {
        //error_log(var_export($nodes, true));
        $previous = $nodes[$current]->getPrevious();
        if($previous == -1){
            $this->paths[] = [$current];
        }else{
            foreach($this->paths as $path){
//               error_log(var_export($path, true));
                if(end($path) == $previous){
                    // error_log(var_export(array_merge($path,[$current]), true));

                    $this->paths[] = array_merge($path,[$current]) ;
                }
            }
        }
    }

    public function findShortest($exits,$nodes)
    {
        $min = 999 ;
        $shortest = -1;
        $cweight = 999;
        $eweight = 0;
        foreach($this->paths as $key=>$path){
//            error_log(var_export($path, true));
            $cw = $this->weightCuttedNode($path,$exits,$nodes);
            $ew = $this->weightexitNode($path,$exits,$nodes);

            if(count($path) <= $min && in_array(end($path),$exits) && $cw <= $cweight && $ew >= $eweight ){
                $shortest = $key;
                $min = count($path);
                $cweight = $cw ;
                $eweight = $ew ;
            }
        }
        error_log(var_export($this->paths[$shortest], true));
        error_log(var_export($weight, true));
        return $this->paths[$shortest] ;
    }

    public function weightCuttedNode($path,$exits,$nodes){
        $w = 999;
        if(in_array(end($path),$exits)){
            $w= count($nodes[$path[1]]->getNeighbours()) ;
        }
        return $w;
    }
    public function weightexitNode($path,$exits,$nodes){
        $w = 999;
        if(in_array(end($path),$exits)){
            $w= count($nodes[end($path)]->getNeighbours()) ;
        }
        return $w;
    }

    public function shortestPathFifo($entry,array $exits,array $nodes)
    {
        //Mettre le nœud source dans la file.

        $this->fifo[] = $entry ;
        $explored = [];
        $exitFind = -1 ;

        while(!empty($this->fifo) /*&& $exitFind == -1*/){
            //Retirer le nœud du début de la file pour l'examiner.
            $currentNode = $nodes[array_shift($this->fifo)];
            $id = $currentNode->getId();
            $neighbours = $nodes[$id]->getNeighbours();

            if(!in_array($id,$explored)){
                //Mettre tous les voisins non explorés dans la file sauf en cas de sortie dans les voisins.
                foreach($neighbours as $key=>$neigh){
                    if(in_array($neigh,$exits)){
                        $exitFind = $neigh ;
                        $nodes[$neigh]->setPrevious($id);
                        break;
                    }elseif(!in_array($neigh,$explored)){
                        $this->fifo[] = $neigh;
                        $nodes[$neigh]->setPrevious($id);
                    }
                }
                $this->addToPath($id,$nodes);

                if($exitFind != -1){

                    $this->addToPath($exitFind,$nodes);
                }
                $explored[] = $id;
                //  error_log(var_export($this->paths, true));
            }
        }
        $return = $this->findShortest($exits,$nodes) ;
        $this->paths = [];
        $this->fifo=[];
        foreach($nodes as $n){
            $n->setPrevious(-1);
        }
        return $return;

    }
}
fscanf(STDIN, "%d %d %d",$nbrNode,$nbrBridges,$nbrExit);

for($i=0;$i<$nbrNode;$i++){
    $nodes[$i] = new Node($i);
}

for ($i = 0; $i < $nbrBridges; $i++){
    fscanf(STDIN, "%d %d",$N1,$N2);
    $nodes[$N1]->addNeighbour($N2);
    $nodes[$N2]->addNeighbour($N1);
}

for ($i = 0; $i < $nbrExit; $i++){
    fscanf(STDIN, "%d",$EI);
    $exits[]= $EI;
}
// game loop
while (TRUE)
{
    fscanf(STDIN, "%d",$SI);

    $p = new Path();
    $shortestPath = $p->shortestPathFifo($nodes[$SI]->getId(),$exits,$nodes);
    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));

    $last = count($shortestPath);
    $N1 = $shortestPath[$last-1];
    $N2 = $shortestPath[$last-2];
//    $N1 = $shortestPath[0];
//    $N2 = $shortestPath[1];
    $nodes[$N1]->removeNeighbour($N2);
    $nodes[$N2]->removeNeighbour($N1);
    echo($N1." ".$N2."\n");
// error_log(var_export($nodes, true));


    // Example: 0 1 are the indices of the nodes you wish to sever the link between
    // echo("0 1\n");
}
?>