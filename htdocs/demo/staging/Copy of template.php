<?php
// $title = "Title";
// $description = "Description.";
include "headerScript.php";
?>

    <div class="w3-container">
    	<div class="w3-card w3-hover-shadow w3-padding w3-margin-top">

<?php
$output = "";

$output = "";
$fileName = "input.txt";

// Open the file
$fp = @fopen($fileName, 'r');

// Add each line to an array
if ($fp) {
    $array = explode("\n", fread($fp, filesize($fileName)));
}

$multiArray = array();

$output = $array[0];
$i=0;
foreach($array as $value){
    $space = strpos($value, " ");
    $instruction = substr($value, 0, $space);
    $value = substr($value, $space);
    $multiArray[$i][0] = $instruction;
    $multiArray[$i][1] = $value;
    
    $i++;
}
$aim = 0;
$h = 0;
$d = 0;
$i=0;
foreach($multiArray as $value){
    switch ($value[0]){
    case "forward":

        echo $i . "forward<br>";
        $h = $h + $value[1];
        $d = $d - $aim * $value[1];
        break;

    case "up":
        
        echo  $i . "up<br>";
        $aim = $aim - $value[1];
        break;
        
    case "down":
        $aim = $aim + $value[1];
        echo $i . "down<br>";
        break;
    
    default:
        echo $i . "default<br>";
    }
    $i++;
}
$output = $h*$d;
echo $output;
?>


    	</div>
    </div>
<?php include $footerFile; ?>