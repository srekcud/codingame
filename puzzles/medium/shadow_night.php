<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d %d",$W,$H);
fscanf(STDIN,"%d",$N);
fscanf(STDIN,"%d %d",$X,$Y);
$sZone = array(array(0,$W),array(0,$H));
// array(0,4),array(0,8)
// game loop

while (TRUE)
{
    fscanf(STDIN,"%s",$bombDir);
    if(preg_match("/U/",$bombDir)) $sZone[1][1] = $Y ;
    if(preg_match("/D/",$bombDir)) $sZone[1][0] = $Y ;
    if(preg_match("/R/",$bombDir)) $sZone[0][0] = $X ;
    if(preg_match("/L/",$bombDir)) $sZone[0][1] = $X ;

    $X = round(( $sZone[0][0]+ ( ($sZone[0][1]-$sZone[0][0]) /2) ), 0, PHP_ROUND_HALF_DOWN);;
    $Y = round(( $sZone[1][0]+ ( ($sZone[1][1]-$sZone[1][0]) /2) ), 0, PHP_ROUND_HALF_DOWN);;
    echo ($X." ".$Y."\n");
}
?>