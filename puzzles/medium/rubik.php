<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $N
);

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));
if($N < 2){
    echo("{$N}\n");
}else{
  $sol = (6*$N*$N-12*$N+8 ) ;
  echo("{$sol}\n");
}
?>