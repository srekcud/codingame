<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d %d",$width,$height);

$hashByColumn = array_fill(0,$width,0);

for ($i = 0; $i < $height; $i++)
{
    fscanf(STDIN, "%s",$line);
//    error_log(var_export($line, true));

    for($j=0;$j<$width;$j++){
        if($line[$j] === '#'){
            $hashByColumn[$j]++;
        }
    }
}

$return = '';

for($i=0;$i< $height;$i++){
    for($j=$width-1;$j>=0;--$j){
        if($hashByColumn[$j] > 0){
            $return.="#";
            $hashByColumn[$j]--;
        }else{
            $return .=".";
        }
    }
    $return .="\n";
}
// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));
$return = strrev(trim($return));
echo("{$return}\n");
