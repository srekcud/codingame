<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d", $N);
for ($i = 0; $i < $N; $i++)
{
    $action[]=stream_get_line(STDIN, 256 + 1, "\n");
}
fscanf(STDIN, "%d", $nbOrders);
for ($i = 0; $i < $nbOrders; $i++)
{
    $order[] = explode(" ",stream_get_line(STDIN, 256 + 1, "\n"));
}

// Write an answer using echo(). DON'T FORGET THE TRAILING \n
// To debug: error_log(var_export($var, true)); (equivalent to var_dump)

$exit = [] ;
$exx = [];
//error_log(var_export($action, true));
//error_log(var_export($order, true));


foreach($order as $o){
    if($o[1]== "before"){
        if(in_array($o[0], $exit)){
            $exit[array_search($o[0], $exit)+1] = $o[2];
        }elseif(in_array($o[2], $exit)){
            if(array_search($o[2], $exit)-1 < 0){
                 array_unshift($exit,$o[0]);
             }else{
                array_splice( $exit, array_search($o[2], $exit)-1, 0, $o[0] );
             }
        }elseif(count($exit) == 0){
            $exit[] = $o[0];
            $exit[] = $o[2];
        }else{
            array_push($order,$o);
           // error_log(var_export($order, true));
        }
    }
    else{
         if(in_array($o[0], $exit)){
             if(array_search($o[0], $exit)-1 < 0){
                 array_unshift($exit,$o[2]);
             }else{
                array_splice( $exit, array_search($o[0], $exit)-1, 0, $o[2] );
             }
         }elseif(in_array($o[2], $exit)){
            $exit[array_search($o[2], $exit)+1] = $o[0];
         }elseif(count($exit) == 0){
            $exit[] = $o[2];
            $exit[] = $o[0];
         }else{
            array_push($order,$o);
            //error_log(var_export($order, true));

        }
    }


   //error_log(var_export("-----------", true));
   //error_log(var_export($exit, true));

}

foreach($action as $a){
    if(!in_array($a,$exit)){
        $exx[] = $a;
    }
}

// placer ceux pour lesquels on a pas d'info
foreach($exit as $e){
    echo("$e\n");
}

?>