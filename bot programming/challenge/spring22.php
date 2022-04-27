<?php

class Utilities
{

    public function getBaseDistance(Meeple $a, $baseX,$baseY)
    {
        return sqrt( pow($baseX - $a->getX(),2) + pow($baseY - $a->getY(),2) ) ;
    }

    public function getDistance(Hero $a, $b)
    {
        return sqrt( pow($b->getX() - $a->getX(),2) + pow($b->getY() - $a->getY(),2) ) ;
    }

    public function getNearestHero(Monster $monster, array $heroes)
    {
        $min = 9999999999999;
        $return = -1;
        $notTargetable = false ;
        foreach($heroes as $h){
            $d = $this->getDistance($h,$monster);
            if( $h->getId() != 2 && $h->getId() !=  5 && $d < $min && $h->getTarget() == -1 )
            {
                $min = $d;
                $return = $h;
            }
            if($h->getTarget() == $monster->getId() || $monster->getThreatFor() == 2)
            {
                $notTargetable = true;
            }
        }
        if ( is_a($return, 'Hero') && !$notTargetable ) $return->setTarget($monster->getId());
        return $return;
    }

    public function getNearestMonster(Hero $hero,array $monsters)
    {
        $min = 999999999;
        $return = new Monster(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
        foreach($monsters as $m){
            $d = $this->getDistance($hero,$m);
            if( $d < $min && $m->getThreatFor() != 2)
            {
                $min = $d;
                $m->setDistance($d);
                $return = $m;
            }
        }
        return $return;
    }

    public function getNearestMonsterBerzerk(Hero $hero,array $monsters,$baseX,$baseY)
    {
        $min = 999999999;
        $return = new Monster(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
        /** @var Monster $m */
        foreach($monsters as $m){

            $d = $this->getDistance($hero,$m);
            //error_log(var_export($m->getId().' : '.$d, true));
            if( $d < $min && $this->getBaseDistance($m,$baseX,$baseY)> 11000 && $m->getShieldLife() == 0 /*&& $m->getThreatFor() != 2*/)
            {

                $min = $d;
                $m->setDistance($d);
                $return = $m;
            }
        }
        return $return;
    }

    public function getMobById($id, $mob)
    {
        $return = new Monster(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);
        foreach($mob as $m)
        {
            if($m->getId() == $id){
                $return=$m;
            }
        }

        return $return;
    }

    public function getMove($t,$shield,$h,$myM,$danger,$mob,$maxHealth,$enemyBase,$bdist,$baseX,$baseY,$loop = 0)
    {
        if($t == -1 )
        {
            error_log(var_export("A", true));
            if($shield) {
                $return = "SPELL SHIELD {$h->getId()} ---\n";
                $myM -= 10;
            }elseif(count($mob)>0 && $loop == 0){
                $mobTarget = $this->getNearestMonster($h,$mob);
                error_log(var_export($mobTarget, true));
                $return = $this->getMove($mobTarget->getId(),$shield,$h,$myM,$danger,$mob,$maxHealth,$enemyBase,$bdist,$baseX,$baseY,$loop = 1);
            }else {
                switch ($h->getId()) {
                    case 0:
                        $return = "MOVE 6000 2000 0\n";
                        break;
                    case 1:
                        $return = "MOVE 3500 5000 1\n";
                        break;
                    case 3:
                        $return = "MOVE 14000 4000 3\n";
                        break;
                    case 4:
                        $return = "MOVE 12000 6800 4\n";
                        break;
                }
            }

        }else{
            error_log(var_export("B", true));
            /** @var Monster $mobTarget */
            $mobTarget = $this->getMobById($t, $danger + $mob);
            $dist = $this->getDistance($h,$mobTarget);

            if($bdist > 8000){
                $return = "MOVE {$baseX} {$baseY} {$h->getId()} HOME !\n";
            }
            if($shield){
                $return = "SPELL SHIELD {$h->getId()} ---\n";
                $myM-=10;
            }elseif($mobTarget->getHealth() == $maxHealth &&
                $mobTarget->getBaseDistance() >4700 &&
                $dist <=2200 &&
                //$dist > 800 &&
                $myM >= 30 &&
                $mobTarget->getShieldLife() == 0 &&
                $mobTarget->getThreatFor() != 2){
                $return = "SPELL CONTROL {$t} {$enemyBase['x']} {$enemyBase['y']} {$h->getId()}@{$t}\n";
                $myM-=10;
            }elseif($dist <=1280 &&
                $myM >= 10 &&
                ($bdist <= 5000) &&
                $mobTarget->getShieldLife() == 0)
            {
                $return = "SPELL WIND {$enemyBase['x']} {$enemyBase['y']} {$h->getId()}W{$t}\n";
                $myM-=10;
            }else {

                $x = ($mobTarget->getX() + $mobTarget->getVx());
                $y = ($mobTarget->getY() + $mobTarget->getVy());
                $return = "MOVE {$x} {$y} {$h->getId()}#{$t}\n";
            }
        }

        return $return;
    }

    public function getMoveBerzerker($h,$myM,$danger,$mob,$maxHealth,$enemyBase,$bdist,$baseX,$baseY)
    {
        /** @var Monster $mobTarget */
        /** @var Hero $h */
        if($h->getTarget() != -1){
            $mobTarget = $this->getMobById($h->getTarget(),$mob);
        }else {
            $mobTarget = $this->getNearestMonsterBerzerk($h, $mob+$danger,$baseX,$baseY);

        }
        if($mobTarget->getId() == -1 )
        {
            switch ($h->getId()) {
                case 2:
                    //echo("MOVE 4000 3000 {$j}\n");
                    //$return = "MOVE 8700 4500 2\n";
                    $return = "MOVE 12700 6400 2\n";
                    break;
                case 5:
                    //echo("MOVE 13850 5700 {$j}\n");
                    //$return = "MOVE 8700 4500 5\n";
                    $return = "MOVE 4700 3400 5\n";
                    break;
            }
        }else{

            $dist = $this->getDistance($h,$mobTarget) ;
            $mobTarget->setBaseDistance($this->getBaseDistance($mobTarget,$baseX,$baseY));
            if($mobTarget->getBaseDistance() > 13000 && $myM >= 30 && $mobTarget->getThreatFor() == 2){
                $return = "SPELL SHIELD {$mobTarget->getId()} {$h->getId()}---{$mobTarget->getId()}\n";
                $myM -= 10;
            }elseif($dist <=2200 &&
                //$dist > 800 &&
                $myM >= 30 &&
                $mobTarget->getHealth() == $maxHealth &&
                $maxHealth >= 14 &&
                $mobTarget->getShieldLife() == 0 &&
                $mobTarget->getThreatFor() != 2){
                $return = "SPELL CONTROL {$mobTarget->getId()} {$enemyBase['x']} {$enemyBase['y']} {$h->getId()}@{$mobTarget->getId()}\n";
                $myM-=10;
            }elseif($dist <=1280 &&
                $myM >= 30 &&
                $mobTarget->getShieldLife() == 0)
            {
                $return = "SPELL WIND {$enemyBase['x']} {$enemyBase['y']} {$h->getId()}W{$mobTarget->getId()}\n";
                $myM-=10;
            }else {

                $x = ($mobTarget->getX() + $mobTarget->getVx());
                $y = ($mobTarget->getY() + $mobTarget->getVy());
                $return = "MOVE {$x} {$y} {$h->getId()}#{$mobTarget->getId()}\n";
            }
        }

        return $return;
    }
}

class Meeple
{
    protected $id;
    protected $x;
    protected $y;

    public function __construct( $id, $x, $y)
    {
        $this->setId($id);
        $this->setX($x);
        $this->setY($y);
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
    public function setId($id)
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
    public function setX($x)
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
    public function setY($y)
    {
        $this->y = $y;
    }
}

class Monster extends Meeple
{

    protected $health;
    protected $vx;
    protected $vy;
    protected $nearBase;
    protected $threatFor;
    protected $distance;
    protected $shieldLife;
    protected $isControlled;
    protected $baseDistance;


    public function __construct( $id, $x, $y, $health, $vx, $vy, $nearBase, $threatFor,$shieldLife,$isControlled)
    {
        parent::__construct($id, $x, $y);
        $this->setHealth($health);
        $this->setVx($vx);
        $this->setVy($vy);
        $this->setNearBase($nearBase);
        $this->setThreatFor($threatFor);
        $this->setShieldLife($shieldLife);
        $this->setIsControlled($isControlled);
    }

    /**
     * @return mixed
     */
    public function getBaseDistance()
    {
        return $this->baseDistance;
    }

    /**
     * @param mixed $baseDistance
     */
    public function setBaseDistance($baseDistance): void
    {
        $this->baseDistance = $baseDistance;
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
    public function setHealth($health)
    {
        $this->health = $health;
    }

    /**
     * @return mixed
     */
    public function getVx()
    {
        return $this->vx;
    }

    /**
     * @param mixed $vx
     */
    public function setVx($vx)
    {
        $this->vx = $vx;
    }

    /**
     * @return mixed
     */
    public function getVy()
    {
        return $this->vy;
    }

    /**
     * @param mixed $vy
     */
    public function setVy($vy)
    {
        $this->vy = $vy;
    }

    /**
     * @return mixed
     */
    public function getNearBase()
    {
        return $this->nearBase;
    }

    /**
     * @param mixed $nearBase
     */
    public function setNearBase($nearBase)
    {
        $this->nearBase = $nearBase;
    }

    /**
     * @return mixed
     */
    public function getThreatFor()
    {
        return $this->threatFor;
    }

    /**
     * @param mixed $threatFor
     */
    public function setThreatFor($threatFor)
    {
        $this->threatFor = $threatFor;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getShieldLife()
    {
        return $this->shieldLife;
    }

    /**
     * @param mixed $shieldLife
     */
    public function setShieldLife($shieldLife): void
    {
        $this->shieldLife = $shieldLife;
    }

    /**
     * @return mixed
     */
    public function getIsControlled()
    {
        return $this->isControlled;
    }

    /**
     * @param mixed $isControlled
     */
    public function setIsControlled($isControlled): void
    {
        $this->isControlled = $isControlled;
    }


}

class Hero extends Meeple
{
    protected $target = -1;
    protected $shieldLife;
    protected $isControlled;

    public function __construct($id, $x, $y, $shieldLife, $isControlled)
    {
        parent::__construct($id, $x, $y);
        $this->setIsControlled($isControlled);
        $this->setShieldLife($shieldLife);
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
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getIsControlled()
    {
        return $this->isControlled;
    }

    /**
     * @param mixed $isControlled
     */
    public function setIsControlled($isControlled): void
    {
        $this->isControlled = $isControlled;
    }

    /**
     * @return mixed
     */
    public function getShieldLife()
    {
        return $this->shieldLife;
    }

    /**
     * @param mixed $shieldLife
     */
    public function setShieldLife($shieldLife): void
    {
        $this->shieldLife = $shieldLife;
    }



}

fscanf(STDIN, "%d %d", $baseX, $baseY);
// (0,0) || (17630,9000)
if($baseX == 0){
    $enemyBase = ['x'=>12666, 'y'=>8700];
}else {
    $enemyBase = ['x'=>125,'y'=>4800];
}

fscanf(STDIN, "%d", $heroesPerPlayer);

function d2b($a,$b){
    /** @var Monster $a */
    /** @var Monster $b */
    if ($a->getBaseDistance() == $b->getBaseDistance()) {
        return 0 ;
    }
    return ($a->getBaseDistance() < $b->getBaseDistance()) ? -1 : 1;
}

$maxHealth = 0;
while (TRUE)
{
    $danger=$hero=$mob=$enemy=[];
    $utilities = new Utilities();


    for ($i = 0; $i < 2; $i++)
    {
        fscanf(STDIN, "%d %d", $health, $mana);
        if($i == 0){
            $myH = $health;
            $myM = $mana;
        }
    }
    //error_log(var_export("mana: ".$myM, true));
    fscanf(STDIN, "%d", $entityCount);
    for ($i = 0; $i < $entityCount; $i++)
    {
        fscanf(STDIN, "%d %d %d %d %d %d %d %d %d %d %d", $id, $type, $x, $y, $shieldLife, $isControlled, $health, $vx, $vy, $nearBase, $threatFor);
        if( $type == 0 && $threatFor == 1){
            $danger[$id] = new Monster( $id, $x, $y, $health, $vx, $vy, $nearBase, $threatFor,$shieldLife,$isControlled );
            $danger[$id]->setBaseDistance($utilities->getBaseDistance($danger[$id],$baseX,$baseY));
            if($maxHealth < $health) $maxHealth = $health;
        }elseif( $type == 0 && $isControlled == 0){
            $mob[$id] = new Monster( $id, $x, $y, $health, $vx, $vy, $nearBase, $threatFor,$shieldLife,$isControlled );
            if($maxHealth < $health) $maxHealth = $health;
        }elseif( $type == 1){
            $hero[] = new Hero( $id, $x, $y,$shieldLife,$isControlled);
        }elseif( $type == 2){
            $enemy[] = new Hero( $id, $x, $y,$shieldLife,$isControlled);
        }
    }
    //error_log(var_export("danger: ". count($danger), true));
    //error_log(var_export("monster: ". count($monsters), true));
    usort($danger, "d2b");
    //error_log(var_export($danger, true));
    foreach ($danger as $m){
        $h = $utilities->getNearestHero($m,$hero);
        //error_log(var_export($h, true));
        //error_log(var_export($hero, true));
        if (is_a($h, 'Hero') && $h->getId() < 3){
            $hero[$h->getId()]->setTarget($h->getTarget());
        }elseif(is_a($h, 'Hero')){
            $hero[$h->getId()-3]->setTarget($h->getTarget());
        }
    }
    for ($i = 0; $i < $heroesPerPlayer-1; $i++)
    {
        /** @var Hero $h */
        $h = $hero[$i];
        $t = $h->getTarget();
        $bdist = $utilities->getBaseDistance($h,$baseX,$baseY);
        //error_log(var_export($bdist, true));
        $shield = FALSE;
        foreach ($enemy as $e){
            //error_log(var_export("ed: ".$utilities->getDistance($h,$e), true));
            if($utilities->getDistance($h,$e) < 3000 && $h->getShieldLife() == 0 && $myM >=10 && $mana >=10){
                $shield = TRUE;
            }
        }

        $move = $utilities->getMove($t,$shield,$h,$myM,$danger,$mob,$maxHealth,$enemyBase,$bdist,$baseX,$baseY);

        echo($move);
    }
    $h = $hero[2];
    $bdist = $utilities->getBaseDistance($h,$baseX,$baseY);

    $move = $utilities->getMoveBerzerker($h,$myM,$danger,$mob,$maxHealth,$enemyBase,$bdist,$baseX,$baseY);

    echo($move);
}
// Mob bouge de 400 u
// hero bouge de 800 unité par tour
// Wind Rayon = 1280
// Ne pas target les Meeple qui sont un danger pour l'adversaire
// Ne pas spell un Meeple qui est shield
//error_log(var_export($m, true));

// essayer de shield les threatforenemy
// essayer de shield les mob a moins de 12 tours de la base ennemie
// Ne pas control 2 fois le meme Meeple
// ne pas control un mob qui n'a pas la vie max sauf si threat
// Wind si 4 mob touché
// ne pas control 2* le meme mob
//check pq autant de mana

// shield mob si ebdist < 6000
?>