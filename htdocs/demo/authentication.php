<?php
$title = "Test App";
$description = "This app demonstrates authentication and CSRF.";
include "headerScript.php";
$random = mt_rand();
$csrfFile = fopen("tools\csrf\\$random", "w") or die("Unable to open file!");
fclose($csrfFile);
$outputAuth = "";
$outputAuthStatus = "";
if (! isset($_COOKIE["auth"])) {
    $outputAuthStatus .= "You are not logged in.";
    $outputAuth .= "
<form action=\"tools/cookieTool.php\" method=\"post\">
    <input type=\"hidden\" name=\"webFunction\" value=\"set\">
    <input
    type=\"hidden\" value=\"auth\" name=\"webCookieName\" required>
    <input
    type=\"hidden\" value=\"1\" name=\"webCookieValue\" required>
    <button
    class=\"w3-btn w3-hover-shadow-blue w3-white w3-border w3-border-blue w3-round-large\"
    type=\"submit\">Click here to LOG IN</button>
	</form>
";
} else {
    $outputAuthStatus .= "You are logged in.";
    $outputAuth .= "
<form action=\"tools/cookieTool.php\" method=\"post\">
    <input type=\"hidden\" name=\"webFunction\" value=\"set\">
    <input
    type=\"hidden\" value=\"auth\" name=\"webCookieName\" required>
    <input
    type=\"hidden\" value=\"\" name=\"webCookieValue\" required>
    <button
    class=\"w3-btn w3-hover-shadow-red w3-white w3-border w3-border-red w3-round-large\"
    type=\"submit\">Click here to LOG OUT</button>
    </form>
";
}
$appStatus = "OK";
$appValue = "The app has no message.";
$cookieArr = $_COOKIE;
if (isset($cookieArr["SomeValue"]))
    $appValue = $cookieArr["SomeValue"];
if (! isset($_COOKIE["auth"]))
    $appValue = "Login to see app message.";
if (isset($cookieArr["appStatus"]))
    $appStatus = $cookieArr["appStatus"];
?>
<div class="w3-row">
	<div class="w3-left">
		<div class="w3-panel">
			<b><?=$outputAuth?></b>
		</div>
		
	</div>
	<div class="w3-rest w3-container">
		<div
			class="w3-card w3-hover-shadow w3-margin-top w3-margin-bottom w3-padding w3-border">
			<b>Auth Status:</b> <br><?=$outputAuthStatus?>
			<p>
				<b>App Status:</b> <br><?=$appStatus?>
			<p>
				<b>App Message:</b> <br><?=$appValue?>    
		</div>
	</div>
	<div class="w3-row">
	
		<div class="w3-half w3-container">
			<div
				class="w3-card w3-padding w3-margin-top w3-margin-bottom w3-hover-shadow">
				<h2>Set App Message</h2>
				<p class="w3-left-align">This function is vulnerable to CSRF.
				
				
				<form action="tools/functionTool.php" method="get">
					<input type="hidden" name="webFunction" value="set"> <input
						type="hidden" name="webCSRF" value="no"> <input
						class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
						type="hidden" value="SomeValue" name="webCookieName" required> <input
						class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
						type="input" placeholder="Type something" name="webCookieValue"
						required> <b><button
							class="w3-hover-shadow-blue w3-margin-top w3-block w3-btn w3-white w3-border w3-border-blue w3-round-large"
							type="submit">Set App Message</button></b>
				</form>
			</div>
		</div>

		<div class="w3-half w3-container">
			<div
				class="w3-card w3-padding w3-margin-top w3-margin-bottom w3-hover-shadow">
				<h2>Set App Message</h2>
				<p class="w3-left-align">This function is <b>NOT</b> vunerable to CSRF.
				<br>Your CSRF Token is: <b><?=$random?></b>
				
				
				<form action="tools/functionTool.php" method="get">
					<input type="hidden" name="webFunction" value="set"> <input
						type="hidden" name="webCSRF" value="<?=$random?>"> <input
						class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
						type="hidden" value="SomeValue" name="webCookieName" required> <input
						class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
						type="input" placeholder="Type something" name="webCookieValue"
						required> <b><button
							class="w3-hover-shadow-blue w3-margin-top w3-block w3-btn w3-white w3-border w3-border-blue w3-round-large"
							type="submit">Set App Message</button></b>
				</form>
			</div>
		</div>
	</div>
	

<?php
// start functions
$outputFunctions = "
<ul
class=\"	w3-ul w3-block w3-border w3-left w3-hover-shadow w3-margin-bottom  
\"
>
<li class=\"w3-black w3-xlarge w3-padding-32\">Functions
</li>
<div class=\"w3-col w3-half w3-container w3-margin-top\">
<ul
	class=\"w3-ul w3-block w3-border w3-left w3-hover-shadow w3-margin-bottom\"
>
<li class=\"w3-black w3-xlarge w3-padding-32\">No CSRF Protection</li><li>
 <li class=\"\"><h2>POST Function:</h2>";
$outputFunctions .= "
<form action=\"tools/functionTool.php\" method=\"post\">
<input type=\"hidden\" name=\"webFunction\" value=\"set\">
<input type=\"hidden\" name=\"webCSRF\" value=\"no\">
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"hidden\" value=\"SomeValue\" name=\"webCookieName\" required>
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"input\" placeholder=\"Type something\" name=\"webCookieValue\" required>
<button
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-border-red w3-round-large\"
    type=\"submit\">Set Some Value</button>
</form>
</li>
";
$outputFunctions .= "<li class=\"\"><h2>GET Function:</h2>";
$outputFunctions .= "
<form action=\"tools/functionTool.php\" method=\"get\">
<input type=\"hidden\" name=\"webFunction\" value=\"set\">
<input type=\"hidden\" name=\"webCSRF\" value=\"no\">
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"hidden\" value=\"SomeValue\" name=\"webCookieName\" required>
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"input\" placeholder=\"Type something\" name=\"webCookieValue\" required>
<button
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-border-red w3-round-large\"
    type=\"submit\">Set Some Value</button>
</form>
</li>
</ul>
</div>
<div class=\"w3-col w3-half w3-container w3-margin-top\">
<ul
	class=\"w3-ul w3-block w3-border w3-left w3-hover-shadow w3-margin-bottom\"
>
<li class=\"w3-black w3-xlarge w3-padding-32\">CSRF Protection</li><li>    
	";
// CSRF Tokens
$outputFunctions .= "<li class=\"\"><h2>POST Function:</h2>";
$outputFunctions .= "
<form action=\"tools/functionTool.php\" method=\"post\">
<input type=\"hidden\" name=\"webFunction\" value=\"set\">
<input type=\"hidden\" name=\"webCSRF\" value=\"$random\">
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"hidden\" value=\"SomeValue\" name=\"webCookieName\" required>
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"input\" placeholder=\"Type something\" name=\"webCookieValue\" required>
<button
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-border-red w3-round-large\"
    type=\"submit\">Set Some Value</button>
</form>
</li>
";
"<li class=\"\"><h2>Current Cookies:</h2>";
$outputFunctions .= "<li class=\"\"><h2>GET Function:</h2>";
$outputFunctions .= "
<form action=\"tools/functionTool.php\" method=\"get\">
<input type=\"hidden\" name=\"webFunction\" value=\"set\">
<input type=\"hidden\" name=\"webCSRF\" value=\"$random\">
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"hidden\" value=\"SomeValue\" name=\"webCookieName\" required>
<input
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large\"
    type=\"input\" placeholder=\"Type something\" name=\"webCookieValue\" required>
<button
    class=\"w3-margin-top w3-block w3-btn w3-white w3-border w3-border-red w3-round-large\"
    type=\"submit\">Set Some Value</button>
</form>
</li>
</ul>
</ul>
</div>
</div>
";
echo $outputFunctions;
// end functions
?>
<?php include $footerFile; ?>