<?php include "headerScript.php";?>


<?php
$function = $_POST["webFunction"];
$output = null;
$referer = $_SERVER["HTTP_REFERER"];

switch ($function) {
    
    case "set":
        $webCookieName = $_POST["webCookieName"];
        $webCookieName = str_replace(' ', '', $webCookieName);
        $webCookieValue = $_POST["webCookieValue"];
        setcookie($webCookieName, $webCookieValue, time() + (86400 * 30), "/"); // 86400 = 1 day
        if ($webCookieName = "auth") {
            setcookie("Message", "", time() + (86400 * 30), "/"); // 86400 = 1 day
        }
        break;
 
    case "set":
        $webCookieName = $_POST["webCookieName"];
        $webCookieName = str_replace(' ', '', $webCookieName);
        $webCookieValue = $_POST["webCookieValue"];
        setcookie($webCookieName, $webCookieValue, time() + (86400 * 30), "/"); // 86400 = 1 day
        if ($webCookieName = "auth") {
            setcookie("Message", "", time() + (86400 * 30), "/"); // 86400 = 1 day
        }
        break;
    
    case "delete":
        if (! isset($_POST["webDelete"])) {
            $referer = $_SERVER["HTTP_REFERER"];
            header("Location: $referer");
        }
        
        foreach ($_POST["webDelete"] as $cookieName) {
            if (isset($_COOKIE[$cookieName])) {
                unset($_COOKIE[$cookieName]);
                setcookie($cookieName, '', time() - 3600, '/'); // empty value and old timestamp
            }
        }
        break;
        
     default:
        echo $_POST["webFunction"];
}

header("Location: $referer");
?>


