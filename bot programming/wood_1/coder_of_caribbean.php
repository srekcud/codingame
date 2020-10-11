<?php

/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
class Utilities
{

}


class Entity
{
    protected $id;
    protected $x;
    protected $y;

    public function __construct( $id, $x, $y )
    {
        $this->setId( $id );
        $this->setX( $x );
        $this->setY( $y );

    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId( $id )
    {
        $this->id = $id;
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
    public function setX( $x )
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
    public function setY( $y )
    {
        $this->y = $y;
    }
}

class EntiryShip extends Entity
{

    protected $orientation;
    protected $speed;
    protected $health;
    protected $owner;


    public function __construct( $id, $x, $y, $orientation, $speed, $health, $owner )
    {
        Entity::__construct( $id, $x, $y );
        $this->setOrientation( $orientation );
        $this->setSpeed( $speed );
        $this->setHealth( $health );
        $this->setOwner( $owner );
    }

    /**
     * @return mixed
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * @param mixed $orientation
     */
    public function setOrientation( $orientation )
    {
        $this->orientation = $orientation;
    }

    /**
     * @return mixed
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed( $speed )
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * @param mixed $health
     */
    public function setHealth( $health )
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner( $owner )
    {
        $this->owner = $owner;
    }


}

class EntiryBarrel extends Entity
{

    protected $stock;

    public function __construct( $id, $x, $y, $stock )
    {
        Entity::__construct( $id, $x, $y );
        $this->setStock( $stock );
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     */
    public function setStock( $stock )
    {
        $this->stock = $stock;
    }
}

class EntiryCanonBall extends Entity
{

    protected $idOwner;
    protected $turn;

    public function __construct( $id, $x, $y, $idOwner, $turn )
    {
        Entity::__construct( $id, $x, $y );
        $this->setIdOwner( $idOwner );
        $this->setTurn( $turn );

    }

    /**
     * @return mixed
     */
    public function getIdOwner()
    {
        return $this->idOwner;
    }

    /**
     * @param mixed $idOwner
     */
    public function setIdOwner( $idOwner )
    {
        $this->idOwner = $idOwner;
    }

    /**
     * @return mixed
     */
    public function getTurn()
    {
        return $this->turn;
    }

    /**
     * @param mixed $turn
     */
    public function setTurn( $turn )
    {
        $this->turn = $turn;
    }


}

class EntiryMine extends Entity
{
    public function __construct( $id, $x, $y )
    {
        Entity::__construct( $id, $x, $y );
    }
}

//class Path
//{
//    protected $paths = [];
//    protected $fifo = [];
//
//    public function addToPath($current,$nodes)
//    {
//        //error_log(var_export($nodes, true));
//        $previous = $nodes[$current]->getPrevious();
//        if($previous == -1){
//            $this->paths[] = [$current];
//        }else{
//            foreach($this->paths as $path){
//                //   error_log(var_export($path, true));
//                if(end($path) == $previous){
//                    // error_log(var_export(array_merge($path,[$current]), true));
//
//                    $this->paths[] = array_merge($path,[$current]) ;
//                }
//            }
//        }
//    }
//
//    public function findShortest( $exits )
//    {
//        $min = 99999999;
//        $shortest = -1;
//        foreach( $this->paths as $key => $path ) {
//           // error_log( var_export( $path, TRUE ) );
//            if( count( $path ) < $min && in_array( end( $path ), $exits ) ) {
//                $shortest = $key;
//                $min = count( $path );
//            }
//        }
//
//        return $this->paths[ $shortest ];
//    }
//
//    public function shortestPathFifo( $entry, array $exits, array $nodes )
//    {
//
//        //Mettre le nœud source dans la file.
//
//        $this->fifo[] = $entry;
//        $explored = [];
//        $exitFind = -1;
//
//        while( !empty( $this->fifo ) && $exitFind == -1 ) {
//            //Retirer le nœud du début de la file pour l'examiner.
//            $currentNode = $nodes[ array_shift( $this->fifo ) ];
//            //error_log( var_export( $currentNode, TRUE ) );
//            $id = $currentNode->getId();
//            $neighbours = $nodes[ $id ]->getNeighbours();
//
//            if( !in_array( $id, $explored ) ) {
//                //Mettre tous les voisins non explorés dans la file sauf en cas de sortie dans les voisins.
//                foreach( $neighbours as $key => $neigh ) {
//                    if( in_array( $neigh, $exits ) ) {
//                        $exitFind = $neigh;
//                        $nodes[ $neigh ]->setPrevious( $id );
//                    } elseif( !in_array( $neigh, $explored ) ) {
//                        $this->fifo[] = $neigh;
//                        if(!isset($nodes[ $neigh ])){
////                            error_log( var_export( $neighbours, TRUE ) );
//                            error_log( var_export( $currentNode, TRUE ) );
//                            error_log( var_export( $neigh, TRUE ) );
//                        }
//                        $nodes[ $neigh ]->setPrevious( $id );
//                    }
//                }
//                $this->addToPath( $id, $nodes );
//
//                if( $exitFind != -1 ) {
//
//                    $this->addToPath( $exitFind, $nodes );
//                }
//                $explored[] = $id;
//                //  error_log(var_export($this->paths, true));
//            }
//        }
//        $return = $this->findShortest( $exits );
//        $this->paths = [];
//        $this->fifo = [];
//        foreach( $nodes as $n ) {
//            $n->setPrevious( -1 );
//        }
//
//        return $return;
//
//    }
//}
//
//class Node
//{
//    protected $id;
//    protected $neighbours;
//    protected $previous;
//
//
//    public function __construct( $id )
//    {
//        $this->setId( $id );
//        $this->neighbours = [];
//        $this->previous = -1;
//
//    }
//
//    public function getNeighbours()
//    {
//        return $this->neighbours;
//    }
//
//    public function addNeighbour( $nghbr )
//    {
//        $this->neighbours[] = $nghbr;
//    }
//
//    public function removeNeighbour( $nghbr )
//    {
//        $id = array_search( $nghbr, $this->neighbours );
//        unset( $this->neighbours[ $id ] );
//    }
//
//    public function setId( $id )
//    {
//        $this->id = $id;
//    }
//
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function getPrevious()
//    {
//        return $this->previous;
//    }
//
//    public function setPrevious( $previous )
//    {
//        $this->previous = $previous;
//    }
//}
//
//// construct the map for the graph
//$nodes = [];
//for( $i = 1; $i < 23; $i++ ) {// 23 C
//    for( $j = 1; $j < 21; $j++ ) { //21 L
//        $nodeId = $i . $j;
//        $nodes[ $nodeId ] = new Node( $nodeId );
//
//        if( $j % 2 == 0 ) { // ligne paire
//            $nodes[ $nodeId ]->addNeighbour( ( $i - 1 ) . ( $j - 1 ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i ) . ( $j - 1 ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i - 1 ) . ( $j ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i + 1 ) . ( $j ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i - 1 ) . ( $j + 1 ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i ) . ( $j + 1 ) );
//        } else {
//            $nodes[ $nodeId ]->addNeighbour( ( $i ) . ( $j - 1 ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i + 1 ) . ( $j - 1 ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i - 1 ) . ( $j ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i + 1 ) . ( $j ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i ) . ( $j + 1 ) );
//            $nodes[ $nodeId ]->addNeighbour( ( $i + 1 ) . ( $j + 1 ) );
//        }
//    }
//}
//for( $k = 0; $k <= 21; $k++ ) {// C 0 && 23
//    $nodeId = 0 . $k;
//    $nodes[ $nodeId ] = new Node( $nodeId );
//    $nodes[ $nodeId ]->addNeighbour( ( 0 ) . ( $k - 1 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( 0 + 1 ) . ( $k ) );
//    $nodes[ $nodeId ]->addNeighbour( ( 0 ) . ( $k + 1 ) );
//    $nodeId = 23 . $k;
//    $nodes[ $nodeId ] = new Node( $nodeId );
//    $nodes[ $nodeId ]->addNeighbour( ( 23 ) . ( $k - 1 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( 23 - 1 ) . ( $k ) );
//    $nodes[ $nodeId ]->addNeighbour( ( 23 ) . ( $k + 1 ) );
//}
//for( $k = 0; $k <= 23; $k++ ) {// L 0 && 21
//    $nodeId = $k . 0;
//    $nodes[ $nodeId ] = new Node( $nodeId );
//    $nodes[ $nodeId ]->addNeighbour( ( $k - 1 ) . ( 0 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( $k + 1 ) . ( 0 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( $k - 1 ) . ( 0 + 1 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( $k ) . ( 0 + 1 ) );
//    $nodeId = $k . 21;
//    $nodes[ $nodeId ] = new Node( $nodeId );
//    $nodes[ $nodeId ]->addNeighbour( ( $k ) . ( 21 - 1 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( $k + 1 ) . ( 21 - 1 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( $k - 1 ) . ( 21 ) );
//    $nodes[ $nodeId ]->addNeighbour( ( $k + 1 ) . ( 21 ) );
//}
////TODO : 4 corner are wrong
//$nodes[ "00" ]->removeNeighbour( "-10" );
//$nodes[ "00" ]->removeNeighbour( "-11" );
//
//$nodes[ "021" ]->removeNeighbour( "-121" );
//
//$nodes[ "230" ]->removeNeighbour( "240" );
//
//$nodes[ "2321" ]->removeNeighbour( "2420" );
//$nodes[ "2321" ]->removeNeighbour( "2421" );
//error_log( var_export( $nodes[ "10" ], TRUE ) );
// game loop
while( TRUE ) {
    $myShips = [];
    $ennnemyShips = [];
    $barrels = [];
    $mines = [];
//    $nodesBis = $nodes;
    fscanf( STDIN, "%d", $myShipCount ); // the number of remaining ships
    fscanf( STDIN, "%d", $entityCount ); // the number of entities (e.g. ships, mines or cannonballs)
    for( $i = 0; $i < $entityCount; $i++ ) {
        fscanf( STDIN, "%d %s %d %d %d %d %d %d", $entityId, $entityType, $x, $y, $arg1, $arg2, $arg3, $arg4 );
        switch( $entityType ) {
            case "SHIP" :
                if( $arg4 == 1 ) {
                    $myShips[] = new EntiryShip( $entityId, $x, $y, $arg1, $arg2, $arg3, $arg4 );
                } else {
                    $ennemyShips[] = new EntiryShip( $entityId, $x, $y, $arg1, $arg2, $arg3, $arg4 );
                }
                break;
            case "BARREL":
                $barrels[] = new EntiryBarrel( $entityId, $x, $y, $arg1 );
                break;
            case "CANNONBALL":
                //TODO : use this
                break;
            case "MINE":
//                $mines[] = new EntiryMine( $entityId, $x, $y );
//                unset( $nodesBis[ $x . $y ] );
//                $nodesBis[ ( $x ) . ( $y - 1 ) ]->removeNeighbour($x . $y );
//                $nodesBis[( $x - 1 ) . ( $y ) ]->removeNeighbour( $x . $y );
//                $nodesBis[ ( $x + 1 ) . ( $y ) ]->removeNeighbour( $x . $y );
//                $nodesBis[ ( $x - 1 ) . ( $y + 1 ) ]->removeNeighbour( $x . $y );
//                $nodesBis[ ( $x ) . ( $y + 1 ) ]->removeNeighbour( $x . $y );
                break;
        }
    }
    for( $i = 0; $i < $myShipCount; $i++ ) {


//        $p = new Path();
//        $entry = $myShips[$i]->getX().$myShips[$i]->getY();
//      //  $short = $p->shortestPathFifo($entry,$barrels,$nodesBis);

        // Write an action using echo(). DON'T FORGET THE TRAILING \n
        // To debug (equivalent to var_dump): error_log(var_export($var, true));
        if( !empty( $barrels ) ) {
            echo( "MOVE {$barrels[0]->getX()} {$barrels[0]->getY()}\n" ); // Any valid action, such as "WAIT" or "MOVE x y"
        } else {
            echo( "WAIT\n" ); // Any valid action, such as "WAIT" or "MOVE x y"
        }
    }
}
?>