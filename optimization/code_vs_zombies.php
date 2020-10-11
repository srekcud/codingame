<?php
/**
 * Save humans, destroy zombies!
 **/


// game loop
while (TRUE)
{
    $humans = $zombies = [];
    fscanf(STDIN, "%d %d", $x, $y);
    fscanf(STDIN, "%d", $humanCount);
    for ($i = 0; $i < $humanCount; $i++)
    {
        fscanf(STDIN, "%d %d %d", $humanId, $humanX, $humanY);
        $humans[]=
        [
            "id"=>$humanId,
            "x"=>$humanX,
            "y"=>$humanY
        ];
    }
    fscanf(STDIN, "%d", $zombieCount);
    for ($i = 0; $i < $zombieCount; $i++)
    {
        fscanf(STDIN, "%d %d %d %d %d", $zombieId, $zombieX, $zombieY, $zombieXNext, $zombieYNext);
        $zombies[]=
        [
            "id"=>$zombieId,
            "x"=>$zombieX,
            "y"=>$zombieY,
            "xNext"=>$zombieXNext,
            "yNext"=>$zombieYNext,
        ];
    }

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug: error_log(var_export($var, true)); (equivalent to var_dump)

    //error_log(var_export($humans, true));
    error_log(var_export($zombies, true));
    //error_log(var_export($humans[count($humans)-1]['x'], true));

   // $t="".$humans[count($humans)-1]['x'];

    // $t=$t." ".$humans[count($humans)-1]['y'];

    $t= "".$zombies[0]["x"]." ".$zombies[0]['y'];
    echo("$t\n"); // Your destination coordinates
}
?>