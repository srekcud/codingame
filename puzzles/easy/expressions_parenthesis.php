<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%s",
    $expression
);

// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));

// echo("true/false\n");


error_log(var_export($expression, true));

$exp = str_split($expression);
$ouvrantes = ['(','[','{'];
$fermantes = [')',']','}'];
$lifo = [];
$return = 'true';
foreach($exp as $e)
{
    switch ($e){
        case in_array($e,$ouvrantes) == true :
            $lifo[] = $e;
            break;
        case in_array($e,$fermantes) == true :
            $tmp = array_pop($lifo);
            $search = array_search($e,$fermantes);
            if($search !== false && $tmp != $ouvrantes[$search])
            {
                $return = 'false';
            }
            break;
        default:
            break;
    }
}

if($lifo != [])
{
    $return = 'false';
}

echo("{$return}\n");


// 2 type ouvrante ( [ { et fermante ) ] }  pile LIFO avec les ouvrantes.
//si une fermante n'est pas la 1ere de la pile result = false




?>