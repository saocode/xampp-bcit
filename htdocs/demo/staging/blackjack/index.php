<?php 
// Get app context from the request and include site header functions and HTML
$serverScript = $_SERVER["SCRIPT_NAME"];
$appName = substr($serverScript, 1);
$slashPos = stripos($appName, "/");
$appName = substr($appName, 0, $slashPos);
$appURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $appName;
$appDir = $_SERVER["DOCUMENT_ROOT"] . "/" . $appName . "/";
$include = $appDir . "/header.php";
include $include;
include "blackjack.php";
// Page metadata, header HTML and <body> tag are automatic (in header.php) ?>


<?php 
$output = "";
$function = "";
$output .= $buttons;

//foreach ($_COOKIE as $key => $val) $output .= "$key is $val<br>\r\n";
    
    
                    
if (! isset($_COOKIE["bjGame"])) {
    $output .= "<p>No existing game<br>";
} 

if (isset($_POST["webFunction"])) {
    $function = $_POST["webFunction"];
} else {
    echo "<p>No function.<br>";
    $function = "New";
    
}



switch ($function){
    case "New":
        $game = deal();
        $gameJSON = json_encode($game);
        setcookie("bjGame", $gameJSON);
        break;
        
    case "Resume":
        if (! isset($_COOKIE["bjGame"])) {
            $output .= "<p>No existing game<br>";
        } else {
             $gameCookie = $_COOKIE["bjGame"];}
        
             $game = json_decode($gameCookie);
break;
        
    
}

// Show cards
$output .= "<ul style=\"width:300px\" class=\"w3-container w3-border w3-round-large\">
    ";
foreach ($game->hands as $hands){
    $output .= $hands->id . ":&nbsp";
    foreach ($hands->cards as $cards)$output .= $cards->html;
    $output .= "<br>";
}
$output .= "</ul>";


echo $output;
?>






<?php 
// Include site footer
$output .= "</div>";
$footer = $appDir . "/footer.php";
include $footer;
?>
</body>
</html>