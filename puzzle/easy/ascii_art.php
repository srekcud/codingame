<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",$L);
fscanf(STDIN, "%d",$H);
$T = str_split(strtoupper(stream_get_line(STDIN, 256 + 1, "\n")));
$size = sizeof($T);
for ($i = 0; $i < $H; $i++)
{
    $ROW[$i] = stream_get_line(STDIN, 1024 + 1, "\n");
}
$asciiLetters = [];
for($i=0 ; $i<=26;$i++){
    $asciiLetter = [];
    for($k=0;$k<$H;$k++){
        for($j=$i*$L;$j<$L+($i*$L);$j++){
            $asciiLetter[$k][$j-($L*$i)] = $ROW[$k][$j];
        }
    }
    $asciiLetters[$i] = $asciiLetter;
}
$answerLetters = [];
for($i=0;$i<$size;$i++){
    $place = (ord($T[$i])-65) ;
    if($place>25 || $place <0) $place = 26;
    $answerLetters = array_merge($answerLetters,array($asciiLetters[$place]));

}
for($i=0;$i<$H;$i++){
    $answer = "";
    foreach($answerLetters as $answerLetter){
        for($j=0;$j<$L;$j++){
            $answer.=$answerLetter[$i][$j];
        }
    }
    echo $answer."\n";
}

