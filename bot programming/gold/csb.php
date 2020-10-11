<?php
$boost = true ;
$previousX = $previousY = 0;
function clamp($min, $max, $current)
{
	return max($min, min($max, $current));
}

// game loop
while (TRUE)
{
    fscanf(STDIN, "%d %d %d %d %d %d",
        $x,
        $y,
        $nextCheckpointX, // x position of the next check point
        $nextCheckpointY, // y position of the next check point
        $nextCheckpointDist, // distance to the next checkpoint
        $nextCheckpointAngle // angle between your pod orientation and the direction of the next checkpoint
    );
    fscanf(STDIN, "%d %d",
        $opponentX,
        $opponentY
    );

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));


    // You have to output the target position
    // followed by the power (0 <= thrust <= 100)
    // i.e.: "x y thrust"




$angle = abs($nextCheckpointAngle);
$epsilon = 3 ;
$maxSpeed = 100;
$speed = $maxSpeed;
$k = 4 ;
$h = 4 ;
$checkPointRadius = 600;
$angleCoef = $distCoef = 1 ;

if($angle > 90)
{
    $speed = 0;
}elseif( $angle < $epsilon){
    $speed = $maxSpeed;
}else{
    $angleCoef =  ( 1 - clamp(0,1,$angle / 90 )) ;
    $speed = ceil( $maxSpeed * $angleCoef * $distCoef);
}

$distCoef = clamp(0,1,$nextCheckpointDist / ( $k*$checkPointRadius ));
if( $previousX != 0){
    $targetX = $nextCheckpointX - $h *( $x - $previousX);
    $targetY = $nextCheckpointY - $h *( $y - $previousY);
}else{
    $targetX = $nextCheckpointX ;
    $targetY = $nextCheckpointY ;
}
if($boost){
echo ("$targetX $targetY BOOST\n");
$boost = false;
}else{

echo ("$targetX $targetY $speed\n");
}




    error_log(var_export("Dist : ".$nextCheckpointDist, true));
    error_log(var_export("Angle :".$angle, true));
    error_log(var_export("Speed :".$speed, true));
    error_log(var_export("angle Coef :".( 1 - ($angle / 90 )), true));
    error_log(var_export("dist Coef :".($nextCheckpointDist /  ($k*$checkPointRadius) ), true));

    $previousX = $x;
    $previousY = $y;
}
?>