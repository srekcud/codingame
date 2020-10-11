<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $R
);
fscanf(STDIN, "%d",
    $L
);

$iCurr = 1;
$aElements = [$R];
while ($iCurr < $L) {
    $aNewElements = [];
    $iElt = 0;
    while (isset($aElements[$iElt])) {
        $firstEltCons = $aElements[$iElt];
        $nbEltCons = 0;
        do {
            $nbEltCons++;
            $iElt++;
        } while (isset($aElements[$iElt]) && $firstEltCons === $aElements[$iElt]);
        $aNewElements[] = $nbEltCons;
        $aNewElements[] = $firstEltCons;
    }
    $iCurr++;
    $aElements = $aNewElements;
}
echo implode(' ', $aElements) . "\n";
?>