<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
/**************************************************
 * global params
 */

$factories = [];
$conquest = [
    "id"   => NULL,
    "dist" => 999,
];
$first = TRUE;
$second = TRUE;
$sendSecond = FALSE;

/**
 * Class
 */
class Utilities
{
    /**
     * @param array $factories
     *
     * @return EntityFactory|null
     */
    public function getHQ( array $factories )
    {
        $max = 0;
        $hq = NULL;
        /** @var EntityFactory $f */
        foreach( $factories as $f ) {
            if( $f->getOwner() == 1 && $f->getCyborg() > $max ) {
                $max = $f->getCyborg();
                $hq = $f;
            }
        }

        return $hq;
    }

    /**
     * @param EntityFactory $hq
     * @param array         $ennemyFactories
     * @param               $level
     * @param array         $conquest
     *
     * @return int|null|string
     */
    public function getNearestFromHQWithLevel( EntityFactory $hq, array $ennemyFactories, $level, array $conquest )
    {
        /** @var EntityFactory $hq */
        $min = 999;
        $targetId = NULL;

        $distance = $hq->getArrayDist();
        foreach( $distance as $ennemyId => $dist ) {
            /** @var EntityFactory $fact */
            foreach( $ennemyFactories as $fact ) {
                if( $ennemyId == $fact->getId() && $dist < $min && $fact->getProduction() == $level && $fact->getId() != $conquest[ 'id' ] ) {
                    $min = $dist;
                    $targetId = $ennemyId;
                }
            }
        }

        return $targetId;
    }

    /**
     * @param EntityFactory $hq
     * @param array         $ennemyFactories
     * @param array         $conquest
     *
     * @return int|null|string
     */
    public function getNearestFromHQ( EntityFactory $hq, array $ennemyFactories, array $conquest )
    {
        /** @var EntityFactory $hq */
        $min = 999;
        $targetId = NULL;

        $distance = $hq->getArrayDist();
        foreach( $distance as $ennemyId => $dist ) {
            /** @var EntityFactory $fact */
            foreach( $ennemyFactories as $fact ) {
                if( $ennemyId == $fact->getId() && $dist < $min && $fact->getId() != $conquest[ 'id' ] ) {
                    $min = $dist;
                    $targetId = $ennemyId;
                }
            }
        }

        return $targetId;
    }


}

class EntityFactory
{
    protected $id;
    protected $owner;
    protected $cyborg;
    protected $production;
    protected $dist = [];

    public function __construct( $id )
    {
        $this->setId( $id );
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $owner
     */
    public function setId( $id )
    {
        $this->id = $id;

        return $this;
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

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCyborg()
    {
        return $this->cyborg;

    }

    /**
     * @param mixed $cyborg
     */
    public function setCyborg( $cyborg )
    {
        $this->cyborg = $cyborg;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProduction()
    {
        return $this->production;
    }

    /**
     * @param mixed $production
     */
    public function setProduction( $production )
    {
        $this->production = $production;

        return $this;
    }

    /**
     * @param $fact2
     * @param $dist
     *
     * @return $this
     */
    public function addDist( $fact2, $dist )
    {
        $this->dist[ $fact2 ] = $dist;

        return $this;
    }

    public function getArrayDist()
    {
        return $this->dist;
    }

    public function getDistFrom( $target )
    {
        $return = NULL;
        foreach( $this->dist as $key => $value ) {
            if( $key == $target ) {
                $return = $value;
            }
        }

        return $return;
    }
}

/**
 * INIT
 */
fscanf( STDIN, "%d",
    $factoryCount // the number of factories
);
fscanf( STDIN, "%d",
    $linkCount // the number of links between factories
);

for( $i = 0; $i < $factoryCount; $i++ ) {
    $factories[ $i ] = new EntityFactory( $i );
}
for( $i = 0; $i < $linkCount; $i++ ) {
    fscanf( STDIN, "%d %d %d",
        $factory1,
        $factory2,
        $distance
    );

    $factories[ $factory1 ]->addDist( $factory2, $distance );
    $factories[ $factory2 ]->addDist( $factory1, $distance );
}
/**
 * END INIT
 */
//error_log( var_export( $factories, TRUE ) );
/**
 * game loop
 */
while( TRUE ) {
    echo "WAIT";
    fscanf( STDIN, "%d",
        $entityCount // the number of entities (e.g. factories and troops)
    );
    $utilities = new Utilities();

    $owned = [];
    $ennemy = [];
    $hq = NULL;
    $hqId = NULL;
    $ennemyId = NULL;
    $bomb = FALSE;

    $bombingId = NULL;
    $level = 3;
    $sendToConquest = 1;
    $echo = ";";
    $levelId = [];
    if( $conquest[ 'id' ] !== NULL ) {
        $conquest[ 'dist' ] = $conquest[ 'dist' ] - 1;
    }
    if( $conquest[ 'dist' ] == 0 ) {
        $conquest = [
            "id"   => NULL,
            "dist" => 999,
        ];
    }
    error_log( var_export( $conquest, TRUE ) );

    for( $i = 0; $i < $entityCount; $i++ ) {
        fscanf( STDIN, "%d %s %d %d %d %d %d",
            $entityId,
            $entityType,
            $arg1,
            $arg2,
            $arg3,
            $arg4,
            $arg5
        );

        switch( $entityType ) {
            case "FACTORY" :
                $factories[ $entityId ]->setOwner( $arg1 );
                $factories[ $entityId ]->setCyborg( $arg2 );
                $factories[ $entityId ]->setProduction( $arg3 );
                if( $first && $arg1 == -1 && $arg3 > 0 ) {
                    $bombingId = $entityId;
                } elseif( $second && $arg1 == -1 && $arg2 >= 20 ) {
                    $bombingId = $entityId;
                    $sendSecond = TRUE;
                }
                if( $arg1 != 1 ) {
//                    $cyborgs[ $entityId ] = $arg2;
                    $ennemy[] = $factories[ $entityId ];
                } else {
                    $owned[] = $factories[ $entityId ];
                }
                break;
            case "TROOP" :
                //TODO use this info
                break;
            case "BOMB" :
                if( $arg1 == -1 ) {
                    $bomb = TRUE;
                }
                break;
            default:
                break;
        }
    }
    $hq = $utilities->getHQ( $factories );
    if( $hq !== NULL ) {
        $hqId = $hq->getId();
        do {
            $ennemyId = $utilities->getNearestFromHQWithLevel( $hq, $ennemy, $level, $conquest );
            $level--;
        } while( $ennemyId == NULL && $level >= 1 );

//        if( $ennemyId == NULL || $hq->getProduction() == 0 ) {
        if( $ennemyId == NULL ) {
            $ennemyId = $utilities->getNearestFromHQ( $hq, $ennemy, $conquest );
        } else {
            $sendToConquest = round( ( ( $hq->getCyborg() + $hq->getArrayDist()[ $ennemyId ] ) * 1.5 ) + 1 );
        }

        if( $first && $bombingId !== NULL ) {
            $echo .= "MSG BOMBING;";
            $echo .= "BOMB {$hqId} {$bombingId};";
            $first = FALSE;
        }elseif( $second && $bombingId !== NULL && $sendSecond == TRUE) {
            $echo .= "MSG BOMBING;";
            $echo .= "BOMB {$hqId} {$bombingId};";
            $second = FALSE;
        }
        if( $bomb && $ennemyId !== NULL ) {
            $echo .= "MSG BOMB;";
            //empty HQ on each turn to safe the most cyborg
            $echo .= "MOVE {$hqId} {$ennemyId} {$hq->getCyborg()};";
        } elseif( $hq->getProduction() == 0 && $ennemyId !== NULL ) {
            $echo .= "MSG MOVE OUT;";
            $echo .= "MOVE {$hqId} {$ennemyId} {$hq->getCyborg()};";
        } elseif( $ennemyId !== NULL && $factories[ $ennemyId ]->getCyborg() < $sendToConquest && $conquest[ 'id' ] === NULL ) {
            $echo .= "MSG CONQUEST;";
            $echo .= "MOVE {$hqId} {$ennemyId} {$sendToConquest};";
            $conquest[ 'id' ] = $ennemyId;
            $conquest[ 'dist' ] = $hq->getDistFrom( $ennemyId );
        }
//        elseif( $ennemyId !== NULL ) {
//            $echo .= "MSG ATTACK;";
//            $send = ( $factories[ $ennemyId ]->getProduction() + 1 );
//            $echo .= "MOVE {$hqId} {$ennemyId} {$send};";
//            /** @var EntityFactory $o */
//            foreach( $owned as $o ) {
//                if( $o->getCyborg() > 10  && $o->getProduction() == 3) {
//                    $generalAttackId = $utilities->getNearestFromHQ( $o, $ennemy, $conquest );
//                    $echo .= "MOVE {$o->getId()} {$generalAttackId} {$o->getProduction()};";
//                }
//            }
//        }
        /** @var EntityFactory $f */
        foreach( $factories as $f ) {
            if( $f->getCyborg() >= 20 && $f->getProduction() < 3 && $f->getOwner() == 1 ) {
                $echo .= "MSG INC;";
                $echo .= "INC {$f->getId()};";
            }
        }
    }

    // TODO : use second BOMB
    // TODO : use multi factories attack
    // TODO : make it state machine foreach factory owned and not just for HQ

//    $levelId = $utilities->getProdLevelToReach( $factories, $level );
//    if( count( $levelId ) == 0 ) {
//        $level--;
//        $levelId = $utilities->getProdLevelToReach( $factories, $level );
//    }

//     Any valid action, such as "WAIT" or "MOVE source destination cyborgs"


    $echo = rtrim( $echo, ";" );
    echo "{$echo}\n";

}

// To debug (equivalent to var_dump): error_log(var_export($var, true));
?>