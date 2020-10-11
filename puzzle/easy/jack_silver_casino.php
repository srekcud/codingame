<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $ROUNDS
);
fscanf(STDIN, "%d",
    $CASH
);
for ($i = 0; $i < $ROUNDS; $i++)
{
    $PLAY[] = explode(" ",stream_get_line(STDIN, 1024 + 1, "\n"));
}

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));

// echo("cash of the target after playing\n");

error_log(var_export($ROUNDS, true));
error_log(var_export($CASH, true));
//error_log(var_export($PLAY, true));


foreach($PLAY as $p){
    $bet = ceil($CASH / 4 );
    switch($p[1]){
        case "PLAIN":
            if($p[0] == $p[2]){
                $CASH += 35*$bet;
            }else{
                $CASH-=$bet;
            }
            break;
        case "EVEN":
            if($p[0]%2 != 1 && $p[0] > 0){
                $CASH += $bet;
            }else{
                $CASH -= $bet;
            }
            break;
        case "ODD"://impair
            if($p[0]%2 == 1){
                $CASH += $bet;
            }else{
                $CASH -= $bet;
            }
            break;
    }
}

echo("$CASH\n");
?>