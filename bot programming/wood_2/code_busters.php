<?php
/**
 * Send your busters out into the fog to trap ghosts and bring them home!
 **/

fscanf(STDIN, "%d",
    $bustersPerPlayer // the amount of busters you control
);
fscanf(STDIN, "%d",
    $ghostCount // the amount of ghosts on the map
);
fscanf(STDIN, "%d",
    $myTeamId // if this is 0, your base is on the top left of the map, if it is one, on the bottom right
);

// game loop
while (TRUE)
{
    fscanf(STDIN, "%d",
        $entities // the number of busters and ghosts visible to you
    );
    for ($i = 0; $i < $entities; $i++)
    {
        fscanf(STDIN, "%d %d %d %d %d %d",
            $entityId, // buster id or ghost id
            $x,
            $y, // position of this buster / ghost
            $entityType, // the team id if it is a buster, -1 if it is a ghost.
            $state, // For busters: 0=idle, 1=carrying a ghost.
            $value // For busters: Ghost id being carried. For ghosts: number of busters attempting to trap this ghost.
        );
    }
    for ($i = 0; $i < $bustersPerPlayer; $i++)
    {

        // Write an action using echo(). DON'T FORGET THE TRAILING \n
        // To debug (equivalent to var_dump): error_log(var_export($var, true));

        echo ("MOVE 8000 4500\n"); // MOVE x y | BUST id | RELEASE
    }
}
?>