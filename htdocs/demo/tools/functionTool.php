<?php include "headerScript.php";?>


<?php

if (isset($_COOKIE["appStatus"])) {
	unset($_COOKIE["appStatus"]);
	setcookie("appStatus", '', time() - 3600, '/'); // empty value and old timestamp
}

if (! isset($_COOKIE["auth"])) {
    setcookie("appStatus", "Please login to use functions.", time() + (86400 * 30), "/"); // 86400 = 1 day   
}
else {
    setcookie("Message", "", time() + (86400 * 30), "/"); // 86400 = 1 day
}

if (isset($_COOKIE["auth"])) {
    if (sizeof($_POST) > 0) {
    $webMethod = $_POST;
}
if (sizeof($_GET) > 0) {
    $webMethod = $_GET;
}
if ($webMethod["webCSRF"] == "no") {
    $noCSRF = TRUE; 
    setcookie("lastCSRF", "None", time() + (86400 * 30), "/"); // 86400 = 1 day
    
}
    else $noCSRF = FALSE;

$tokenFile = $webMethod["webCSRF"];
$csrfCheck = sizeof(glob("csrf\\$tokenFile"));

if (!$noCSRF) {
    

if ($csrfCheck) {
    setcookie("lastCSRF", "Pass", time() + (86400 * 30), "/"); // 86400 = 1 day
}
else {
    setcookie("lastCSRF", "Fail", time() + (86400 * 30), "/"); // 86400 = 1 day
}

}

if ($noCSRF || $csrfCheck) $csrfCheck = TRUE;

if (!$csrfCheck) {

    //setcookie($webCookieName, , time() + (86400 * 30), "/"); // 86400 = 1 day
  
}



$function = $webMethod["webFunction"];
$output = null;
//$referer = $_SERVER["HTTP_REFERER"];

switch ($function) {
 
    case "set":
        if ($csrfCheck){
        $webCookieName = $webMethod["webCookieName"];
        $webCookieValue = $webMethod["webCookieValue"];
        setcookie($webCookieName, $webCookieValue, time() + (86400 * 30), "/"); // 86400 = 1 day
        }
        break;
    

        
     default:
        echo $webMethod["webFunction"];
}
}
//header("Location: $referer");
header("Location: ../authentication.php");
?>


