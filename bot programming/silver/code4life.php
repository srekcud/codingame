<?php

/**
 * Bring data on patient samples from the diagnosis machine to the laboratory with enough molecules to produce medicine!
 **/

/**
 * Class Sample
 */
class Sample
{
    protected $id;
    protected $carrier;
    protected $rank;
    protected $gain;
    protected $health;
    protected $costA;
    protected $costB;
    protected $costC;
    protected $costD;
    protected $costE;
    protected $totalCost;

    /**
     * Sample constructor.
     *
     * @param $id
     * @param $carrier
     * @param $rank
     * @param $gain
     * @param $health
     * @param $costA
     * @param $costB
     * @param $costC
     * @param $costD
     * @param $costE
     */
    public function __construct( $id, $carrier, $rank, $gain, $health, $costA, $costB, $costC, $costD, $costE )
    {
        $this->setId( $id );
        $this->setCarrier( $carrier );
        $this->setRank( $rank );
        $this->setGain( $gain );
        $this->setHealth( $health );
        $this->setCostA( $costA );
        $this->setCostB( $costB );
        $this->setCostC( $costC );
        $this->setCostD( $costD );
        $this->setCostE( $costE );
        $this->setTotalCost( $costA, $costB, $costC, $costD, $costE );
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
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param mixed $carrier
     */
    public function setCarrier( $carrier )
    {
        $this->carrier = $carrier;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank( $rank )
    {
        $this->rank = $rank;
    }

    /**
     * @return mixed
     */
    public function getGain()
    {
        return $this->gain;
    }

    /**
     * @param mixed $gain
     */
    public function setGain( $gain )
    {
        $this->gain = $gain;
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
    public function getCostA()
    {
        return $this->costA;
    }

    /**
     * @param mixed $costA
     */
    public function setCostA( $costA )
    {
        $this->costA = $costA;
    }

    /**
     * @return mixed
     */
    public function getCostB()
    {
        return $this->costB;
    }

    /**
     * @param mixed $costB
     */
    public function setCostB( $costB )
    {
        $this->costB = $costB;
    }

    /**
     * @return mixed
     */
    public function getCostC()
    {
        return $this->costC;
    }

    /**
     * @param mixed $costC
     */
    public function setCostC( $costC )
    {
        $this->costC = $costC;
    }

    /**
     * @return mixed
     */
    public function getCostD()
    {
        return $this->costD;
    }

    /**
     * @param mixed $costD
     */
    public function setCostD( $costD )
    {
        $this->costD = $costD;
    }

    /**
     * @return mixed
     */
    public function getCostE()
    {
        return $this->costE;
    }

    /**
     * @param mixed $costE
     */
    public function setCostE( $costE )
    {
        $this->costE = $costE;
    }

    /**
     * @return mixed
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param $costA
     * @param $costB
     * @param $costC
     * @param $costD
     * @param $costE
     */
    public function setTotalCost( $costA, $costB, $costC, $costD, $costE )
    {
        $this->totalCost = $costA + $costB + $costC + $costD + $costE;
    }


}

/**
 * Class Robot
 */
class Robot
{
    protected $target;
    protected $eta;
    protected $score;
    protected $storageA;
    protected $storageB;
    protected $storageC;
    protected $storageD;
    protected $storageE;
    protected $expertiseA;
    protected $expertiseB;
    protected $expertiseC;
    protected $expertiseD;
    protected $expertiseE;
    protected $totalExpertise;
    protected $totalStorage;

    /**
     * Robot constructor.
     *
     * @param $target
     * @param $eta
     * @param $score
     * @param $storageA
     * @param $storageB
     * @param $storageC
     * @param $storageD
     * @param $storageE
     * @param $expertiseA
     * @param $expertiseB
     * @param $expertiseC
     * @param $expertiseD
     * @param $expertiseE
     */
    public function __construct( $target, $eta, $score, $storageA, $storageB, $storageC, $storageD, $storageE,
                                 $expertiseA, $expertiseB, $expertiseC, $expertiseD, $expertiseE )
    {
        $this->setTarget( $target );
        $this->setEta( $eta );
        $this->setScore( $score );
        $this->setStorageA( $storageA );
        $this->setStorageB( $storageB );
        $this->setStorageC( $storageC );
        $this->setStorageD( $storageD );
        $this->setStorageE( $storageE );
        $this->setExpertiseA( $expertiseA );
        $this->setExpertiseB( $expertiseB );
        $this->setExpertiseC( $expertiseC );
        $this->setExpertiseD( $expertiseD );
        $this->setExpertiseE( $expertiseE );
        $this->setTotalExpertise( $expertiseA, $expertiseB, $expertiseC, $expertiseD, $expertiseE );
        $this->setTotalStorage( $storageA, $storageB, $storageC, $storageD, $storageE );
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget( $target )
    {
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getEta()
    {
        return $this->eta;
    }

    /**
     * @param mixed $eta
     */
    public function setEta( $eta )
    {
        $this->eta = $eta;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore( $score )
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getStorageA()
    {
        return $this->storageA;
    }

    /**
     * @param mixed $storageA
     */
    public function setStorageA( $storageA )
    {
        $this->storageA = $storageA;
    }

    /**
     * @return mixed
     */
    public function getStorageB()
    {
        return $this->storageB;
    }

    /**
     * @param mixed $storageB
     */
    public function setStorageB( $storageB )
    {
        $this->storageB = $storageB;
    }

    /**
     * @return mixed
     */
    public function getStorageC()
    {
        return $this->storageC;
    }

    /**
     * @param mixed $storageC
     */
    public function setStorageC( $storageC )
    {
        $this->storageC = $storageC;
    }

    /**
     * @return mixed
     */
    public function getStorageD()
    {
        return $this->storageD;
    }

    /**
     * @param mixed $storageD
     */
    public function setStorageD( $storageD )
    {
        $this->storageD = $storageD;
    }

    /**
     * @return mixed
     */
    public function getStorageE()
    {
        return $this->storageE;
    }

    /**
     * @param mixed $storageE
     */
    public function setStorageE( $storageE )
    {
        $this->storageE = $storageE;
    }

    /**
     * @return mixed
     */
    public function getExpertiseA()
    {
        return $this->expertiseA;
    }

    /**
     * @param mixed $expertiseA
     */
    public function setExpertiseA( $expertiseA )
    {
        $this->expertiseA = $expertiseA;
    }

    /**
     * @return mixed
     */
    public function getExpertiseB()
    {
        return $this->expertiseB;
    }

    /**
     * @param mixed $expertiseB
     */
    public function setExpertiseB( $expertiseB )
    {
        $this->expertiseB = $expertiseB;
    }

    /**
     * @return mixed
     */
    public function getExpertiseC()
    {
        return $this->expertiseC;
    }

    /**
     * @param mixed $expertiseC
     */
    public function setExpertiseC( $expertiseC )
    {
        $this->expertiseC = $expertiseC;
    }

    /**
     * @return mixed
     */
    public function getExpertiseD()
    {
        return $this->expertiseD;
    }

    /**
     * @param mixed $expertiseD
     */
    public function setExpertiseD( $expertiseD )
    {
        $this->expertiseD = $expertiseD;
    }

    /**
     * @return mixed
     */
    public function getExpertiseE()
    {
        return $this->expertiseE;
    }

    /**
     * @param mixed $expertiseE
     */
    public function setExpertiseE( $expertiseE )
    {
        $this->expertiseE = $expertiseE;
    }

    /**
     * @return mixed
     */
    public function getTotalExpertise()
    {
        return $this->totalExpertise;
    }


    public function setTotalExpertise( $expertiseA, $expertiseB, $expertiseC, $expertiseD, $expertiseE )
    {
        $this->totalExpertise = $expertiseA + $expertiseB + $expertiseC + $expertiseD + $expertiseE;
    }

    /**
     * @return mixed
     */
    public function getTotalStorage()
    {
        return $this->totalStorage;
    }


    public function setTotalStorage( $storageA, $storageB, $storageC, $storageD, $storageE )
    {
        $this->totalStorage = $storageA + $storageB + $storageC + $storageD + $storageE;
    }


}

$projects = [];
fscanf( STDIN, "%d",
    $projectCount
);
for( $i = 0; $i < $projectCount; $i++ ) {
    fscanf( STDIN, "%d %d %d %d %d", $a, $b, $c, $d, $e
    );

    $projects[] = [
        $a, $b, $c, $d, $e
    ];
}

$carried = 0;
$totalCarried = 0;
$maxCarried = 3;
$rankToTake = 1;
$myCarryToMole = [];
$index = 0;
$totalA = 0;
$totalB = 0;
$totalC = 0;
$totalD = 0;
$totalE = 0;

function maxOrder($a,$b){
    // TODO USE ALSO THE TOTAL COST
    /** @var sample $a */
    /** @var sample $b */
    if ($a->getRank() == $b->getRank()) {
        if ($a->getHealth() == $b->getHealth()) {
            if ($a->getTotalCost() == $b->getTotalCost()) {
                return 0 ;
            }
            return($a->getTotalCost() < $b->getTotalCost()) ? -1 : 1;
        }
        return($a->getHealth() < $b->getHealth()) ? -1 : 1;
    }
    return ($a->getRank() > $b->getRank()) ? -1 : 1;
}


// game loop
while( TRUE ) {
    $samples = [];
    $robots = [];
    $cloud = [];
    for( $i = 0; $i < 2; $i++ ) {
        fscanf( STDIN, "%s %d %d %d %d %d %d %d %d %d %d %d %d",
            $target, $eta, $score, $storageA, $storageB, $storageC, $storageD, $storageE, $expertiseA, $expertiseB, $expertiseC, $expertiseD, $expertiseE
        );

        $robots[] = new Robot( $target, $eta, $score, $storageA, $storageB, $storageC, $storageD, $storageE,
            $expertiseA, $expertiseB, $expertiseC, $expertiseD, $expertiseE );
    }
    fscanf( STDIN, "%d %d %d %d %d",
        $availableA, $availableB, $availableC, $availableD, $availableE
    );
    fscanf( STDIN, "%d",
        $sampleCount
    );
    for( $i = 0; $i < $sampleCount; $i++ ) {
        fscanf( STDIN, "%d %d %d %s %d %d %d %d %d %d",
            $sampleId, $carriedBy, $rank, $expertiseGain, $health, $costA, $costB, $costC, $costD, $costE
        );
        $samples[ $sampleId ] = new Sample( $sampleId, $carriedBy, $rank, $expertiseGain, $health, $costA, $costB, $costC,
            $costD, $costE );
        if( $carriedBy == -1 ) {
            $cloud[] = new Sample( $sampleId, $carriedBy, $rank, $expertiseGain, $health, $costA, $costB, $costC,
                $costD, $costE );
        }
    }

    /** @var Robot $me */
    $me = $robots[ 0 ];


    if( $me->getEta() == 0 ) {
//        error_log( var_export( $me->getTarget(), TRUE ) );
        switch( $me->getTarget() ) {
            case "START_POS" :
                //ENTRY : START OF THE GAME
                //EXIT :  START OF THE GAME
                //NEXT STATE : SAMPLES
                error_log( var_export( "FROM START TO SAMPLES", TRUE ) );
                echo( "GOTO SAMPLES\n" );
                break;
            case "SAMPLES" :
                //ENTRY : START OF THE GAME | FROM LABORATORY ( 0 SAMPLES ) | FROM MOLECULES ( < 3 SAMPLES )
                //EXIT :  CARRY 3 SAMPLES
                //NEXT STATE : DIAGNOSIS
                error_log( var_export( "CARRIED = {$totalCarried}", TRUE ) );
                if( $carried == $maxCarried ) {
                    echo( "GOTO DIAGNOSIS\n" );
                } else {
                    $carried++;
                    if( $me->getTotalExpertise() >= 6 ) {
                        $rankToTake = 2;
                    }
                    if( $me->getTotalExpertise() >= 12 ) {
                        $rankToTake = 3;
                    }
                    $totalCarried++;
                    echo( "CONNECT {$rankToTake}\n" );
                }
                break;
            case "DIAGNOSIS" :
                //ENTRY : FROM SAMPLE
                //EXIT : ALL SAMPLES LEFT ARE DIAGNOSE AND POSSIBLE TO MAKE OR PUT IN THE CLOUD
                //NEXT STATE : MOLECULES

                $sampleToDiagnose = [];
                $sampleToCloud = [];
                $sampleFromCloud = [];
                $labo = [] ;
                $cloud = [];
                /** @var sample $sample */
                foreach( $samples as $sample ) {
                    if($sample->getCarrier() == -1){
                        $cloud[] = $sample;
                    }
                    if( $sample->getCarrier() == 0 && $sample->getHealth() < 0 ) {
                        error_log( var_export( "SAMPLE TO DIAGNOSE FIND", TRUE ) );
                        $sampleToDiagnose[] = $sample->getId();
                    } elseif( $sample->getCarrier() == 0 && (
                            ( $sample->getCostA() - $me->getExpertiseA() - $me->getStorageA() ) > $availableA
                            || ( $sample->getCostB() - $me->getExpertiseB() - $me->getStorageB() ) > $availableB
                            || ( $sample->getCostC() - $me->getExpertiseC() - $me->getStorageC() ) > $availableC
                            || ( $sample->getCostD() - $me->getExpertiseD() - $me->getStorageD() ) > $availableD
                            || ( $sample->getCostE() - $me->getExpertiseE() - $me->getStorageE() ) > $availableE )
//                        && !empty($cloud)
                    ) {
                        error_log( var_export( "SAMPLE TO CLOUD FIND", TRUE ) );
                        $sampleToCloud[] = $sample->getId();
                    } elseif( $sample->getCarrier() == -1 && (
                            ( $sample->getCostA() - $me->getExpertiseA() - $me->getStorageA() ) <= $availableA
                            && ( $sample->getCostB() - $me->getExpertiseB() - $me->getStorageB() ) <= $availableB
                            && ( $sample->getCostC() - $me->getExpertiseC() - $me->getStorageC() ) <= $availableC
                            && ( $sample->getCostD() - $me->getExpertiseD() - $me->getStorageD() ) <= $availableD
                            && ( $sample->getCostE() - $me->getExpertiseE() - $me->getStorageE() ) <= $availableE
                        )
                    ) {
                        error_log( var_export( "SAMPLE FROM CLOUD FIND", TRUE ) );
                        $sampleFromCloud[] = $sample;
                    }elseif($sample->getCarrier() == 0 && (
                            ( $sample->getCostA() - $me->getExpertiseA() - $me->getStorageA() ) <= 0
                            && ( $sample->getCostB() - $me->getExpertiseB() - $me->getStorageB() ) <= 0
                            && ( $sample->getCostC() - $me->getExpertiseC() - $me->getStorageC() ) <= 0
                            && ( $sample->getCostD() - $me->getExpertiseD() - $me->getStorageD() ) <= 0
                            && ( $sample->getCostE() - $me->getExpertiseE() - $me->getStorageE() ) <= 0
                        )){
                        $labo[] = $sample;
                    }
                }
                if( !empty( $sampleToDiagnose ) ) {
                    $sampleDia = array_pop( $sampleToDiagnose );
                    echo( "CONNECT {$sampleDia}\n" );
                } elseif( !empty( $sampleToCloud ) ) {
                    $sampleCld = array_pop( $sampleToCloud );
                    $carried--;
                    echo( "CONNECT {$sampleCld}\n" );
                } elseif( !empty( $sampleFromCloud ) && $carried < $maxCarried ) {
                    usort($sampleFromCloud, "maxOrder");
                    error_log( var_export( $sampleFromCloud, TRUE ) );
                    $sampleFromCld = array_shift( $sampleFromCloud );
                    $carried++;
                    echo( "CONNECT {$sampleFromCld->getId()}\n" );
                } elseif( $carried == 0 ) {
//                    $maxCarried = 3;
                    echo( "GOTO SAMPLES\n" );
                } elseif(!empty($labo)) {
                    echo( "GOTO LABORATORY\n" );
                }else{
                    echo( "GOTO MOLECULES\n" );
                }
                break;
            case "MOLECULES" :
                //ENTRY : FROM DIAGNOSIS ( 3 ) | FROM LABORATORY ( < 3 )
                //EXIT : THE SAMPLE CHOOSE IS OK TO BE ELABORE TO THE LAB | NOT POSSIBLE TO BUILD GO FOR NEW SAMPLE
                // NEXT STATE : LABORATORY | SAMPLES
                if( empty( $myCarryToMole ) ) {
                    /** @var sample $s */
                    foreach( $samples as $s ) {
                        if( $s->getCarrier() == 0 ) {
                            $myCarryToMole[] = $s;
                        }
                    }
                }
                /** @var sample $sample */
                $sample = $myCarryToMole[ $index ];

                $A = ( $me->getStorageA() - $totalA - ( $sample->getCostA() - $me->getExpertiseA() ) );
                $B = ( $me->getStorageB() - $totalB - ( $sample->getCostB() - $me->getExpertiseB() ) );
                $C = ( $me->getStorageC() - $totalC - ( $sample->getCostC() - $me->getExpertiseC() ) );
                $D = ( $me->getStorageD() - $totalD - ( $sample->getCostD() - $me->getExpertiseD() ) );
                $E = ( $me->getStorageE() - $totalE - ( $sample->getCostE() - $me->getExpertiseE() ) );
                if( $A < 0 && $availableA > 0 && $me->getTotalStorage() <= 9 ) {
                    echo( "CONNECT A\n" );
                } elseif( $B < 0 && $availableB > 0 && $me->getTotalStorage() <= 9 ) {
                    echo( "CONNECT B\n" );
                } elseif( $C < 0 && $availableC > 0 && $me->getTotalStorage() <= 9 ) {
                    echo( "CONNECT C\n" );
                } elseif( $D < 0 && $availableD > 0 && $me->getTotalStorage() <= 9 ) {
                    echo( "CONNECT D\n" );
                } elseif( $E < 0 && $availableE > 0 && $me->getTotalStorage() <= 9 ) {
                    echo( "CONNECT E\n" );
                } elseif( $me->getTotalStorage() <= 9 && $index < count( $myCarryToMole ) - 1 ) {
                    $index++;
                    $totalA += $sample->getCostA();
                    $totalB += $sample->getCostB();
                    $totalC += $sample->getCostC();
                    $totalD += $sample->getCostD();
                    $totalE += $sample->getCostE();

                    $sample = $myCarryToMole[ $index ];
                    error_log( var_export( $index, TRUE ) );

                    $A = ( $me->getStorageA() - $totalA - ( $sample->getCostA() - $me->getExpertiseA() ) );
                    $B = ( $me->getStorageB() - $totalB - ( $sample->getCostB() - $me->getExpertiseB() ) );
                    $C = ( $me->getStorageC() - $totalC - ( $sample->getCostC() - $me->getExpertiseC() ) );
                    $D = ( $me->getStorageD() - $totalD - ( $sample->getCostD() - $me->getExpertiseD() ) );
                    $E = ( $me->getStorageE() - $totalE - ( $sample->getCostE() - $me->getExpertiseE() ) );
                    if( $A < 0 && $availableA > 0 && $me->getTotalStorage() <= 9 ) {
                        echo( "CONNECT A\n" );
                    } elseif( $B < 0 && $availableB > 0 && $me->getTotalStorage() <= 9 ) {
                        echo( "CONNECT B\n" );
                    } elseif( $C < 0 && $availableC > 0 && $me->getTotalStorage() <= 9 ) {
                        echo( "CONNECT C\n" );
                    } elseif( $D < 0 && $availableD > 0 && $me->getTotalStorage() <= 9 ) {
                        echo( "CONNECT D\n" );
                    } elseif( $E < 0 && $availableE > 0 && $me->getTotalStorage() <= 9 ) {
                        echo( "CONNECT E\n" );
                    } else {
                        $myCarryToMole = [];
                        $index = 0;
                        $totalA = 0;
                        $totalB = 0;
                        $totalC = 0;
                        $totalD = 0;
                        $totalE = 0;
                        echo( "GOTO LABORATORY\n" );
                    }
                } else {
                    $myCarryToMole = [];
                    $index = 0;
                    $totalA = 0;
                    $totalB = 0;
                    $totalC = 0;
                    $totalD = 0;
                    $totalE = 0;
                    echo( "GOTO LABORATORY\n" );
                }
                break;
            case "LABORATORY" :
                //ENTRY : FROM MOLECULES
                //EXIT : MORE SAMPLES | NO MORE SAMPLES
                // NEXT STATE : MOLECULES | SAMPLES
                $myCarryToLabo = [] ;
                $sampleToMole = [] ;
                $sampleFromCloud = [] ;
                /** @var sample $s */
                foreach( $samples as $s ) {
                    if( $s->getCarrier() == 0
                        && ($me->getStorageA() + $me->getExpertiseA() >= $s->getCostA() )
                        && ($me->getStorageB() + $me->getExpertiseB() >= $s->getCostB() )
                        && ($me->getStorageC() + $me->getExpertiseC() >= $s->getCostC() )
                        && ($me->getStorageD() + $me->getExpertiseD() >= $s->getCostD() )
                        && ($me->getStorageE() + $me->getExpertiseE() >= $s->getCostE() )
                    ){
                        $myCarryToLabo[] = $s;
                    }elseif( $s->getCarrier() == 0 && (
                            ( $s->getCostA() - $me->getExpertiseA() - $me->getStorageA() ) <= $availableA
                            && ( $s->getCostB() - $me->getExpertiseB() - $me->getStorageB() ) <= $availableB
                            && ( $s->getCostC() - $me->getExpertiseC() - $me->getStorageC() ) <= $availableC
                            && ( $s->getCostD() - $me->getExpertiseD() - $me->getStorageD() ) <= $availableD
                            && ( $s->getCostE() - $me->getExpertiseE() - $me->getStorageE() ) <= $availableE
                        )
                    ){
                        $sampleToMole[] = $s->getId();
                    }elseif( $s->getCarrier() == -1 && (
                            ( $s->getCostA() - $me->getExpertiseA() - $me->getStorageA() ) <= $availableA
                            && ( $s->getCostB() - $me->getExpertiseB() - $me->getStorageB() ) <= $availableB
                            && ( $s->getCostC() - $me->getExpertiseC() - $me->getStorageC() ) <= $availableC
                            && ( $s->getCostD() - $me->getExpertiseD() - $me->getStorageD() ) <= $availableD
                            && ( $s->getCostE() - $me->getExpertiseE() - $me->getStorageE() ) <= $availableE
                        )
                    ){
                        $sampleFromCloud[] = $s->getId();
                    }
                }
                if(!empty($myCarryToLabo)){
                    /** @var sample $sample */
                    $sample = $myCarryToLabo[0];
                    $carried--;
                    $return = false;
                    echo("CONNECT {$sample->getId()}\n");

                }elseif( !empty($sampleToMole) && $me->getTotalStorage() < 10 ) {
                    echo( "GOTO MOLECULES\n" );
                }elseif( count( $sampleFromCloud ) > 1 || $carried == 3 ) {
                    echo( "GOTO DIAGNOSIS\n" );
                } elseif($carried < 3) {
                    echo( "GOTO SAMPLES\n" );
                }
                break;
        }
    } else {
        echo( "WAIT \n" );
    }
}
?>