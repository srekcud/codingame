<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d", $laps);
fscanf(STDIN, "%d", $checkpointCount);
for ($i = 0; $i < $checkpointCount; $i++)
{
    fscanf(STDIN, "%d %d", $checkpointX, $checkpointY);

    $checkpoints[] = ["x" => $checkpointX, "y" => $checkpointY];
}
//error_log(var_export($checkpoints, true));
// game loop
while (TRUE)
{
    for ($i = 0; $i < 2; $i++)
    {
        // $x: x position of your pod
        // $y: y position of your pod
        // $vx: x speed of your pod
        // $vy: y speed of your pod
        // $angle: angle of your pod
        // $nextCheckPointId: next check point id of your pod
        fscanf(STDIN, "%d %d %d %d %d %d", $x, $y, $vx, $vy, $angle, $nextCheckPointId);
    }
    for ($i = 0; $i < 2; $i++)
    {
        // $x2: x position of the opponent's pod
        // $y2: y position of the opponent's pod
        // $vx2: x speed of the opponent's pod
        // $vy2: y speed of the opponent's pod
        // $angle2: angle of the opponent's pod
        // $nextCheckPointId2: next check point id of the opponent's pod
        fscanf(STDIN, "%d %d %d %d %d %d", $x2, $y2, $vx2, $vy2, $angle2, $nextCheckPointId2);
    }

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug: error_log(var_export($var, true)); (equivalent to var_dump)


    // You have to output the target position
    // followed by the power (0 <= thrust <= 100)
    // i.e.: "x y thrust"

    $k = 3;
    $targetX1 = $checkpoints[$nextCheckPointId]["x"] - $k * $vx;
    $targetY1 = $checkpoints[$nextCheckPointId]["y"] - $k * $vy;

    echo("$targetX1 $targetY1 BOOST\n");

    $targetX2 = $checkpoints[$nextCheckPointId2]["x"] - $k * $vx2;
    $targetY2 = $checkpoints[$nextCheckPointId2]["y"] - $k * $vy2;


    echo("$targetX2 $targetY2 BOOST\n");


}
?>