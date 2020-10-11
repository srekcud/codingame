<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

$points = [
    "a"=>1,"b"=>3,"c"=>3,"d"=>2,"e"=>1,"f"=>4,"g"=>2,"h"=>4,"i"=>1,"j"=>8,"k"=>5,"l"=>1,"m"=>3,"n"=>1,"o"=>1,"p"=>3,
    "q"=>10,"r"=>1,"s"=>1,"t"=>1,"u"=>1,"v"=>4,"w"=>4,"x"=>8,"y"=>4,"z"=>10
];
$words_split=[];
$words=[];
$scores = [];
fscanf(STDIN, "%d",
    $N
);
for ($i = 0; $i < $N; $i++) {
    $x = stream_get_line(STDIN, 30 + 1, "\n");
    $words_split[] = str_split($x);
    $words[] = $x;
}
$letters_split = str_split(stream_get_line(STDIN, 8 + 1, "\n"));
//trouver les mots corrects et regarder lequel fait le plus de pts

$i = 0;
foreach( $words_split as $w){
    if(count($w) <= 7 && count(array_intersect(array_count_values($w),array_count_values($letters_split))) == count(array_unique($w)) ){
        if(count(array_intersect($w,$letters_split)) == count ($w)) {
            $score = 0 ;
            while(!empty($w)){
                $score += $points[array_pop($w)];
            }
            $scores[$i] = $score;
        }
    }
    $i++;
}
$max = array_search(max($scores),$scores);
// To debug (equivalent to var_dump): error_log(var_export($var, true));

echo($words[$max]."\n");
?>