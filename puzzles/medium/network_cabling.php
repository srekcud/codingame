<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/


fscanf(STDIN, "%d",
    $N
);

$Map = array();
$Xcoord = array();
$Ycoord = array();
for ($i = 0; $i < $N; ++$i) {
    fscanf(STDIN, "%d %d", $X, $Y);
    $Xcoord[] = $X;
    $Ycoord[] = $Y;
    if (!isset($Map[$X])) {
        $Map[$X] = array($Y);
    } else {
        $Map[$X][] = $Y;
    }
}
$Xcoord = array_unique($Xcoord);
sort($Xcoord);
sort($Ycoord);
$yMediane = $Ycoord[floor(count($Ycoord)/2)];
$longueurFil = 0;
$prevXPos = null;
foreach ($Xcoord as $xPos) {
    $yHouses = $Map[$xPos];
    foreach ($yHouses as $iY) {
        $longueurFil += abs($iY - $yMediane);
        if ($prevXPos !== null) {
            $longueurFil += ($xPos - $prevXPos);
        }
        $prevXPos = $xPos;
    }
}
echo $longueurFil . "\n";
?>