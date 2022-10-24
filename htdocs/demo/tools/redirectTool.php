<?php include "headerScript.php";?>


<ul
	class="w3-ul w3-border w3-left w3-hover-shadow w3-margin-right  w3-margin-bottom"
	style="max-width: 100%; overflow-x: hidden"	>
	<li class="w3-black w3-xlarge w3-padding-32">Open Redirect</li>
<li>

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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dest = $_REQUEST["dest"];
    
    $output = "<p>Open redirect links (with warning):<p>\r\n";
    //no encoding
    $link = $rootURL . "/tools/redirectTool.php?d=" . $dest;
    $output .= "<a href=\"" . $rootURL . "/tools/redirectTool.php?d=";
    $output .= $dest . "\">$link</a><br><br>";
    //dest encoded
    $link = $rootURL . "/tools/redirectTool.php?d=" . url($dest);
    $output .= "<a href=\"" . $rootURL . "/tools/redirectTool.php?d=";
    $output .= url($dest) . "\">$link</a><br><br>";
    //full url encoded
    $link =  url($rootURL . "/tools/redirectTool.php?d=" . $dest);
    $output .= "<a href=\"" . $rootURL . "/tools/redirectTool.php?d=";
    $output .= url($dest) . "\">$link</a><br><br>";
    
    $output .= "<p>Open redirect links (no warning):<p>\r\n";
    
    //no encoding
    $link = $rootURL . "/tools/noWarningRedirect.php?d=" . $dest;
    $output .= "<a href=\"" . $rootURL . "/tools/noWarningRedirect.php?d=";
    $output .= $dest . "\">$link</a><br><br>";
    //dest encoded
    $link = $rootURL . "/tools/noWarningRedirect.php?d=" . url($dest);
    $output .= "<a href=\"" . $rootURL . "/tools/noWarningRedirect.php?d=";
    $output .= url($dest) . "\">$link</a><br><br>";
    //full url encoded
    $link =  url($rootURL . "/tools/noWarningRedirect.php?d=" . $dest);
    $output .= "<a href=\"" . $rootURL . "/tools/noWarningRedirect.php?d=";
    $output .= url($dest) . "\">$link</a><br><br>";
   
    
    echo $output;
} else {
    $output = "<p>This is an example of an open redirect.<br>
<p>You are about to be sent to a potentially evil site.<br>
<p>Usually you would not get this warning.<br>";
    $output .= "<hr>
<form action=\"http://";
    $output .= $_REQUEST["d"];
    $output .= "\" method=\"post\">";
    $output .= "<p>
		<button class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\"
			type=\"submit\">Thanks!</button>
</form>
</body>
</html>";
    
echo $output;
}

?>
</li>
</ul>

<?php include $footerFile; ?>
