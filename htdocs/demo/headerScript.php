<?php $headerFile = "header.php";
$footerFile = "footer.php";
$sourceURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
$rootURL =  $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]);
$domainURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . "/";
$lastTwo = (substr($rootURL, -1));
$twoSlash = "\\";
if ($lastTwo == $twoSlash) $rootURL = substr($rootURL, 0, -1);
$headerExists = file_exists($headerFile);
while (!$headerExists){
    $headerFile = "../" . $headerFile;
    $footerFile = "../" . $footerFile;
    $slashPos = strrpos($rootURL, "/");
    //$slashPos++;
    $rootURL = substr($rootURL, 0, $slashPos);
    $headerExists = file_exists($headerFile);}
if (substr("$rootURL", -1) != "/") $rootURL .= "/";
$includeHeader = $headerFile;
include $includeHeader;?>
