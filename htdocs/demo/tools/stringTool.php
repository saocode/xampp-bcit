<?php include "headerScript.php";?>

<div class="w3-container" style="">


<?php

$function = $_POST["webFunction"];
$output = null;
switch ($function) {

    case "length":
        $string = $_POST["webText"];
        $output = "<p><b>PHP strlen()</b> thinks this string is <b>";
        $output .= strlen($string);
        $output .= " character(s)</b> long.<br>";
        $output .= "<p><b>PHP strlen() + utf8_decode()</b> thinks this string is <b>";
        $output .= strlen(utf8_decode($string));
        $output .= " character(s)</b> long.";
        $output .= "<p><b>PHP mb_strlen()</b> thinks this string is <b>";
        $output .= mb_strlen($string);
        $output .= " character(s)</b> long.";
        $output .= "<p><b>Javascript length()</b> thinks this string is  <b><span id=\"jsLength\"></span> character(s)</b> long.";
        $output .= //JS string length
        
"<body onload=\"jsStrLen()\">            
<script>
function jsStrLen() {
    str = \"" . $string . "\";
    len = str.length;
    span = document.getElementById(\"jsLength\");
    node = document.createTextNode(len);
    span.appendChild(node);
}
</script>";
         
        
        break;

    default:
        echo $_POST["webFunction"];
}


echo $output;





?>

<hr>
<form action="../encoding.php" method="post">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Thanks!</button>

</form>
<?php include $footerFile; ?>