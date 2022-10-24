<?php
// $title = "Title";
// $description = "Description.";
include "headerScript.php";
?>



<div class="w3-container">
	<div class="w3-card w3-hover-shadow w3-padding w3-margin-top">



<?php

$content = trim(file_get_contents('input.txt')," \n\r");
$numbers = explode(chr(0x0A),$content);

$r = array();
for ($i=0;$i<12;$i++) { $r[$i] = array(); $r[$i]['0'] = 0; $r[$i]['1'] = 0; }

foreach ($numbers as $number) {
    for ($i=0;$i<12;$i++) { $c = substr($number,$i,1); $r[$i][$c]++; }
}

$gamma = '';
$epsilon = '';

for ($i=0;$i<12;$i++) {
    $least = $r[$i]['0'] < $r[$i]['1'] ? '0' : '1';
    $most  = $r[$i]['0'] > $r[$i]['1'] ? '0' : '1';
    
    $gamma .= $most;
    $epsilon .= $least;
}

$gamma_dec = base_convert($gamma,2,10);
$epsilon_dec = base_convert($epsilon,2,10);

$result = $gamma_dec * $epsilon_dec;

echo "03.01 gamma=$gamma epsilon=$epsilon gd=$gamma_dec ed=$epsilon_dec result=$result\n";

//  which : 0 = oxygen, 1 = co2

function find_value($numbers, $which = 0) {
    $continue = true;
    $input = $numbers;
    $output = array();
    $offset = 0;
    $sum = array();
    
    while ($continue) {
        $sum['0'] = 0;
        $sum['1'] = 0;
        $output = array();
        foreach ($input as $number) {
            $c = substr($number,$offset,1);
            $sum[$c]++;
        }
        $keep = '0';
        if ($which == 0) { // oxygen
            if ($sum['0']<=$sum['1']) $keep = '1';
            if ($sum['0'] >$sum['1']) $keep = '0';
        }
        if ($which == 1) { // co2
            if ($sum['0'] >$sum['1']) $keep = '1';
            if ($sum['0']<=$sum['1']) $keep = '0';
        }
        foreach ($input as $number) {
            $c = substr($number,$offset,1);
            if ($c==$keep) array_push($output,$number);
        }
        $input = $output;
        $offset++;
        if ($offset==12) $continue = false;
        if (count($output)==1) $continue = false;
    }
    //var_dump($input);
    return $input[0];
}

$oxygen = find_value($numbers,0);
$co2 = find_value($numbers,1);

$odec = base_convert($oxygen,2,10);
$cdec = base_convert($co2,2,10);

$result = $odec * $cdec;

echo "03.02 oxygen=$oxygen ($odec) co2=$co2 ($cdec) result=".($odec*$cdec)."\n";


$epOutput = "";
$gamOutput = "";
$ep = "";
$gam = "";
// Open file
$fileName = "input.txt";
$fp = @fopen($fileName, 'r');
if ($fp) {
    $textArray = explode("\r\n", fread($fp, filesize($fileName)));
}
$arrayArray = array();
$reverseArray = array();
foreach ($textArray as $a) {
    // Convert binary strings to array.
    $bin = str_split($a);
    array_push($arrayArray, $bin);
    // Create array of reversed binary values (as arrays).
    array_push($reverseArray, array_reverse($bin));
}
$oxyArray = $arrayArray;

$i = 0;
while ($i < 12) {
    $sum = 0;
    $j = 0;
    foreach ($arrayArray as $a) {
        // Get binary digit and add it to sum.
        $bin = array_pop($a);
        $sum += $bin;
        // Replace array binary with shortened array binary.
        $arrayArray[$j] = $a;
        $j ++;
    }

    // Are more than half the values 1? (This function doesn't work if the input.txt size changes. Also no case for 50/50).
    if ($sum > 500)
        $gam = "1";
    else
        $gam = "0";
    if ($sum < 500)
        $ep = "1";
    else
        $ep = "0";
    // Write gam and ep results right-to-left.
    $gamOutput = $gam . $gamOutput;
    $epOutput = $ep . $epOutput;

    $i ++;
}
// final result - convert strings to decimal and multiply
$output = bindec($gamOutput) * bindec($epOutput);
echo $output;
echo "<br>";

// For example, to determine the oxygen generator rating value using the same example diagnostic report from above:

// Start with all 12 numbers and consider only the first bit of each number. There are more 1 bits (7) than 0 bits (5), so keep only the 7 numbers with a 1 in the first position: 11110, 10110, 10111, 10101, 11100, 10000, and 11001.

$oxyOutput = "";

$trueArray = array();
$falseArray = array();
$i = 0;
while ($i < 12) {

    
foreach ($oxyArray as $a) {
    if ($a[$i])
        array_push($trueArray, $a);
    else
        array_push($falseArray, $a);
}
if (count($trueArr) >= count($falseArr)) {
    $oxyArray = $trueArray;
    //$oxyOutput = $oxyOutput . 1;
} else {
    $oxyArray = $falseArray;
    //$oxyOutput = $oxyOutput . 0;
}

$i++;
$trueArray = array();
$falseArray = array();
}

// Then, consider the second bit of the 7 remaining numbers: there are more 0 bits (4) than 1 bits (3), so keep only the 4 numbers with a 0 in the second position: 10110, 10111, 10101, and 10000.
// In the third position, three of the four numbers have a 1, so keep those three: 10110, 10111, and 10101.
// In the fourth position, two of the three numbers have a 1, so keep those two: 10110 and 10111.
// In the fifth position, there are an equal number of 0 bits and 1 bits (one each). So, to find the oxygen generator rating, keep the number with a 1 in that position: 10111.
// As there is only one number left, stop; the oxygen generator rating is 10111, or 23 in decimal.
// Then, to determine the CO2 scrubber rating value from the same example above:

// Start again with all 12 numbers and consider only the first bit of each number. There are fewer 0 bits (5) than 1 bits (7), so keep only the 5 numbers with a 0 in the first position: 00100, 01111, 00111, 00010, and 01010.
// Then, consider the second bit of the 5 remaining numbers: there are fewer 1 bits (2) than 0 bits (3), so keep only the 2 numbers with a 1 in the second position: 01111 and 01010.
// In the third position, there are an equal number of 0 bits and 1 bits (one each). So, to find the CO2 scrubber rating, keep the number with a 0 in that position: 01010.
// As there is only one number left, stop; the CO2 scrubber rating is 01010, or 10 in decimal.

// To find oxygen generator rating, determine the most common value (0 or 1) in the current bit position, and keep only numbers with that bit in that position. If 0 and 1 are equally common, keep values with a 1 in the position being considered.
// To find CO2 scrubber rating, determine the least common value (0 or 1) in the current bit position, and keep only numbers with that bit in that position. If 0 and 1 are equally common, keep values with a 0 in the position being considered.

$reverseOxy = array();
$i = 0;
while ($i < 12) {
    $sum = 0;
    $j = 0;
    $trueArr = array();
    $falseArr = array();
    foreach ($oxyArr as $a) {

        $bin = array_pop($a);
        if ($bin)
            array_push($trueArr, $a);
        else
            array_push($falseArr, $a);

        // $arr3[$j] = $a;
        $j ++;
    }
    if (count($trueArr) >= count($falseArr)) {
        $oxyArr = $trueArr;
        $oxyOutput = $oxyOutput . 1;
    } else {
        $oxyArr = $falseArr;
        $oxyOutput = $oxyOutput . 0;
    }

    $i ++;
}

$co2Output = "";
$i = 0;
while ($i < 12) {
    $sum = 0;
    $j = 0;
    $trueArr = array();
    $falseArr = array();
    foreach ($co2Arr as $a) {

        $bin = array_pop($a);
        if ($bin)
            array_push($trueArr, $a);
        else
            array_push($falseArr, $a);

        // $arr3[$j] = $a;
        $j ++;
    }
    if (count($trueArr) <= count($falseArr)) {
        $co2Arr = $trueArr;
        $co2Output = $co2Output . 1;
    } else {
        $co2Arr = $falseArr;
        $co2Output = $co2Output . 0;
    }

    $i ++;
}

$product = bindec($oxyOutput) * bindec($co2Output);

echo $product;
echo "<br>";

// unreverse
echo $output;
echo "<br>";
echo "oxy: " . $oxyOutput;
echo "<br>";
echo "co2: " . $co2Output;
?>


    	</div>
</div>
<?php include $footerFile; ?>