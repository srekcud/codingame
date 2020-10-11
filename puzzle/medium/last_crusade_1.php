<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

$types = [
    [],
    ["LEFT BOT","TOP BOT","RIGHT BOT"],
    ["LEFT RIGHT","RIGHT LEFT"],
    ["TOP BOT"],
    ["TOP LEFT","RIGHT BOT"],
    ["TOP RIGHT","LEFT BOT"],
    ["LEFT RIGHT","RIGHT LEFT"],
    ["TOP BOT","RIGHT BOT"],
    ["LEFT BOT","RIGHT BOT"],
    ["LEFT BOT","TOP BOT"],
    ["TOP LEFT"],
    ["TOP RIGHT"],
    ["RIGHT BOT"],
    ["LEFT BOT"]
];
$direction = [
  "LEFT" => [-1,0],
  "RIGHT" => [1,0],
  "BOT" => [0,1]
];
$map = [];
fscanf(STDIN, "%d %d",
    $W, // number of columns.
    $H // number of rows.
);
for ($i = 0; $i < $H; $i++)
{
    $map[$i] = explode(" ",stream_get_line(STDIN, 200 + 1, "\n")); // represents a line in the grid and contains W integers. Each integer represents one room of a given type.

}
fscanf(STDIN, "%d",
    $EX // the coordinate along the X axis of the exit (not useful for this first mission, but must be read).
);
// game loop
while (TRUE)
{
    fscanf(STDIN, "%d %d %s",
        $XI,
        $YI,
        $POS
    );
    $type = $types[$map[$YI][$XI]];

    foreach($type as $t) {
        $e = explode(" ", $t);
        if($e[0] == $POS){
            $exit = $direction[$e[1]];
        }
    }
    echo(($XI+$exit[0])." ".($YI+$exit[1])."\n");
}
?>