<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
$values = [] ;
fscanf(STDIN, "%d",
    $n
);
$inputs = fgets(STDIN);
$inputs = explode(" ",$inputs);
for ($i = 0; $i < $n; $i++)
{
    $values[] = intval($inputs[$i]);
}
error_log(var_export($values, true));

$solution = 0;

$max = 0 ;

if($n != 0){
    $max = $values[0];
}

for($i=0;$i<$n;$i++){
    $diff = $values[$i] - $max;

    if($diff < $solution){
        $solution = $diff;
    }

    if($values[$i] > $max ){
        $max = $values[$i];
    }
}



// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));

echo("{$solution}\n");
?>