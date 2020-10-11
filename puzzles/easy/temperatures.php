<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 12-09-16
 * Time: 18:44
 */

/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $n // the number of temperatures to analyse
);

if($n == 0 ){
    echo 0 ;
}else{


    $tempsLine = stream_get_line(STDIN, 256 + 1, "\n"); // the n temperatures expressed as integers ranging from -273 to 5526

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));
    $tArray = explode(" ",$tempsLine);
    $minT = 5527 ;
//$min = min(abs($tArray));

    for($i=0;$i<$n;$i++){
        if(abs($tArray[$i]) < abs($minT) ||( $tArray[$i] == -$minT && $tArray[$i] > 0)){
            $minT = $tArray[$i] ;
        }
    }

    echo($minT."\n");
}

?>