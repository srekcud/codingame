<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
$horses = [];
$min = 10000000 ;
fscanf(STDIN, "%d",
    $N
);
for ($i = 0; $i < $N; $i++)
{
    (fscanf(STDIN, "%d",$horses[$i]));
}
sort($horses);

for($i=0;$i<$N-1;$i++){
    $diff = $horses[$i+1] - $horses[$i];
    if($diff < $min) $min = $diff ;
}
echo($min."\n");
?>