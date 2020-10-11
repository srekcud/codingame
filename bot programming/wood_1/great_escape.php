<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d %d %d %d",
    $w, // width of the board
    $h, // height of the board
    $playerCount, // number of players (2 or 3)
    $myId // id of my player (0 = 1st player, 1 = 2nd player, ...)
);

// game loop
while (TRUE)
{
    for ($i = 0; $i < $playerCount; $i++)
    {
        fscanf(STDIN, "%d %d %d",
            $x, // x-coordinate of the player
            $y, // y-coordinate of the player
            $wallsLeft // number of walls available for the player
        );
    }
    fscanf(STDIN, "%d",
        $wallCount // number of walls on the board
    );
    for ($i = 0; $i < $wallCount; $i++)
    {
        fscanf(STDIN, "%d %d %s",
            $wallX, // x-coordinate of the wall
            $wallY, // y-coordinate of the wall
            $wallOrientation // wall orientation ('H' or 'V')
        );
    }

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));


    // action: LEFT, RIGHT, UP, DOWN or "putX putY putOrientation" to place a wall
    if($myId == 0){
    echo("RIGHT\n");
    }else{
        echo("LEFT\n");
    }
}
?>