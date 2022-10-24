<?php
$output = "";
$input = "
1111111111
1999111111
1919111111
1999111111
1111111111
1111111111
1999111111
1919111111
1999111111
1111111111
";

// 0  1  2  3  4  5  6  7  8  9
// 10 11 12 13 14 15 16 17 18 19 

$input = str_replace("\r\n", "", $input);
$inputArray = str_split($input);

for ($row = 0; $row < 10; $row ++) {
    for ($col = 0; $col < 10; $col ++) {
        //$output .= "Row: $row<br>";
        //$output .= "Col: $col<br>";
        //$output .= $rowArray[$row][$col] . "<br>";
        
        $current = ($row * 10) + $col;
        
        $output .= $inputArray[$current];
        // end col
    }
    $output .= " | End of row<br>";
}
    

echo "$output<br>";

?>

<?php
$output = "";
$input = "
11111
19991
19191
19991
11111
";

// 0  1  2  3  4  5  6  7  8  9
// 10 11 12 13 14 15 16 17 18 19 

$input = str_replace("\r\n", "", $input);
$inputArray = str_split($input);


$scoreArray = array();
$scoreArray2 = array();

$i = 0;
foreach ($inputArray as $row) {
    $rowArray[$i] = str_split($row);
    $i ++;
}

$maxRow = count($rowArray);
$maxCol = count($rowArray[0]);

function plusOne($num)
{
    $num = $num + 1;
    $num = $num % 10;
    return $num;
}


for ($row = 0; $row < $maxRow; $row ++) {
    
    for ($col = 0; $col < $maxCol; $col ++) {
        //$output .= "Row: $row<br>";
        //$output .= "Col: $col<br>";
        //$output .= $rowArray[$row][$col] . "<br>";
        
        $current = $rowArray[$row][$col];
        $output .= $current;
        // end col
    }
    
    // end row
    $output .= " | End of row $row<br>";
}

$output .= "<br>";

for ($row = 0; $row < $maxRow; $row ++) {
    $newArray = array_map("plusOne",$rowArray[$row]);
    $rowArray[$row] = $newArray;
    for ($col = 0; $col < $maxCol; $col ++) {
        //$output .= "Row: $row<br>";
        //$output .= "Col: $col<br>";
        //$output .= $rowArray[$row][$col] . "<br>";
        
        $current = $rowArray[$row][$col];
        $output .= $current;
        // end col
    }
    // end row
    $output .= " | End of row $row<br>";
}





echo "$output<br>";

?>


