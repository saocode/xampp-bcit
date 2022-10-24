<?php include "headerScript.php";?>

<div class="w3-container" style="">

<?php
// Script logic is based on webFunction argument sent from HTML forms in encoding.php page.

$function = $_POST["webFunction"];

switch ($function) {

    case "char":
        charEncode();
        break;

    case "string":
        stringEncode();
        break;

    // urlencode() already exists in PHP so my custom version is url3ncode.
    case "url":
        url3ncode();
        break;

    case "range":
        rangeEncode();
        break;
        
    case "base64e":
        base643ncode();
        break;
        
    case "base64d":
        base64d3code();
        break;

    default:
        echo $_POST["function"];
}
?>


<?php

function charEncode()
{
    // binary input from browser
    $binInput = $_POST["webString"];
    // convert input from binary to hex
    $hexInput = bin2hex($binInput);
    // is this redundant? (is $hexInput == $byteArray)
    $byteArray = byteArray($hexInput);
    // string of bytes seperated by spaces
    $byteString = byteString($hexInput);

    // input validation
    isPost();
    isEmpty($binInput);
    // fix this howLong($binInput, 1);

    // convert the input to ASCII/Unicode values
    $unicodeDec = mb_ord($binInput);
    $unicodeHex = dechex($unicodeDec);

    // output HTML
    $output = "<h1>Input</h1>";
    $output .= "<p>Your input was:<br>";
    $output .= htmlCodeStart() . "<font size=\"+2\">$binInput</font>" . htmlCodeEnd();
    $output .= "\r\n\r\n";

    // zero padding for compart.com hyperlink generation
    $bytePad = "";

    if (isMulti($byteArray)) {
        $output .= "<p>This is a <b>multi-byte</b> character.\r\n\r\n";
        $strLen = mb_strlen($unicodeHex);

        // if byte array is only 3 characters long it needs a single zero padding
        if ($strLen < 4 && $strLen % 2) {
            $bytePad = "0";
        } else {
            // if byte array is 4 or more characters it doesn't need padding
            $bytePad = "";
        }
    } else {
        $output .= "<p>This is a <b>single-byte</b> character.\r\n\r\n";
        // single byte characters need two zeros padding
        $bytePad = "00";
    }

    $output .= "<p>The input byte stream was: <b>$byteString</b>";
    $output .= "<hr>";
    $output .= "<h1>Unicode Code Points</h1>";

    $output .= "\r\n\r\n<p>The character's code point is: <b>U+$unicodeHex</b>";
    $output .= "<p><a href=\"https://www.compart.com/en/unicode/U+$bytePad$unicodeHex\" target=\"_blank\">Click here for more Unicode details.</a>";
    // unicode info
    $output .= "<hr>";
    $output .= "\r\n\r\n<h1>Output</h1>\r\n\r\n";
    $output .= "<p>HTML entity encoding can use a hex or decimal code point to display the character.\n\n";
    $output .= "<p>HTML encoding (hex): <b>&amp#0x$unicodeHex</b> </p>\r\n\r\n";
    $output .= "<p>Use <b>View Source</b> to see HTML entity encoding in use here: &#x$unicodeHex;</p>\r\n\r\n";
    $output .= "<p>HTML entity encoding (decimal): <b>&amp#$unicodeDec</b> </p>\r\n\r\n";
    $output .= "<p>Use <b>View Source</b> to see HTML entity encoding in use here: &#" . $unicodeDec . "</p>\r\n\r\n";

    // render HTML
    echo $output;
    echo "<hr>\r\n\r\n";
    echo returnButton();
}



function stringEncode()
{
    $binInput = $_POST["webString"];

    $output = "<p>You sent the server this input: ";
    $output .= "<b>$binInput</b>";

    $hexInput = bin2hex($binInput);

    // input validation
    isPost();
    isEmpty($binInput);
    // howLong($binInput, 1);

    $byteString = byteString($hexInput);

    $output .= "</h1>\r\n\r\n";
    $output .= "<p>Which the server received this as this bytestream: <b>$byteString</b>";
    // render HTML
    echo $output;
    echo "<hr>\r\n\r\n";
    echo returnButton();
}

function url3ncode()
{
    // binary input from browser
    $binInput = $_POST["webString"];
    $hexInput = bin2hex($binInput);
    
    // input validation
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
    echo "<hr>";
    echo returnButton();
}
    
function base643ncode()
{
    // binary input from browser
    $binInput = $_POST["webString"];
    $hexInput = bin2hex($binInput);
    
    // input validation
    isPost();
    isEmpty($binInput);
    
    $b64 = base64_encode($binInput);
 
    
    $output = "<h1>Your input was:</h1><p>";
    $output .= $binInput;
    $output .= "<h1>The Base64 encoding for this data is:</h1><p>";
    $output .= $b64;
    echo $output;
    echo "<hr>";
    echo returnButton();
}

function base64d3code()
{
    // binary input from browser
    $binInput = $_POST["webString"];
    $hexInput = bin2hex($binInput);
    
    // input validation
    isPost();
    isEmpty($binInput);
    
    $b64 = base64_decode($binInput);
    
    
    $output = "<h1>Your input was:</h1><p>";
    $output .= $binInput;
    $output .= "<h1>The Base64 decoding for this data is:</h1><p>";
    $output .= $b64;
    echo $output;
    echo "<hr>";
    echo returnButton();
}

function rangeEncode()
{
    // input validation
    isPost();

    $start = $_POST["start"];
    $end = $_POST["end"];
    $data = array();

    // input validation
    isEmpty($start);
    isEmpty($end);
    isNumber($start);
    isNumber($end);

    // create array to output
    $data = array();
    // populate in ascending or descending
    if ($start < $end) {
        for ($x = $start; $x <= $end; $x ++) {
            // echo "&#" . $x . "&nbsp";
            array_push($data, $x);
        }
        ;
    } else {
        for ($x = $start; $x >= $end; $x --) {
            // echo "&#" . $x . "&nbsp";
            array_push($data, $x);
        }
        ;
    }

    // how many columns?
    $columns = 10;
    // how many rows?
    $rows = ceil(count($data) / $columns);

    // write HTML table
    $output = "<table>";
    $output .= '<tr>';
    foreach ($data as $k => $value) {
        $output .= "<td>&#";
        $output .= $value;
        $output .= "</td>";
        $column = ($k + 1) % $columns;
        if (! $column) {
            $output .= '</tr>';
        }
    }
    $output .= '</table>';

    echo returnButton();
    echo "<hr>";
    // return HTML table
    echo $output;
}

function returnButton()
{
    echo "<form action=\"../encoding.php\" method=\"post\">
	<p>
		<button class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\"
			type=\"submit\">Thanks!</button>


</form>";
}
?>

<?php include $footerFile; ?>