<?php
/*Params */
$pack1 = [];
$pack2 = [];
$card1 = [];
$card2 = [];
$pat = false;
$count = 0;
$order = [
    "2D"=>2,"2H"=>2,"2C"=>2,"2S"=>2,
    "3D"=>3,"3H"=>3,"3C"=>3,"3S"=>3,
    "4D"=>4,"4H"=>4,"4C"=>4,"4S"=>4,
    "5D"=>5,"5H"=>5,"5C"=>5,"5S"=>5,
    "6D"=>6,"6H"=>6,"6C"=>6,"6S"=>6,
    "7D"=>7,"7H"=>7,"7C"=>7,"7S"=>7,
    "8D"=>8,"8H"=>8,"8C"=>8,"8S"=>8,
    "9D"=>9,"9H"=>9,"9C"=>9,"9S"=>9,
    "10D"=>10,"10H"=>10,"10C"=>10,"10S"=>10,
    "JD"=>11,"JH"=>11,"JC"=>11,"JS"=>11,
    "QD"=>12,"QH"=>12,"QC"=>12,"QS"=>12,
    "KD"=>13,"KH"=>13,"KC"=>13,"KS"=>13,
    "AD"=>14,"AH"=>14,"AC"=>14,"AS"=>14
];
/* INIT VARIABLES */
fscanf(STDIN, "%d",$n);
for ($i = 0; $i < $n; $i++)
{
    fscanf(STDIN, "%s",$pack1[]);
}
fscanf(STDIN, "%d",$m);
for ($i = 0; $i < $m; $i++)
{
    fscanf(STDIN, "%s",$pack2[]);
}


/* WAR LOOP */
while(!empty($pack1) && !empty($pack2) && $pat == false){
    $card1[] = array_shift($pack1);
    $card2[] = array_shift($pack2);
    if($order[ end($card1) ] > $order[ end($card2) ]){
        $pack1 = array_merge($pack1,$card1);
        $pack1 = array_merge($pack1,$card2);
        $card1=[];$card2=[];
//        error_log(var_export("-".$card1[0]." ".$card2[0]." : ".$count, true));

    }elseif($order[ end($card1) ] < $order[ end($card2) ]){
        $pack2 = array_merge($pack2,$card1);
        $pack2 = array_merge($pack2,$card2);
        $card1=[];$card2=[];

//        error_log(var_export("*".$card1[0]." ".$card2[0]." : ".$count, true));

    }else{
        if(count($pack1) < 4 || count($pack2) < 4){
            $pat = true ;
        }else{
            for($i=0;$i<3;$i++){
                $card1[] = array_shift($pack1);
                $card2[] = array_shift($pack2);
            }
        }
        $count--;
    }
    $count++;

}
if($pat == true){
    echo("PAT\n");
}elseif(empty($pack1)){
    echo("2 ".$count."\n");
}else{
    echo("1 ".$count."\n");
}
// Write an action using echo(). DON'T FORGET THE TRAILING \n
// To debug (equivalent to var_dump): error_log(var_export($var, true));

?>
