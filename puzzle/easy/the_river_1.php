<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $r1
);
fscanf(STDIN, "%d",
    $r2
);

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));



while ($r1 != $r2){
    error_log(var_export($r1, true));
    error_log(var_export($r2, true));
    if($r1 > $r2)
    {
        $tmp = str_split((string) $r2);
        $add = 0;
        foreach($tmp as $t)
        {
            $add += $t;
        }

        $r2 += $add;

    }
    else{
        $tmp = str_split((string) $r1);
        $add = 0;
        foreach($tmp as $t)
        {
            $add += $t;
        }

        $r1 += $add;
    }
}



echo("{$r1}\n");
?>