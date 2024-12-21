<?php

class Node
{
    protected $id;
    protected $neighbours = [];
    protected $previous;
    protected $totalNeighbours;
    protected $x;
    protected $y;
    protected $organId;


    public function __construct($id, $x, $y)
    {
        $this->setId($id);
        $this->setPrevious(-1);
        $this->setTotalNeighbours(0);
        $this->setX($x);
        $this->setY($y);

    }

    public function getOrganId()
    {
        return $this->organId;
    }

    public function setOrganId($organId): self
    {
        $this->organId = $organId;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x): void
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y): void
    {
        $this->y = $y;
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
        $this->neighbours[] = $nghbr;
//        sort($this->neighbours);
    }

    public function removeNeighbour($nghbr)
    {
        $id = array_search($nghbr, $this->neighbours);
        unset($this->neighbours[$id]);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
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
    protected $paths = [];
    protected $fifo = [];

    public function addToPath($current, $nodes)
    {

//        error_log(var_export($current, true));
//        error_log(var_export($nodes[$current], true));
//        error_log(var_export($nodes[$current]->getPrevious(), true));

        $previous = $nodes[$current]->getPrevious();
        if ($previous == -1) {
            $this->paths[] = [$current];
        } else {
            foreach ($this->paths as $path) {
//               error_log(var_export($path, true));
                if (end($path) == $previous) {
                    // error_log(var_export(array_merge($path,[$current]), true));
                    $this->paths[] = array_merge($path, [$current]);
                }
            }
        }
    }

    public function findShortest($targets, $nodes)
    {
        $min = 999;
        $shortest = -1;
        $tweight = 0;
        foreach ($this->paths as $key => $path) {
//            error_log(var_export($path, true));
            $tw = $this->weightTargetNode($path, $targets, $nodes);

            if (count($path) <= $min && in_array(end($path), $targets) && $tw >= $tweight) {
                $shortest = $key;
                $min = count($path);
                $tweight = $tw;
            }
        }
//        error_log(var_export($this->paths[$shortest], true));
        return $this->paths[$shortest];
    }

    public function weightTargetNode($path, $targets, $nodes)
    {
        $w = 999;
        if (in_array(end($path), $targets)) {
            $w = count($nodes[end($path)]->getNeighbours());
        }
        return $w;
    }

    public function shortestPathFifo(array $blobs, array $targets, array $nodes)
    {
        $explored = [];
        $targetFind = -1;

        foreach (array_reverse($blobs) as $entry) {
            $this->fifo[] = $entry;

            while (!empty($this->fifo) && $targetFind == -1) {
//            error_log(var_export($this->fifo, true));
                $currentNode = $nodes[array_shift($this->fifo)];
                $id = $currentNode->getId();
//            error_log(var_export($id, true));
                $neighbours = $currentNode->getNeighbours();

                if (!in_array($id, $explored)) {
                    foreach ($neighbours as $k => $neigh) {
                        if (in_array($neigh, $targets)) {
                            $targetFind = $neigh;
                            $nodes[$neigh]->setPrevious($id);
                            break;
                        } elseif (!in_array($neigh, $explored)) {
                            $this->fifo[] = $neigh;
                            $nodes[$neigh]->setPrevious($id);
                        }
                    }
                    $this->addToPath($id, $nodes);

                    if ($targetFind != -1) {
                        $this->addToPath($targetFind, $nodes);
                    }

                    $explored[] = $id;
                }
            }
        }

        $return = $this->findShortest($targets, $nodes);
        $this->paths = [];
        $this->fifo = [];

        foreach ($nodes as $n) {
            $n->setPrevious(-1);
        }

        return $return;
    }
}


class Tools
{
    public function findDirection($a, $b)
    {// A 42 B 41
        if (($a + 1) == $b) {
            $return = "N";
        } elseif (($a - 1) == $b) {
            $return = "S";
        } elseif (($a + 10) == $b) {
            $return = "W";
        } elseif (($a - 10) == $b) {
            $return = "E";
        }
        return $return;
    }
}

//class Cell
//{
//    protected $x;
//    protected $y;
//    protected $type;
//    protected $owner;
//    protected $organId;
//    protected $organDir;
//    protected $organParentId;
//}


fscanf(STDIN, "%d %d", $width, $height);
//error_log(var_export($width, true));
// game loop
$protList = ["A", "B", "C", "D"];
$excludeList = ["WALL"];
$nodes = [];
$prot = [];
for ($h = 0; $h < $height; $h++) { // $height: rows in the game grid
    for ($w = 0; $w < $width; $w++) { // $width: columns in the game grid
        $n = new Node($w . $h, $w, $h);
        if ($h == 0 && $w == 0) { //coin haut gauche
//            $n->addNeighbour(($w-1) . $h);//L
            $n->addNeighbour($w . ($h + 1));//B
            $n->addNeighbour(($w + 1) . $h);//R
//            $n->addNeighbour($w . ($h-1));//T
        } elseif ($h == 0) { // L1
            $n->addNeighbour(($w - 1) . $h);//L
            $n->addNeighbour($w . ($h + 1));//B
            $n->addNeighbour(($w + 1) . $h);//R
//            $n->addNeighbour($w . ($h-1));//T
        } elseif ($w == 0) { // C1
//            $n->addNeighbour(($w-1) . $h);//L
            $n->addNeighbour($w . ($h + 1));//B
            $n->addNeighbour(($w + 1) . $h);//R
            $n->addNeighbour($w . ($h - 1));//T
        } elseif ($h == $height - 1) { //LMax
            $n->addNeighbour(($w - 1) . $h);//L
            $n->addNeighbour($w . ($h + 1));//B
            $n->addNeighbour(($w + 1) . $h);//R
//            $n->addNeighbour($w . ($h-1));//T
        } elseif ($w == $width - 1) { //CMax
            $n->addNeighbour(($w - 1) . $h);//L
            $n->addNeighbour($w . ($h + 1));//B
//            $n->addNeighbour(($w + 1) . $h);//R
            $n->addNeighbour($w . ($h - 1));//T
        } else {
            $n->addNeighbour(($w - 1) . $h);//L
            $n->addNeighbour($w . ($h + 1));//B
            $n->addNeighbour(($w + 1) . $h);//R
            $n->addNeighbour($w . ($h - 1));//T
        }
        $nodes[$w . $h] = $n;
    }
}
//TODO: etablir tous les neighbours
//error_log(var_export($nodes["00"], true));
//error_log(var_export($nodes["54"], true));
while (TRUE) {
    fscanf(STDIN, "%d", $entityCount);
    $entities = [];
    $target = [];
    $blob = [];
    for ($i = 0; $i < $entityCount; $i++) {
        // $y: grid coordinate
        // $type: WALL, ROOT, BASIC, TENTACLE, HARVESTER, SPORER, A, B, C, D
        // $owner: 1 if your organ, 0 if enemy organ, -1 if neither
        // $organId: id of this entity if it's an organ, 0 otherwise
        // $organDir: N,E,S,W or X if not an organ
        fscanf(STDIN, "%d %d %s %d %d %s %d %d", $x, $y, $type, $owner, $organId, $organDir, $organParentId, $organRootId);
        $entities[] = [
            "x" => $x,
            "y" => $y,
            "type" => $type,
            "owner" => $owner,
            "organId" => $organId,
        ]; //TODO : regarder dans les prochaines leagues pour voir qd les infos d'organXXX sont utiles

//        if(in_array($type,$protList))
//        {
//            $prot[] = new Node($x.$y);
//        }
//        error_log(var_export($x.' '.$y.' '.$type.' '.$owner.' '.$organId.' '.$organDir.' '.$organParentId.' '.$organRootId, true));
    }
//    error_log(var_export(count($nodes), true));
    foreach ($entities as $arr) {
        if (in_array($arr['type'], $excludeList) || $arr['owner'] == 0) {
            if (isset($nodes[$arr["x"] . $arr["y"]])) {
                $neighbours = $nodes[$arr["x"] . $arr["y"]]->getNeighbours();
                foreach ($neighbours as $neigh) {
                    if (isset($nodes[$neigh])) {
                        $nodes[$neigh]->removeNeighbour($arr["x"] . $arr["y"]);
                    }
                }
                if ($arr["x"] == 5 && $arr["y"] == 5) error_log(var_export($neighbours, true));
                unset($nodes[$arr["x"] . $arr["y"]]);
            }
        } elseif (in_array($arr['type'], $protList)) {
            //TODO: tenir compte des prot deja harvest
            $target[] = $arr["x"] . $arr["y"];
        } elseif ($arr["owner"] == 1) {
            $blob[] = $arr["x"] . $arr["y"];
            $nodes[$arr["x"] . $arr["y"]]->setOrganId($arr["organId"]);
        }

    }
//    error_log(var_export(count($nodes), true));
//    error_log(var_export($nodes["55"], true));
//    error_log(var_export($target, true));

//    $gd = "\n";
//    for ($h = 0; $h < $height; $h++) {
//        $d = "";
//        for ($w = 0; $w < $width; $w++) {

//    if (isset($entities[$w][$h])) {
//        if (!in_array($entities[$w][$h][0], $excludeList) && $entities[$w][$h][1] !== 0) {
//            $nodes[] = new Node($w . $h);
//        }

//        switch ($entities[$w][$h][0]) {
//            case "WALL":
//                $d .= "W";
//                break;
//            case "ROOT":
//                $d .= "R";
//                break;
//            case "BASIC":
//                $d .= "B";
//                break;
//            case "HARVESTER":
//                $d .= "H";
//                break;
//            default;
//                $d .= $entities[$w][$h][0];
//                break;
//        }
//    } else {
//        $d .= ".";
//        $nodes[] = new Node($w . $h);
//    }
//}
//$gd .= $d . "\n";
//}
//    error_log(var_export($gd, true));
//    error_log(var_export(count($nodes), true));
//    error_log(var_export($nodes, true));
//    error_log(var_export($prot, true));
// $myD: your protein stock
    fscanf(STDIN, "%d %d %d %d", $myA, $myB, $myC, $myD);
// $oppD: opponent's protein stock
    fscanf(STDIN, "%d %d %d %d", $oppA, $oppB, $oppC, $oppD);
// $requiredActionsCount: your number of organisms, output an action for each one in any order
    fscanf(STDIN, "%d", $requiredActionsCount);
    error_log(var_export($requiredActionsCount, true));
    for ($i = 0; $i < $requiredActionsCount; $i++) {
        $p = new Path();
        $t = new Tools();
        if ($myC > 0 && $myD > 0) {//TARGET UN HARVESTER
            // POUR CETTE LIGUE YA QUE LE A
            error_log(var_export($blob, true));
            $shortestPath = $p->shortestPathFifo($blob, $target, $nodes);

            error_log(var_export("shortestPath", true));
            error_log(var_export($shortestPath, true));
            error_log(var_export(count($shortestPath), true));

            $target = array_pop($shortestPath);
            $harvest = array_pop($shortestPath);

            error_log(var_export($target, true));
            error_log(var_export($harvest, true));

            $dir = $t->findDirection($target, $harvest);

            $x = $nodes[$harvest]->getX();
            $y = $nodes[$harvest]->getY();
            //TODO : éviter de rouler sur une prot
            if (count($shortestPath) == 1) {
                echo("GROW 1 ${x} ${y} HARVESTER ${dir}\n");
            } else {
                echo("GROW 1 ${x} ${y} BASIC ${dir}\n");
            }
        } else {
            $x = "";
            $y = "";
            $id = "";
            foreach ($blob as $b) {
                $neigh = $nodes[$b]->getNeighbours();
                error_log(var_export($neigh, true));
                if (count($neigh) == 0) {
                    continue;
                }
                foreach ($neigh as $n) {
                    if (!in_array($n, $target) && !in_array($n, $blob)) {
                        $x = $nodes[$n]->getX();
                        $y = $nodes[$n]->getY();
                        $id = $nodes[$b]->getOrganId();
                        break 2;
                    }
                }

            }
            if ($x === "") {
                $x = 1;
                $y = 6;
                $id = 1;
            }
            if($myB > 0 && $myC > 0){
                echo("GROW $id $x $y TENTACLE E\n");
            }else{
                echo("GROW $id $x $y BASIC E\n");
            }
        }

        // Write an action using echo(). DON'T FORGET THE TRAILING \n
        // To debug: error_log(var_export($var, true)); (equivalent to var_dump)

        // Si 2C+2D -> TARGET HARVEST C & D
        // Si C+D -> TARGET HARVEST A
        // Si plus de position d'harvest interessante GROW

//        echo("GROW 1 16 6 BASIC\n");
    }
}