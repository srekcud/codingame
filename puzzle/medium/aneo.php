<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d", $speed);
fscanf(STDIN, "%d", $lightCount);
for ($i = 0; $i < $lightCount; $i++)
{
    fscanf(STDIN, "%d %d", $distance, $duration);

    $light[]=["distance"=>$distance,"duration"=>$duration];
}

// Write an answer using echo(). DON'T FORGET THE TRAILING \n
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)

//error_log(var_export($speed, true));
//error_log(var_export($lightCount, true));
error_log(var_export($light, true));

//$t=200/50*3.6;
//error_log(var_export($t, true));


//temps pour arriver au feu
//$t=$distance/($speed)*3.6;

$go="RED";
while($go=="RED"){
    $go="GREEN";
    foreach($light as $l){
        $t=($l['distance']/$speed)*3.6;

        error_log(var_export($speed, true));
        error_log(var_export($t, true));
        error_log(var_export($t/$l['duration'], true));
        error_log(var_export(($t/$l['duration'])%2, true));
        error_log(var_export("---------------", true));
        if(($t/$l['duration'])%2 ==1){
            $go='RED';
        }

    }

    if($go=="RED"){
        $speed--;
    }
}

echo("$speed\n");

?>