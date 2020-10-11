<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d", $N);
for ($i = 0; $i < $N; $i++)
{
    fscanf(STDIN, "%s %d %d %d", $TYPE, $HP, $ARMOR, $DAMAGE);
    if($TYPE == "CRUISER"){
        $pew =  10 - $ARMOR;
    }else{
        $pew = 20 - $ARMOR;
    }
    if($pew <= 0) $pew = 1;

    $turn = ceil($HP / $pew) ;
    $ships[] =[$TYPE, $HP, $ARMOR, $DAMAGE, $turn, ($turn/$DAMAGE)] ;
}


//error_log(var_export($N, true));
//error_log(var_export($ships, true));

// Write an answer using echo(). DON'T FORGET THE TRAILING \n
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)

//echo("PEWPEW\n");

$struct = 5000;

function sortBy($a, $b) {
return $a[5] <=>$b[5];




}



usort($ships, 'sortBy');


//$ships = [['FIGHTER',36,2,60],  ['CRUISER',50,3,200],];
error_log(var_export($ships, true));


while ($struct > 0 && count($ships) > 0)
{
    if($ships[0][1] <= 0){
        array_shift($ships);
        if(count($ships) == 0){
            break;
        }
    }
//error_log(var_export($ships, true));
    if($ships[0][0] == "CRUISER"){
        if($ships[0][2] < 10){
            $ships[0][1] = $ships[0][1] - 10 + $ships[0][2] ;
        }else{
            $ships[0][1] = $ships[0][1] - 1;
        }
    }else{
        if($ships[0][2] < 20){
            $ships[0][1] = $ships[0][1] - 20 + $ships[0][2] ;
        }else{
            $ships[0][1] = $ships[0][1] - 1;
        }
    }


    foreach($ships as $s){
        $struct = $struct - $s[3];
    }
//error_log(var_export($struct, true));
}
error_log(var_export($struct, true));
error_log(var_export($ships, true));
if($struct < 0 ){
    echo("FLEE\n");
}else{
    echo("$struct\n");
}
?>