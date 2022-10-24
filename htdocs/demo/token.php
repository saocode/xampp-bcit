<?php
$title = "Token Tool";
$description = "Tokens can be used for authentication.";
include "headerScript.php";

$time = time();
$time10 = substr($time, 0, 9);
$time100 = substr($time, 0, 8);

//variables that start with "web" are provided by client/browser
$function = FALSE;
$webUsername = FALSE;
$webToken = FALSE;
$token = FALSE;
$tokenValid = FALSE;

if (isset($_POST["webFunction"])) $function = $_POST["webFunction"];
if (isset($_POST["webToken"])) $webToken = $_POST["webToken"];
if (isset($_POST["webUsername"])) $webUsername = $_POST["webUsername"];

$output = null;

function getToken($tokenTime, $secret = "DONTHARDCODESECRETSIDIOT")
{
    global $webUsername;
    $input = $webUsername;
    $token = hash("SHA256", $tokenTime.$secret.$input);
    $token = substr($token, 0, 6);
    return $token;
}

switch ($function) {
    
    case "get":

$token = getToken($time10);
        
        break;
 
    case "check":        
        $howMany = 10;
        $validTokens = [];
        $pastToken = getToken($time10);
        array_push($validTokens, $pastToken);
        
        while ($howMany > 0){            
            $pastTime = $time10-$howMany;
            $pastToken = getToken($pastTime);
            array_push($validTokens, $pastToken);
            $howMany--;
        }
        
       if (in_array($webToken, $validTokens)) $tokenValid = "YES"; else $tokenValid = "NO";
            
        break;
    
 
}

?>




<div class="w3-row-padding w3-col-padding w3-center w3-margin-top">

	<div class="w3-half">
		
<?php 
		
		$tokenPanel = "
<div
			class=\"w3-card w3-container w3-hover-shadow w3-margin-bottom\"
		>
Your token is:
<h1>$token</h1>
</div>
";
		
		if (!$function){}
		else if ($function == "get")echo $tokenPanel;
?>
			<div
			class="w3-card w3-container w3-hover-shadow w3-margin-bottom"
		>
			<h3>Get a Token</h3>
			<br> <i
				class="fas fa-key w3-margin-bottom w3-text-theme"
				style="font-size: 120px"
			></i>
  
<form
	action="token.php"
	method="post"
>
	<input
		type="hidden"
		name="webFunction"
		value="get"
	> <input
		class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
		type="text"
		placeholder="Username (optional)"
		name="webUsername"
	> 
	<button
		class="w3-margin-top w3-margin-bottom w3-block w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="submit"
	>Get Token</button>
</form>
  

  </div>
	</div>
	
	
	<div class="w3-half">
	
	<?php 
		$checkPanel = "
<div
			class=\"w3-card w3-container w3-hover-shadow w3-margin-bottom\"
		>


Valid?
<h1>$tokenValid</h1>
</div>
";
		
		if (!$function){}
		else if ($function == "check") echo $checkPanel;
?>


		<div
			class="w3-card w3-container w3-hover-shadow w3-margin-bottom"
		>
			<h3>Check a Token</h3>
			<br> <i
				class="fas fa-lock w3-margin-bottom w3-text-theme"
				style="font-size: 120px"
			></i>
			
			<form
	action="token.php"
	method="post"
>
	<input
		type="hidden"
		name="webFunction"
		value="check"
	> <input
		class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
		type="text"
		placeholder="Username (optional)"
		name="webUsername"
	> 
	<input
		class="w3-margin-top w3-block w3-btn w3-white w3-border w3-round-large"
		type="text"
		placeholder="Token (mandatory)"
		name="webToken"
		required
	> 
	<button
		class="w3-margin-top w3-margin-bottom w3-block w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="submit"
	>Check Token</button>
</form>



	


