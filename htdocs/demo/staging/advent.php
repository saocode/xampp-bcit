<?php
$output = "";
$input = "
BNSOSBBKPCSCPKPOPNNK

HH -> N
CO -> F
BC -> O
HN -> V
SV -> S
FS -> F
CV -> F
KN -> F
OP -> H
VN -> P
PF -> P
HP -> H
FK -> K
BS -> F
FP -> H
FN -> V
VV -> O
PS -> S
SK -> N
FF -> K
PK -> V
OF -> N
VP -> K
KB -> H
OV -> B
CH -> F
SF -> F
NH -> O
NC -> N
SP -> N
NN -> F
OK -> S
BB -> S
NK -> S
FH -> P
FC -> S
OB -> P
VS -> P
BF -> S
HC -> V
CK -> O
NP -> K
KV -> S
OS -> V
CF -> V
FB -> C
HO -> S
BV -> V
KS -> C
HB -> S
SO -> N
PH -> C
PN -> F
OC -> F
KO -> F
VF -> V
CS -> O
VK -> O
FV -> N
OO -> K
NS -> S
KK -> C
FO -> S
PV -> S
CN -> O
VC -> P
SS -> C
PO -> P
BN -> N
PB -> N
PC -> H
SH -> K
BH -> F
HK -> O
VB -> P
NV -> O
NB -> C
CP -> H
NO -> K
PP -> N
CC -> S
CB -> K
VH -> H
SC -> C
KC -> N
SB -> B
BP -> P
KP -> K
SN -> H
KF -> K
KH -> B
HV -> V
HS -> K
NF -> B
ON -> H
BO -> P
VO -> K
OH -> C
HF -> O
BK -> H
";

$split = explode("\r\n\r\n", $input);
$poly = str_replace("\r\n", "", $split[0]);
$insertionString = $split[1];
$insertions = str_replace("\r\n", ",", $insertionString);
$insertions = str_replace(" -> ", ",", $insertions);
$insertions = preg_split('/,/', $insertions, - 1, PREG_SPLIT_NO_EMPTY);
$insertArray = array_chunk($insertions, 2);
$insertSize = count($insertArray);


for ($k = 0; $k < 40; $k++) {
    $polyArray = str_split($poly);
    $polySize = count($polyArray);
    $newPoly = "";
    $step = $k+1;
    echo "Step $step<br>";
    for ($i = 0; $i < $polySize-1; $i++) {
    
    $pair = $polyArray[$i] . $polyArray[$i+1];

    //echo "Pair [$i]: $pair<br>";

    $j = 0;
    foreach ($insertArray as $insert) {
        
        if ($insert[0] == $pair) {   
            
            $pair = $polyArray[$i] . $insertArray[$j][1] . $polyArray[$i+1];
        }

        $j++;
    }
        
    //echo "Pair [$i]: $pair<br>";
    
    //echo substr($pair, 0, -1) . "<br>";
    
    if ($i == $polySize-2) {
        $newPoly .= $pair;
    } else {
        $newPoly .= substr($pair, 0, -1);
    }
}

echo "$newPoly<br>";
$poly = $newPoly;
}

echo "<br>Polymer Length: " . strlen($newPoly) . "<br>";
$countMe = str_split($newPoly);
var_dump(array_count_values($countMe));



?>