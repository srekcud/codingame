<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%s",
    $LON
);
fscanf(STDIN, "%s",
    $LAT
);
fscanf(STDIN, "%d",
    $N
);
for ($i = 0; $i < $N; $i++)
{
    $DFib[$i] = split(";",str_replace(",",".",stream_get_line(STDIN, 256 + 1, "\n")));

}
$LON = str_replace(",",".",$LON);
$LAT = str_replace(",",".",$LAT);
//error_log(var_export($DFib, true));
// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));
$min = PHP_INT_MAX ;
$answers = null ;
for($i=0;$i<$N;$i++){
    // deg2rad
    $x = ((deg2rad($DFib[$i][4]) - deg2rad($LON)) * cos((deg2rad($LAT) + deg2rad($DFib[$i][5]))/2)) ;
    $y = (deg2rad($DFib[$i][5]) - deg2rad($LAT)) ;
    $d = sqrt(pow($x,2)+pow($y,2)) * 6371 ;
    // error_log(var_export($d, true));
    if( $d < $min ){
        $answers = $DFib[$i][1];
        $min = $d ;
    }
}
echo($answers."\n");
?>