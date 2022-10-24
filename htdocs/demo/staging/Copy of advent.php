<?php
//$title = "Title";
//$description = "Description.";
include "headerScript.php";?>
<div class="w3-card w3-center w3-container w3-hover-shadow w3-margin-top w3-padding-top">
<div class="w3-center">

<?php
$output = "";
$fileName = "input.txt";

// Open the file
$fp = @fopen($fileName, 'r');

// Add each line to an array
if ($fp) {
    $array = explode("\n", fread($fp, filesize($fileName)));
}
$lineNumber = 0;
$i = 0;
$ii = 0;
$iii = 0;
$lastValue = FALSE;
$lastValue2 = FALSE;
$lastValue3 = FALSE;
$count = count($array);

// if last three values are numbers start calculations

// am I a number

// was the last one a number?

// and the one before that?


// if these are the first three get sum and save as last sum


// if these are not the first three get sum and compare to last sum

// if the new sum is higher, i++ 

// iterate one line and repeat

// if these are the last three then stop calculations



foreach ($array as $value) {
    
    $lineNumber++;
    
    if ($lineNumber > 3) {
     
        $sum = $value+$lastValue+$lastValue2;
        $lastSum = $lastValue+$lastValue2+$lastValue3;
    
        $lastValue3 = $lastValue2;
        $lastValue2 = $lastValue;
        $lastValue = $value;
        
        
        if ($sum > $lastSum) {
        
            echo "hi<br>";
            $i++;
            
        } else {
        echo "low<br>";
    }
    }
    else {
        $lastValue3 = $lastValue2;
        $lastValue2 = $lastValue;
        $lastValue = $value;
    }
}

    echo $lineNumber . "<br>";
    


$output = $i;
echo $output;
?>

<?=$output?>Put HTML content here.<br>

</div>
</div>
<?php include $footerFile; ?>