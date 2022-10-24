<?php 

$include = $_SERVER["DOCUMENT_ROOT"] . "/demo/header.php";
include $include;
?>

<?php
// binary input from browser
$binInput = $_POST["char"];
$hexInput = bin2hex($binInput);

//input validation
isPost();
isEmpty($binInput);
// fix this: howLong($binInput, 1);

// convert the input to ASCII/Unicode values
$firstByteDec = ord($binInput);
$multiByteDec = uniord($binInput);
$hexOrd = dechex($multiByteDec);

// put bytes into array 
$byteArray = array();
for ($i = 0; $i < strlen($hexInput) / 2; $i ++) {
    array_push($byteArray, substr($hexInput, $i * 2, 2));
    // echo substr($hex, $i * 2, 2) . " ";
}
// put bytes into string
$byteString = "";
for ($i = 0; $i < strlen($hexInput) / 2; $i ++) {
    $byteString .= substr($hexInput, $i * 2, 2) . " ";
}

// is array more than 1 byte?
function isMulti($array){
    if (count($array) > 1) return true; else return false;
}

// for multibyte chars
function uniord($u)
{
    $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
    $k1 = ord(substr($k, 0, 1));
    $k2 = ord(substr($k, 1, 1));
    return $k2 * 256 + $k1;
}
?>

<?php
$output = "<h1>Your input was: ";
$output .= $binInput;
// multibyte info
if (isMulti($byteArray)) {
    $output .= "</h1><p>This is a multibyte character.\r\n
    <p>The input bytes (hex) are: " . $byteString . 
    "<p>The character's decimal value is: " . $multiByteDec . 
    "<p>The character's hex value is: " . $hexOrd;
// unibyte info    
}
    else {$output .= 
    "</h1><p>This is a single byte character.\r\n
    <p>The input bytes (hex) are: " . $byteString . 
    "<p>The ASCII code (decimal) is: " . $firstByteDec . 
    "<p> The ASCII code (hex) is: " . $hexInput;
};
// unicode info
$output .= "<h1>Display decimal unicode output...</h1>";
$output .= "<p>Unicode value: &amp#" . $multiByteDec . "</p>\r\n";
$output .= "<p>Unicode representation: &#" . $multiByteDec . "</p>\r\n";
$output .= "<h1>Display hex unicode output...</h1>";
$output .= "<p>Unicode value: &amp#0x" . $hexOrd . "</p>\r\n";
$output .= "<p>Unicode representation: &#x$hexOrd;</p>";
// render HTML
echo $output;
?>

<hr>
<form action="../encoding.php" method="post">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Thanks!</button>
</form>
</body>
</html>