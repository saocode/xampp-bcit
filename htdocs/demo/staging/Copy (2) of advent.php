<?php
// $title = "Title";
// $description = "Description.";
// include "headerScript.php";
?>
<div
	class="w3-card w3-center w3-container w3-hover-shadow w3-margin-top w3-padding-top">
	<div class="w3-center">

<?php
$output = "";
$input = "
2199943210
3987894921
9856789892
8767896789
9899965678
";

function noErrors($errno, $errstr, $errfile, $errline) {
}
set_error_handler("noErrors");

$input = str_replace("\r\n", ",", $input);
$inputArray = preg_split('/,/', $input, - 1, PREG_SPLIT_NO_EMPTY);

$i = 0;
foreach ($inputArray as $line) {
    $lineArray[$i] = str_split($line);
    $i ++;
}



function calcBasin($BasinArray, $lineArray) {

    $currentBasinArray = $BasinArray;

        
    if (!$currentBasinArray["count"] == $currentBasinArray["countProcessed"]) {
    
        $difference = $currentBasinArray["count"] - $currentBasinArray["countProcessed"];

    $i = $difference;
    $currentBasinArray["countProcessed"]++;
 
    $rowCount = 0;
    
    foreach ($currentBasinArray["row"] as $countRow) {
        
        $rowCount++;
        echo $countRow;
        
    }
    $element =  $rowCount - $difference;
    for ($i = $element; $i < $difference; $i++) {
        
        $row = $currentBasinArray["row"][$i];
        $col = $currentBasinArray["col"][$i];
       
        $right = $lineArray[$row][$col + 1];
        $left = $lineArray[$row][$col - 1];
        $up = $lineArray[$row - 1][$col];
        $down = $lineArray[$row + 1][$col];
        
        
    
if (isset($right)) {
    if ($right == 9) {
        $rightStop = true;
    } else {
        array_push($currentBasinArray["row"], $row);
        array_push($currentBasinArray["col"], $col+1);
        $currentBasinArray["count"]++;
    }
} else {
    $rightStop = true;
}

if (isset($left)) {
    if ($left == 9) {
        $leftStop = true;
    } else {
        array_push($currentBasinArray["row"], $row);
        array_push($currentBasinArray["col"], $col-1);
        $currentBasinArray["count"]++;
        
    }
} else {
    $leftStop = true;
}

if (isset($up)) {
    if ($up == 9) {
        $upStop = true;
    } else {
        array_push($currentBasinArray["row"], $row-1);
        array_push($currentBasinArray["col"], $col);
        $currentBasinArray["count"]++;
        
    }
} else {
    $upStop = true;
}

if (isset($down)) {
    if ($down == 9) {
        $downStop = true;
    } else {
        array_push($currentBasinArray["row"], $row+1);
        array_push($currentBasinArray["col"], $col);
        $currentBasinArray["count"]++;
        
    }
} else {
    $downStop = true;
    
    
    
}

    }
// if UDLR is 9 or edge then stop
// else add valid UDLR to array
// then repeat until no more entries

    echo "Basin size: " . $basinArray["count"] . "<br>";
    echo "Basin size: " . $basinArray["countProcessed"] . "<br>";
    
    
    }
    
else calcBasin($currentBasinArray, $lineArray);

} 

$maxRow = count($lineArray);
$maxCol = count($lineArray[0]);
$basinArray = array ();


for ($row = 0; $row < $maxRow; $row ++) {

    for ($col = 0; $col < $maxCol; $col ++) {
        //$output .= "Row: $row<br>";
        //$output .= "Col: $col<br>";
        //$output .= $lineArray[$row][$col] . "<br>";

        $current = $lineArray[$row][$col];
        $right = $lineArray[$row][$col + 1];
        $left = $lineArray[$row][$col - 1];
        $up = $lineArray[$row - 1][$col];
        $down = $lineArray[$row + 1][$col];

        $rightBig = false;
        $leftBig = false;
        $upBig = false;
        $downBig = false;

        $rightStop = false;
        $leftStop = false;
        $upStop = false;
        $downStop = false;
        
        
        if (isset($right)) {
            if ($current < $right) {
                $rightBig = true;
            }
        } else {
            $rightBig = true;
        }

        if (isset($left)) {
            if ($current < $left) {
                $leftBig = true;
            }
        } else {
            $leftBig = true;
        }

        if (isset($up)) {
            if ($current < $up) {
                $upBig = true;
            }
        } else {
            $upBig = true;
        }

        if (isset($down)) {
            if ($current < $down) {
                $downBig = true;
            }
        } else {
            $downBig = true;
        }

        if ($leftBig && $rightBig && $upBig && $downBig) {

            $output .= "All bigger<br>";

            // start basin
            $basinArray[isClosed] = false;
            // add row/col to basin array
            
            $basinArray["col"][0] = $col;            
            $basinArray["row"][0] = $row;
            $basinArray["count"] = 1;
            $basinArray["countProcessed"] = 0;

            calcBasin($basinArray, $lineArray);
            // check UDLR
            // if UDLR is 9 or edge then stop
            // else add valid UDLR to array
            
            
                        
        }

        // end col
    }

    $output .= "<br>";

    // end row
}

?>

Put HTML content here.<br>
<?=$output?>

</div>
</div>
<?php include $footerFile; ?>