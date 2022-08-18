<?php

class Point
{
    protected $x;
    protected $y;

    /**
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
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
}

class Human extends Point
{
    protected $id;

    public function __construct($id, $x, $y)
    {
        parent::__construct($x, $y);
        $this->setId($id);
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
    public function setId($id): void
    {
        $this->id = $id;
    }

}

class Zombie extends Human
{
    public function __construct($id, $x, $y)
    {
        parent::__construct($id,$x, $y);
    }

}

class Ash extends Point
{
    public function __construct($x, $y)
    {
        parent::__construct( $x, $y);
    }
}

class Utilities
{
    public function getDistance($a, $b)
    {
        return sqrt( pow($b->getX() - $a->getX(),2) + pow($b->getY() - $a->getY(),2) ) ;
    }

    public function getCoordFromDist($depart,$target,$dist)
    {
        //error_log(var_export($depart, true));
        //error_log(var_export($target, true));
        //error_log(var_export($this->getDistance($depart,$target), true));
        $point = [];
        if($this->getDistance($depart,$target) <= $dist){
            $point[] = new Point($target->getX(),$target->getY());
        }elseif( $depart->getX() == $target->getX() ){
            $x = $depart->getX();
            $dy = $depart->getY();
            for($y=0;$y<=9000;$y++){
                //error_log(var_export(floor(sqrt(pow($y - $dy,2))),true));
                if(floor(sqrt(pow($y - $dy,2))) == $dist){
                    $point[] = new Point($x,$y);
                }
            }
        }elseif($depart->getY() == $target->getY()){
            $y = $depart->getY();
            $dx = $depart->getX();
            for($x=0;$x<=16000;$x++){
                if(floor(sqrt(pow($x - $dx,2) )) == $dist){
                    $point[] = new Point($x,$y);
                }
            }
        }else{
            //error_log(var_export("C",true));
            $m = (($target->getY() - $depart->getY()) / (($target->getX() - $depart->getX())));
            //error_log(var_export($m, true));
            $b = $depart->getY() - $m * $depart->getX();
            //error_log(var_export($b, true));
            //$y = ($m * $x) + $b;
            $dx = $depart->getX();
            $dy = $depart->getY();

            for($x=0;$x<=16000;$x++){
                $y = floor(($m*$x)+$b);
                //error_log(var_export($y, true));
                //error_log(var_export(floor(sqrt(pow($x - $dx,2) + pow($y - $dy,2))),true));
                $d = floor(sqrt(pow($x - $dx,2) + pow($y - $dy,2)));
                if( ($d == $dist/*+20 && $d >= $dist-20*/)&&
                    $y >=0 &&
                    $y<=9000){
                    $point[] = new Point($x,floor($y));
                }
            }
        }
        //error_log(var_export($point, true));
        $nPoint = $this->getNearest($point,$target);


        return $nPoint;

    }

    public function getNearest(array $humans, $a)
    {
        $min = 99999999;
        foreach ($humans as $h){
            $dist = $this->getDistance($h,$a);
            if($dist <= $min){
                $min = $dist;
                $target = $h;
            }
        }

        return $target;
    }

    public function simulateAshMove(Ash $ash,array $humans,array $zombies)
    {
        // stay
        $ashCoord[] = new Point($ash->getX(),$ash->getY());
        // go to nearest zombie
        $nearestZombie = $this->getNearest($zombies,$ash);
        error_log(var_export($nearestZombie, true));
        //$c = $this->getCoordFromDist($ash,$nearestZombie,1000);
        //if ( is_a($c, 'Point')) $ashCoord[] = $c;
        // got to nearest human
        //$nearestHuman = $this->getNearest($humans,$ash);
        //$c = $this->getCoordFromDist($ash,$nearestHuman,1000);
        //if ( is_a($c, 'Point')) $ashCoord[] = $c;
        // random move
        //$ashCoord[] = new Point();

        return $ashCoord;
    }

    public function simulateTurn(Ash $ash,array $humans, array $zombies )
    {
        $start = microtime(TRUE);

        $combo = 0;
        $comboMult = [0,1,2,3,5,8];

        //#### Zombie move
        /** @var Zombie $z */
        foreach($zombies as $z){
            $nearestHuman = $this->getNearest($humans,$z);
            /** @var Point $coord */
            $coord = $this->getCoordFromDist($z,$nearestHuman,400);
            $z->setX($coord->getX());
            $z->setY($coord->getY());
        }

        //#### Ash move
        $ashCoord = $this->simulateAshMove($ash,$humans,$zombies);
        $maxScore = -999999 ;
        /** @var Point $c */
        foreach($ashCoord as $c) {
            $ash->setX($c->getX());
            $ash->setY($c->getY());
            //#### Ash kill
            foreach ($zombies as $z) {
                if ($this->getDistance($ash, $z) <= 2000) {
                    unset($zombies[$z->getId()]);
                    $combo++;
                }
            }
            //#### Score
            $score = pow(count($humans), 2) * 10 * $comboMult[$combo];
            //#### Zombie kill
            foreach ($zombies as $z) {
                $nearestHuman = $this->getNearest($humans, $z);
                if ($this->getDistance($nearestHuman, $z) == 0) {
                    //error_log(var_export("kill", true));
                    unset($humans[$nearestHuman->getId()]);
                    $score -= 1000;
                    if (count($humans) == 0) $score -= 10000;
                }
            }
            //error_log(var_export("score : ".$score, true));
            if($score >= $maxScore){
                $return = $c ;
                $maxScore = $score;
            }
        }
        $time_elapsed = (microtime(TRUE) - $start);
        //error_log(var_export("time : ".$time_elapsed, true));

        $ash->setX($return->getx());
        $ash->setY($return->getY());
        return $return;
    }

}

// game loop
while (TRUE)
{
    $utilities = new Utilities();
    $humans = $zombies = [];
    fscanf(STDIN, "%d %d", $x, $y);
    $ash = new Ash($x,$y);
    fscanf(STDIN, "%d", $humanCount);
    for ($i = 0; $i < $humanCount; $i++)
    {
        fscanf(STDIN, "%d %d %d", $humanId, $humanX, $humanY);
        $humans[] = new Human($humanId,$humanX,$humanY);
    }
    fscanf(STDIN, "%d", $zombieCount);
    for ($i = 0; $i < $zombieCount; $i++)
    {
        fscanf(STDIN, "%d %d %d %d %d", $zombieId, $zombieX, $zombieY, $zombieXNext, $zombieYNext);
        $zombies[] = new Zombie($zombieId,$zombieX,$zombieY);
    }

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug: error_log(var_export($var, true)); (equivalent to var_dump)

    //error_log(var_export($ash, true));
    //error_log(var_export($humans, true));
    //error_log(var_export($zombies, true));

    //$zombies = [];
    //$zombies[] = new Zombie(0,0,8000);
    //$ash = new Ash(0,1000);

    $coord = $utilities->simulateTurn($ash,$humans,$zombies);
    error_log(var_export($ash, true));
    //error_log(var_export($humans, true));
    error_log(var_export($zombies, true));


    echo("{$coord->getX()} {$coord->getY()}\n");
}
// a chaque tour regarder pour chaque humain en combien de tour le zombie le + proche le tue
// et regarder en combien de tour moi je tue le zombie le plus dangereux
// si l'humain est de tte facon mort regarder le 2e plus dangereux , etc
?>
