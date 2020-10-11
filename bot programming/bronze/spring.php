<?php
/**
 * Grab the pellets as fast as you can!
 **/

/**
 * Class pac
 */
class Pac
{
    protected $id;
    protected $mine;
    protected $x;
    protected $y;
    protected $typeId;
    protected $speedTurnsLeft;
    protected $abilityCooldown;
    protected $reachX = -1;
    protected $reachY;
    protected $update;
    protected $previousX;
    protected $previousY;
    protected $originX = -1;
    protected $originY = -1;

    public function __construct( $pacId, $mine, $x, $y, $typeId, $speedTurnsLeft, $abilityCooldown )
    {
        $this->setId( $pacId );
        $this->setMine( $mine );
        $this->setX( $x );
        $this->setY( $y );
        $this->setTypeId( $typeId );
        $this->setSpeedTurnsLeft( $speedTurnsLeft );
        $this->setAbilityCooldown( $abilityCooldown );
        $this->setUpdate( 1 );
    }

    public function getNodeId()
    {
        return "x" . $this->getX() . "y" . $this->getY();
    }

    /**
     * @return mixed
     */
    public function getOriginX()
    {
        return $this->originX;
    }

    /**
     * @param mixed $originX
     */
    public function setOriginX( $originX )
    {
        $this->originX = $originX;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOriginY()
    {
        return $this->originY;
    }

    /**
     * @param mixed $originY
     */
    public function setOriginY( $originY )
    {
        $this->originY = $originY;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getPreviousX()
    {
        return $this->previousX;
    }

    /**
     * @param mixed $previousX
     */
    public function setPreviousX( $previousX )
    {
        $this->previousX = $previousX;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPreviousY()
    {
        return $this->previousY;
    }

    /**
     * @param mixed $previousY
     */
    public function setPreviousY( $previousY )
    {
        $this->previousY = $previousY;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->update;
    }

    /**
     * @param mixed $update
     */
    public function setUpdate( $update )
    {
        $this->update = $update;

        return $this;
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     *
     */
    public function setId( $id )
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of mine
     */
    public function getMine()
    {
        return $this->mine;
    }

    /**
     * Set the value of mine
     *
     * @return  self
     */
    public function setMine( $mine )
    {
        $this->mine = $mine;

        return $this;
    }

    /**
     * Get the value of x
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set the value of x
     *
     * @return  self
     */
    public function setX( $x )
    {
        $this->x = $x;

        return $this;
    }

    /**
     * Get the value of y
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set the value of y
     *
     * @return  self
     */
    public function setY( $y )
    {
        $this->y = $y;

        return $this;
    }

    /**
     * Get the value of typeId
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set the value of typeId
     *
     * @return  self
     */
    public function setTypeId( $typeId )
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get the value of speedTurnsLeft
     */
    public function getSpeedTurnsLeft()
    {
        return $this->speedTurnsLeft;
    }

    /**
     * Set the value of speedTurnsLeft
     *
     * @return  self
     */
    public function setSpeedTurnsLeft( $speedTurnsLeft )
    {
        $this->speedTurnsLeft = $speedTurnsLeft;

        return $this;
    }

    /**
     * Get the value of abilityCooldown
     */
    public function getAbilityCooldown()
    {
        return $this->abilityCooldown;
    }

    /**
     * Set the value of abilityCooldown
     *
     * @return  self
     */
    public function setAbilityCooldown( $abilityCooldown )
    {
        $this->abilityCooldown = $abilityCooldown;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReachX()
    {
        return $this->reachX;
    }

    /**
     * @param mixed $reachX
     */
    public function setReachX( $reachX )
    {
        $this->reachX = $reachX;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReachY()
    {
        return $this->reachY;
    }

    /**
     * @param mixed $reachY
     */
    public function setReachY( $reachY )
    {
        $this->reachY = $reachY;

        return $this;
    }

}

class Node
{
    protected $id;
    protected $x;
    protected $y;
    protected $neighbours = [];
    protected $previous;
    protected $totalNeighbours;
    protected $value;

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     *
     * @return Node
     */
    public function setX( $x )
    {
        $this->x = $x;

        return $this;
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

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCrossroad()
    {
        return $this->crossroad;
    }

    /**
     * @param mixed $crossroad
     */
    public function setCrossroad( $crossroad )
    {
        $this->crossroad = $crossroad;

        return $this;
    }

    /**
     * @return array
     */
    public function getNeighbours()
    {
        return $this->neighbours;
    }

    /**
     * @param array $neighbours
     *
     * @return Node
     */
    public function setNeighbours( $neighbours )
    {
        $this->neighbours = $neighbours;

        return $this;
    }

    public function addNeighbour( $nghbr )
    {
        $this->neighbours[] = $nghbr;
//        sort($this->neighbours);
    }

    /**
     * @return mixed
     */
    public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param mixed $previous
     */
    public function setPrevious( $previous )
    {
        $this->previous = $previous;

        return $this;
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
    public function setTotalNeighbours( $totalNeighbours )
    {
        $this->totalNeighbours = $totalNeighbours;

        return $this;
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
     *
     * @return Node
     */
    public function setId()
    {
        $this->id = "x" . $this->getX() . "y" . $this->getY();

        return $this;
    }

    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue( $value )
    {
        $this->value = $value;

        return $this;
    }

    public function getCoord()
    {
        $coord = [
            "x" => $this->getX(),
            "y" => $this->getY(),
        ];

        return $coord;
    }

    public function __construct( $x, $y, $totalNeighbours = 0, $neighbours = [], $value = 0 )
    {
        $this->setX( $x );
        $this->setY( $y );
        $this->setPrevious( -1 );
        $this->setId();
        $this->setTotalNeighbours( $totalNeighbours );
        $this->setNeighbours( $neighbours );
        $this->setValue( $value );
    }
}

class Map
{

    protected $width;
    protected $height;
    protected $grid;
    protected $nodes = [];
    protected $exits = [];
    protected $entry;
    protected $paths = [];
    protected $fifo = [];

    /**
     * @return mixed
     */
    public function getGrid()
    {
        return $this->grid;
    }

    /**
     * @param mixed $grid
     *
     * @return Map
     */
    public function setGrid( $grid )
    {
        $this->grid = $grid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     *
     * @return Map
     */
    public function setWidth( $width )
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     *
     * @return Map
     */
    public function setHeight( $height )
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return array
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @param array $nodes
     *
     * @return Map
     */
    public function setNodes( $nodes )
    {
        $this->nodes = $nodes;

        return $this;
    }

    public function addNode( Node $n )
    {
        $this->nodes[ $n->getId() ] = $n;
    }

    /**
     * @return array
     */
    public function getExits()
    {
        return $this->exits;
    }

    /**
     * @param array $exits
     *
     * @return Map
     */
    public function setExits( $exits )
    {
        $this->exits = $exits;

        return $this;
    }

    public function addExit( Node $c )
    {
        $this->exits[ $c->getId() ] = $c;
    }

    public function removeExit( $id )
    {
        unset( $this->exits[ $id ] );
//        error_log( var_export( count( $this->exits ), TRUE ) );

    }


    public function __construct( $height, $width, $grid )
    {
        $this->setHeight( $height );
        $this->setWidth( $width );
        $this->setGrid( $grid );
        $this->createNodesList();
        // remove after tests
//        $currentNode = $this->getNodeByCoord( 5, 5, $this->getNodes() );
//        $this->removeExit( "x5y5" );
//        $this->shortestPathFifo( $currentNode, $this->getExits(), $this->getNodes() );
    }


    public function createNodesList()
    {
        $grid = $this->getGrid();
        $height = $this->getHeight();
        $width = $this->getWidth();
        /*
         * On a un sommet qd on a au moins 3 des 4 cases adjacentes qui ne sont pas 1 mur
        */
        for( $i = 0; $i < $height; $i++ ) {
            for( $j = 0; $j < $width; $j++ ) {
                $count = 0;
                $neighboursId = [];
                if( ( $i - 1 ) >= 0 && ( $i - 1 ) < $height && $grid[ $i - 1 ][ $j ] != '#' ) {
                    $count++;
                    $neighboursId[] = "x" . $j . "y" . ( $i - 1 );
                }
                if( ( $i + 1 ) >= 0 && ( $i + 1 ) < $height && $grid[ $i + 1 ][ $j ] != '#' ) {
                    $count++;
                    $neighboursId[] = "x" . $j . "y" . ( $i + 1 );
                }
                if( ( $j - 1 ) >= 0 && ( $j - 1 ) < $width && $grid[ $i ][ $j - 1 ] != '#' ) {
                    $count++;
                    $neighboursId[] = "x" . ( $j - 1 ) . "y" . $i;
                }
                if( ( $j + 1 ) >= 0 && ( $j + 1 ) < $width && $grid[ $i ][ $j + 1 ] != '#' ) {
                    $count++;
                    $neighboursId[] = "x" . ( $j + 1 ) . "y" . $i;
                }


                if( $grid[ $i ][ $j ] != '#' ) {
                    $this->addNode( new Node( $j, $i, $count, $neighboursId ) );
                    $this->addExit( new Node( $j, $i, $count, $neighboursId ) );
                }


            }
        }
    }


    public function getNodeByCoord( $x, $y, $nodes )
    {
        /** @var Node $n */
        foreach( $nodes as $n ) {
            if( $n->getX() == $x && $n->getY() == $y ) {
                return $n;
            }
        }

        return NULL;
    }

//    public function removeNodeByCoord( $x, $y, $nodes )
//    {
//        //TODO
//    }

    public function addToPath( $current, array $nodes )
    {
        //error_log(var_export($nodes, true));

        $previous = $nodes[ $current ]->getPrevious();
        if( $previous == -1 ) {
            $this->paths[] = [$current];
        } else {
            foreach( $this->paths as $path ) {
//               error_log(var_export($path, true));
                if( end( $path ) == $previous ) {
                    // error_log(var_export(array_merge($path,[$current]), true));

                    $this->paths[] = array_merge( $path, [$current] );
                }
            }
        }
    }

//
    public function findShortest( $exits, $nodes )
    {
        $min = 999;
        $shortest = -1;
        $ids = [];
//        $cweight = 999;
//        $eweight = 0;
        /** @var Node $e */
        foreach( $exits as $e ) {
            $ids[] = $e->getId();
        }
        foreach( $this->paths as $key => $path ) {
//            error_log( var_export( $path, TRUE ) );
//            $cw = $this->weightCuttedNode($path,$exits,$nodes);
//            $ew = $this->weightexitNode($path,$exits,$nodes);
            if( count( $path ) <= $min && in_array( end( $path ), $ids ) /*&& $cw <= $cweight && $ew >= $eweight*/ ) {
                $shortest = $key;
                $min = count( $path );
//                $cweight = $cw ;
//                $eweight = $ew ;
            }
        }
//        error_log( var_export( $this->paths[ $shortest ], TRUE ) );

//        error_log(var_export($cweight, true));
        return $this->paths[ $shortest ];
    }

    public function PathFifo( $entry, array $exits, array $nodes, array $pellets )
    {
        if( !empty( $pellets ) && array_values( $pellets )[ 0 ]->getValue() == 10 && in_array( $nodes[ array_values( $pellets )[ 0 ]->getId() ], $exits ) ) {
            $pel = [];
//            error_log( var_export( "big", TRUE ) );
            // change to findshortest with pel as exit
//            $return = ["x" . array_values($pellets)[ 0 ]->getX() . "y" . array_values($pellets)[ 0 ]->getY()];
            foreach( $pellets as $pl ) {
                if( $pl->getValue() == 10 ) {
                    $pel[] = $pl;
                }
            }
            error_log( var_export( count( $pel ), TRUE ) );

            $exits = $pel;
        }
        //Mettre le nœud source dans la file.

        $this->fifo[] = $entry->getId();
        $explored = [];
        $exitFind = -1;

        while( !empty( $this->fifo ) /*&& $exitFind == -1*/ ) {
            //Retirer le nœud du début de la file pour l'examiner.
            $currentNode = $nodes[ array_shift( $this->fifo ) ];
//            error_log(var_export($currentNode, true));

            $id = $currentNode->getId();
            $neighbours = $nodes[ $id ]->getNeighbours();
//            error_log( var_export( $neighbours, TRUE ) );

            if( !in_array( $id, $explored ) ) {
                //Mettre tous les voisins non explorés dans la file sauf en cas de sortie dans les voisins.
                foreach( $neighbours as $key => $neigh ) {
                    if( in_array( $nodes[ $neigh ], $exits ) ) {
                        $exitFind = $neigh;
                        $nodes[ $neigh ]->setPrevious( $id );
                        break;
                    } elseif( !in_array( $neigh, $explored ) ) {
                        $this->fifo[] = $neigh;
                        $nodes[ $neigh ]->setPrevious( $id );
                    }
                }
                $this->addToPath( $id, $nodes );

                if( $exitFind != -1 ) {

                    $this->addToPath( $exitFind, $nodes );
                }
                $explored[] = $id;
//                error_log( var_export( $this->paths, TRUE ) );
            }
        }


//            error_log( var_export( "short", TRUE ) );
        $return = $this->findShortest( $exits, $nodes );

        $this->paths = [];
        $this->fifo = [];
        foreach( $nodes as $n ) {
            $n->setPrevious( -1 );
        }

//        error_log( var_export( $return, TRUE ) );

        return $return;

    }
}


function maxValue( $a, $b )
{
    /** @var pellet $a */
    /** @var pellet $b */
    if( $a->getValue() == $b->getValue() ) {
        return 0;
    }

    return ( $a->getValue() > $b->getValue() ) ? -1 : 1;
}


// $width: size of the grid
// $height: top left corner is (x=0, y=0)
fscanf( STDIN, "%d %d", $width, $height );
$grid = [];
for( $i = 0; $i < $height; $i++ ) {
    $grid[] = str_split( stream_get_line( STDIN, $width + 1, "\n" ) );// one line of the grid: space " " is floor, pound "#" is wall
}

$m = new Map( $height, $width, $grid );
// game loop
$myPacs = [];
while( TRUE ) {
    $ennemyPacs = [];
    $pellets = [];
//    $pellets[] = new Node( 0, 0, 0, [], -1 );
    $rX = $rY = $pX = $pY = $oX = $oY = -1;
    $autocollision = FALSE;
    fscanf( STDIN, "%d %d", $myScore, $opponentScore );
    // $visiblePacCount: all your pacs and enemy pacs in sight
    fscanf( STDIN, "%d", $visiblePacCount );

    for( $i = 0; $i < $visiblePacCount; $i++ ) {
        // $pacId: pac number (unique within a team)
        // $mine: true if this pac is yours
        // $x: position in the grid
        // $y: position in the grid
        // $typeId: unused in wood leagues
        // $speedTurnsLeft: unused in wood leagues
        // $abilityCooldown: unused in wood leagues
        fscanf( STDIN, "%d %d %d %d %s %d %d", $pacId, $mine, $x, $y, $typeId, $speedTurnsLeft, $abilityCooldown );
        if( $mine == 1 ) {
            if( isset( $myPacs[ $pacId ] ) ) {
                $rX = $myPacs[ $pacId ]->getReachX();
                $rY = $myPacs[ $pacId ]->getReachY();
                $pX = $myPacs[ $pacId ]->getPreviousX();
                $pY = $myPacs[ $pacId ]->getPreviousY();
                $oX = $myPacs[ $pacId ]->getOriginX();
                $oY = $myPacs[ $pacId ]->getOriginY();
            }

            $myPacs[ $pacId ] = new Pac( $pacId, $mine, $x, $y, $typeId, $speedTurnsLeft, $abilityCooldown );

            if( $rX != -1 ) {
                $myPacs[ $pacId ]->setReachX( $rX );
                $myPacs[ $pacId ]->setReachY( $rY );
                $myPacs[ $pacId ]->setPreviousX( $pX );
                $myPacs[ $pacId ]->setPreviousY( $pY );
                ( $oX == -1 ) ? $myPacs[ $pacId ]->setOriginX( $x ) : $myPacs[ $pacId ]->setOriginX( $oX );
                ( $oY == -1 ) ? $myPacs[ $pacId ]->setOriginY( $y ) : $myPacs[ $pacId ]->setOriginY( $oY );
            }

        } else {
            $ennemyPacs[ $pacId ] = new Pac( $pacId, $mine, $x, $y, $typeId, $speedTurnsLeft, $abilityCooldown );
        }
    }
// $visiblePelletCount: all pellets in sight
    fscanf( STDIN, "%d", $visiblePelletCount );
    for( $i = 0; $i < $visiblePelletCount; $i++ ) {
        // $value: amount of points this pellet is worth
        fscanf( STDIN, "%d %d %d", $x, $y, $value );
        $pellets[ "x" . $x . "y" . $y ] = new Node( $x, $y, $totalNeighbours = 0, $neighbours = [], $value );
    }
    uasort( $pellets, "maxValue" );

    error_log( var_export( count( $pellets ), TRUE ) );

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)

    $i = 0;
    $result = "";
    /** @var Pac $p */
    foreach( $myPacs as $p ) {
        if( $p->getUpdate() != 0 ) {


            $pacId = $p->getId();
            //remove node from exits
            $m->removeExit( $p->getNodeId() );
            // si danger --> switch

            error_log( var_export( $p, TRUE ) );
            // si boost dispo --> boost
            /* if( $p->getAbilityCooldown() == 0 ) {
                 $result .= ( "SPEED {$pacId}|" );
             } // si position actuelle == position a atteindre --> trouver nouvelle position a atteindre
             */

            if( $p->getX() == $p->getPreviousX() && $p->getY() == $p->getPreviousY() ) {
                if( !empty( $ennemyPacs ) ) {
                    $result .= "SWITCH {$pacId} ";
                    switch( $p->getTypeId() ) {
                        case "ROCK":
                            $result .= "PAPER |";
                            break;
                        case "PAPER":
                            $result .= "SCISSORS |";
                            break;
                        case "SCISSORS":
                            $result .= "ROCK |";
                            break;
                    }
                    $p->setPreviousX( -1 )
                        ->setPreviousY( -1 );
                } else {
                    $autocollision = TRUE;
                }
            } elseif
            ( $p->getReachX() == -1 || ( $p->getX() == $p->getReachX() && $p->getY() == $p->getReachY() ) ) {

                $current = $m->getNodeByCoord( $p->getX(), $p->getY(), $m->getNodes() );
                $dest = $m->PathFifo( $current, $m->getExits(), $m->getNodes(), $pellets );
                $dest = end( $dest );
//                error_log( var_export( $dest, TRUE ) );

                $target = $m->getNodes()[ $dest ];

//            error_log( var_export( $target, TRUE ) );
                $myPacs[ $pacId ]->setReachX( $target->getX() )
                    ->setReachY( $target->getY() );
                $m->removeExit( $target->getId() );
                unset( $pellets[ $target->getId() ] );
//                array_shift( $pellets );
            }
            if( strpos( $result, 'SPEED' ) === FALSE && strpos( $result, 'SWITCH' ) === FALSE ) {
                if( $autocollision == TRUE ) {
                    $autocollision = FALSE;
                    $p->setReachX( $p->getOriginX() )
                        ->setReachY( $p->getOriginY() );
                }
                $x = $p->getReachX();
                $y = $p->getReachY();
                $result .= ( "MOVE {$pacId} {$x} {$y}|" ); // MOVE <pacId> <x> <y>
                $p->setPreviousX( $p->getX() )
                    ->setPreviousY( $p->getY() );
            }
        }
        $p->setUpdate( 0 );


    }
    $r = substr( $result, 0, -1 );
    echo( "{$r}\n" );


}
?>