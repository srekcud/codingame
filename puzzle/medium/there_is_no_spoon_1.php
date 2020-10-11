<?php
/**
 * Don't let the machines win. You are humanity's last hope...
 **/

fscanf(STDIN, "%d",
    $width // the number of cells on the X axis
);
fscanf(STDIN, "%d",
    $height // the number of cells on the Y axis
);
for ($i = 0; $i < $height; $i++)
{
    $nodelist[] = str_split(stream_get_line(STDIN, 31 + 1, "\n")); // width characters, each either 0 or .
}

for($i=0;$i<$height;$i++){
    for($j=0;$j<$width;$j++){

        $node = [-1,-1];
        $nodeLine = [-1,-1];
        $nodeColumn = [-1,-1];

        if($nodelist[$i][$j] === "0"){
            $node = [$i,$j];
            // error_log(var_export($node, true))

            if($j+1 < $width){
                for($l=($j+1);$l<$width;$l++){
                    if($nodelist[$i][$l] === "0"){
                        $nodeLine = [$i,$l];
                        break;
                    }
                }
            }

            if($i+1 < $height){
                for($k=($i+1);$k<$height;$k++){
                    if($nodelist[$k][$j] === "0"){
                        $nodeColumn = [$k,$j];
                        break;
                    }
                }
            }

            // Three coordinates: a node, its right neighbor, its bottom neighbor
            echo("{$node[1]} {$node[0]} {$nodeLine[1]} {$nodeLine[0]} {$nodeColumn[1]} {$nodeColumn[0]}\n");
        }
    }
}
?>