<?php include "headerScript.php";?>


<?php
// binary input from browser
$binInput = $_POST["char"];
$hexInput = bin2hex($binInput);

//input validation
isPost();
isEmpty($binInput);

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


$output = "<h1>Your input was:</h1><p>";
$output .= $binInput;
$output .= "<h1>The URL encoding for this data is:</h1><p>";
$output .= $byteString;
echo $output;
?>

<hr>
<form action="../encoding.php" method="post">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Thanks!</button>
</form>
<?php include $footerFile; ?>