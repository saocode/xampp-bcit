<?php
// $title = "Title";
// $description = "Description.";
include "headerScript.php";

?>


<div class="w3-container">
	<div class="w3-card w3-hover-shadow w3-padding w3-margin-top">

<?php
$input = "
Paste input here.
";

function noError($errno, $errstr, $errfile, $errline)
{}

set_error_handler("noError");

$input = trim($input);
$input = str_replace("\r\n", ",", $input);
$input = str_replace("->", ",", $input);

$input = preg_replace("!\s+!", "", $input);

$inputArray = explode(",", $input);

$mapArray = array();

$coordArray = array_chunk($inputArray, 4);
$x1 = 0;
$y1 = 1;
$x2 = 2;
$y2 = 3;

$coordNum = 0;
// Assume no lines length of 1
foreach ($coordArray as $coord) {
    if ($coord[$x1] == $coord[$x2]) {
        // Vertical line
        echo "Coordinate $coordNum<br>";
        var_dump($coord);
        echo "<br>";

        $range = range($coord[$y1], $coord[$y2]);

        foreach ($range as $point) {
            $mapArray[$coord[$x1]][$point] ++;
        }
    }
    if ($coord[$y1] == $coord[$y2]) {
        // Horizontal line
        echo "Coordinate $coordNum<br>";
        var_dump($coord);
        echo "<br>";
        $range = range($coord[$x1], $coord[$x2]);

        foreach ($range as $point) {
            $mapArray[$point][$coord[$y1]] ++;
        }
    }

    $rangeX = range($coord[$x1], $coord[$x2]);
    $rangeY = range($coord[$y1], $coord[$y2]);
    $lenX = count($rangeX);
    $lenY = count($rangeY);

    if ($lenX == $lenY) {
        // Digagonal line - length of x will == length of y
        echo "Coordinate $coordNum<br>";
        var_dump($coord);
        echo "<br>";
        $firstY = $rangeY[0];
        $yCounter = 0;
        foreach ($rangeX as $xPos) {
            $mapArray[$xPos][$rangeY[$yCounter]] ++;
            $yCounter ++;
        }
    }
    $coordNum ++;
}

foreach ($mapArray as $xPos) {
    foreach ($xPos as $yPos) {
        if ($yPos == 2)
            echo "hi<br>";
    }
}

$counter = 0;

array_walk_recursive($mapArray, function ($value, $key) use (&$counter) {
    if ($value > 1)
        $counter ++;
}, $counter);

echo "Counter: $counter";

?>




    	</div>
</div>
<?php include $footerFile; ?>