<?php

class Utilities
{

    public function getBaseDistance(Hero $a, $baseX,$baseY)
    {
        return sqrt( pow($baseX - $a->getX(),2) + pow($baseY - $a->getY(),2) ) ;
    }
    public function getDistance(Hero $a, Monster $b)
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
            if( $d < $min && $h->getTarget() == -1 )
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
        $return = -1;
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


    public function __construct( $id, $x, $y, $health, $vx, $vy, $nearBase, $threatFor,$shieldLife,$isControlled )
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

    public function __construct($id, $x, $y)
    {
        parent::__construct($id, $x, $y);
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


}

fscanf(STDIN, "%d %d", $baseX, $baseY);
// (0,0) || (17630,9000)
if($baseX == 0){
    $enemyBase = ['x'=>17630, 'y'=>9000];
}else {
    $enemyBase = ['x'=>0,'y'=>0];
}

fscanf(STDIN, "%d", $heroesPerPlayer);

// game loop
$target = [-1,-1,-1];

while (TRUE)
{
    $danger=$heroes=$monsters=[];
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

        }elseif( $type == 0 && $threatFor != 1 && $isControlled == 0){
            $monsters[$id] = new Monster( $id, $x, $y, $health, $vx, $vy, $nearBase, $threatFor,$shieldLife,$isControlled );

        }elseif( $type == 1){
            $heroes[$id] = new Hero( $id, $x, $y);
            //error_log(var_export($heroes, true));

        }
    }
    //error_log(var_export("danger: ". count($danger), true));
    //error_log(var_export("monster: ". count($monsters), true));
    foreach ($danger as $m){
        $h = $utilities->getNearestHero($m,$heroes);
        if (is_a($h, 'Hero')) $heroes[$h->getId()]->setTarget($h->getTarget());
    }
    for ($i = 0; $i < $heroesPerPlayer; $i++)
    {
        if($baseX != 0){
            $j = 3 + $i;
        }else{
            $j = $i;
        }
        $t = $heroes[$j]->getTarget();
        if($i == 2 && count($monsters) > 0 && count($danger) < 3){

             $danger = $monsters;
             if(!array_key_exists($target[2],$danger)){
                 $t = $utilities->getNearestMonster($heroes[$j],$danger);
                 if ( is_a($t, 'Monster')) {
                     $target[2] = $t->getId();
                     $t = $t->getId();
                 }else{
                     $target[2] = -1;
                     $t = -1;
                 }
             }else{
                 $t = $target[2];
             }
        }
        $bdist = $utilities->getBaseDistance($heroes[$j],$baseX,$baseY);

        if ($t != -1)
        {
            $dist = $utilities->getDistance($heroes[$j],$danger[$t]);
            if($dist <=2200 && $dist > 800 && $myM >= 30 && $danger[$t]->getShieldLife() == 0){
                echo("SPELL CONTROL {$t} {$enemyBase['x']} {$enemyBase['y']} {$j}@{$t}\n");
                $myM-=10;
            }elseif($dist <=1280 &&
                    $myM >= 10 &&
                    ($bdist <= 5000) &&
                    $danger[$t]->getShieldLife() == 0)
                    {
                echo("SPELL WIND {$enemyBase['x']} {$enemyBase['y']} {$j}#{$t}\n");
                $myM-=10;
            }elseif($bdist < 10000){
                $x = ($danger[$t]->getX()+$danger[$t]->getVx());
                $y = ($danger[$t]->getY()+$danger[$t]->getVy());
                echo("MOVE {$x} {$y} {$j}#{$t}\n");
            }else{
                $x = ($danger[$t]->getX()+$danger[$t]->getVx());
                $y = ($danger[$t]->getY()+$danger[$t]->getVy());
                echo("MOVE {$baseX} {$baseY} {$j}!home\n");
            }


        }else{
            switch($heroes[$j]->getId()){
                case 0:
                    echo("MOVE 6000 2000 {$j}\n");
                    break;
                case 1:
                    echo("MOVE 3500 5000 {$j}\n");
                    break;
                case 2:
                    echo("MOVE 4000 3000 {$j}\n");
                    break;
                case 3:
                    echo("MOVE 14000 4000 {$j}\n");
                    break;
                case 4:
                    echo("MOVE 12000 6800 {$j}\n");
                    break;
                case 5:
                    echo("MOVE 13850 5700 {$j}\n");
                    break;
            }
        }

    }
}
// hero bouge de 800 unité par tour
// Wind Rayon = 1280
// Ne pas target les Meeple qui sont un danger pour l'adversaire
// Ne pas spell un Meeple qui est shield
//error_log(var_export($m, true));
?>
