<?php
$output = "";
$input = "
6,10
0,14
9,10
0,3
10,4
4,11
6,0
6,12
4,1
0,13
10,12
3,4
3,0
8,4
1,10
2,14
8,10
9,0

fold along y=7
fold along x=5
";

$split = explode("\r\n\r\n", $input);
$instructions = $split[1];
$instructions = str_replace("fold along ", "", $instructions);
$instructions = str_replace("\r\n", ",", $instructions);
$instructions = preg_split('/,/', $instructions, - 1, PREG_SPLIT_NO_EMPTY);
$dots = $split[0];
$input = str_replace("\r\n", ",", $dots);
$inputArray = preg_split('/,/', $input, - 1, PREG_SPLIT_NO_EMPTY);
$inputArray = array_chunk($inputArray, 2);
$xArray = [];
$yArray = [];
$dotArray = [];

foreach ($inputArray as $pair) {
    array_push($xArray, $pair[0]);
    array_push($yArray, $pair[1]);
    array_push($dotArray, ($pair[0] . "," . $pair[1]));
}

function draw(&$xArray, &$yArray, &$dotArray)
{
    $output = "";
    $maxX = max($xArray);
    $maxY = max($yArray);
    $dotCount = 0;
    for ($y = 0; $y <= $maxY; $y ++) {
        for ($x = 0; $x <= $maxX; $x ++) {
            $current = ". ";
            $currentPoint = $x . "," . $y;
            if (array_search($currentPoint, $dotArray) !== false) {
                $current = "#";
            }
            $output .= $current;
        }
        $output .= " | End of row $y<br>";
    }
    echo "$output<br>";
    echo "Display contains " . substr_count($output, "#") . " # characters.<br>";
}

function foldX(&$xArray, &$yArray, &$dotArray, $fold)
{
    $i = 0;
    foreach ($xArray as $x) {

        if ($x > $fold) {
            $distance = $x - $fold;
            $xArray[$i] = $fold - $distance;
            $dotArray[$i] = "$xArray[$i],$yArray[$i]";
        }
        $i ++;
    }
}

function foldY(&$xArray, &$yArray, &$dotArray, $fold)
{
    $i = 0;
    foreach ($yArray as $y) {

        if ($y > $fold) {
            $distance = $y - $fold;
            $yArray[$i] = $fold - $distance;
            $dotArray[$i] = "$xArray[$i],$yArray[$i]";
        }
        $i ++;
    }
}

foreach ($instructions as $instruction) {
    $split = explode("=", $instruction);
    if ($split[0] == "x")
        foldX($xArray, $yArray, $dotArray, $split[1]);
    else
        foldY($xArray, $yArray, $dotArray, $split[1]);
}

draw($xArray, $yArray, $dotArray);

?>