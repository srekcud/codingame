<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

class Pyramid
{

    public $pyramid;
    public function __construct($total){
        $baseLine = $this->calculateBaseLine($total);
        // echo($baseLine);
        $this->pyramid = $this->constructPyramid($baseLine,$total);

    }

    //( (pow($baseLine,2) + $baseLine) / 2 )
    public function calculateBaseLine($total){

        if($total == 1){
            $return = 1;
        }elseif($total == 2){
            $return = 2;
        }else{
            $baseLine = 1;
            while(( (pow($baseLine+1,2) + $baseLine+1) / 2 ) <= $total){
                $baseLine++;
            }

            $return = $baseLine;
        }

        return $return;
    }

    public function constructPyramid($baseLine,$total){

        $return = [];
        $line = $baseLine;

        while($line > 0 && $total >0){
            $return[] = $line;
            $total-= $line;
            $line--;
        }

        if(count($return) == $total){
            foreach($return as &$r){
                $r++;
            }
        }


        return $return;
    }

    public function draw(){
        $pyramid = $this->pyramid;
        $return = "";

        for($i=count($pyramid)-1 ; $i>=0;$i--){
            $tmp = "";
            for($j=0;$j<$pyramid[$i];$j++){
                $tmp.="*";
            }
            $tmp.="\n";
            $return .= $tmp;
        }

        return $return;
    }
}



fscanf(STDIN, "%d",
    $N
);
// https://fr.wikipedia.org/wiki/Nombre_triangulaire

$pyra = new Pyramid($N);

echo($pyra->draw());
?>