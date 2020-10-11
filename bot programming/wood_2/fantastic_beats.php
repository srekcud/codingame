<?php
/**
 * Grab Snaffles and try to throw them through the opponent's goal!
 * Move towards a Snaffle and use your team id to determine where you need to throw it.
 **/

fscanf(STDIN, "%d",
    $myTeamId // if 0 you need to score on the right of the map, if 1 you need to score on the left
);

// game loop
while (TRUE)
{
    fscanf(STDIN, "%d %d",
        $myScore,
        $myMagic
    );
    fscanf(STDIN, "%d %d",
        $opponentScore,
        $opponentMagic
    );
    fscanf(STDIN, "%d",
        $entities // number of entities still in game
    );
    for ($i = 0; $i < $entities; $i++)
    {
        fscanf(STDIN, "%d %s %d %d %d %d %d",
            $entityId, // entity identifier
            $entityType, // "WIZARD", "OPPONENT_WIZARD" or "SNAFFLE" (or "BLUDGER" after first league)
            $x, // position
            $y, // position
            $vx, // velocity
            $vy, // velocity
            $state // 1 if the wizard is holding a Snaffle, 0 otherwise
        );

        // create arrays wizard, opponent, balls based on type
    }
    for ($i = 0; $i < 2; $i++)
    {

        // Write an action using echo(). DON'T FORGET THE TRAILING \n
        // To debug (equivalent to var_dump): error_log(var_export($var, true));


        // Edit this line to indicate the action for each wizard (0 ≤ thrust ≤ 150, 0 ≤ power ≤ 500)
        // i.e.: "MOVE x y thrust" or "THROW x y power"
        echo ("MOVE 8000 3750 150\n");

        //take the nearest ball and throw it to the goal
    }

}
?>