<?php include "headerScript.php";?>


<?php

function url($input){
$hexInput = bin2hex($input);

// put bytes into array 
$byteArray = array();
for ($i = 0; $i < strlen($hexInput) / 2; $i ++) {
    array_push($byteArray, substr($hexInput, $i * 2, 2));
    // echo substr($hex, $i * 2, 2) . " ";
}
// put bytes into string
$byteString = "%";
for ($i = 0; $i < strlen($hexInput) / 2; $i ++) {
    $byteString .= substr($hexInput, $i * 2, 2) . "%";
    }
$byteString = rtrim($byteString, "%");    
return $byteString;
}

?>

<?php

$dest = $_REQUEST["d"];
header("Location: http://$dest");
    

?>