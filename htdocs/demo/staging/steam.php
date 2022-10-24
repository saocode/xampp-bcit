<?php
namespace Facebook\WebDriver;
require_once('vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
$output = "";

$output .= date("H:i:s");
$output .=  "<br>";

$myfile = fopen("steamFile.htm", "r") or die("Unable to open file!");
// echo fread($myfile,filesize("file.htm"));

$output .=  "Opened file.htm";
$output .=  "<br>";

$linkArr = array();

$missing = false;

while (($buffer = fgets($myfile)) !== false) {
    if (strpos($buffer, "Assets that are missing") !== false) {
        $missing = TRUE;
    }
    
    if (strpos($buffer, "Duplicate asset names") !== false) {
        $missing = false;
    }
    
    
    if ($missing == true){
        
        // Is there a bug?
        $bug = false;
        
        preg_match('/Asset bugs/', $buffer, $output_array);
        if (count($output_array) > 0) $bug = true;
        preg_match('/uses private asset/', $buffer, $output_array);
        if (count($output_array) > 0) $bug = true;
        preg_match('/no link is available/', $buffer, $output_array);
        if (count($output_array) > 0) $bug = true;
        preg_match('/does not contain/', $buffer, $output_array);
        if (count($output_array) > 0) $bug = true;
        
        // No
        if (!$bug) {
        
        // Look for URL    
        preg_match('/http.[^"]*/', $buffer, $output_array);
        
        // var_dump($output_array);
        if (count($output_array) > 0) array_push($linkArr, $output_array[0]);
        }
    }
    
}
fclose($myfile);

$steamArr = $linkArr;

// $host = 'http://localhost:4444';
// $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
// var_dump($driver);


// An example of using php-webdriver.
// Do not forget to run composer install before. You must also have Selenium server started and listening on port 4444.


        
// This is where Selenium server 2/3 listens by default. For Selenium 4, Chromedriver or Geckodriver, use http://localhost:4444/
$host = 'http://localhost:4444';
$capabilities = DesiredCapabilities::chrome();
//$capabilities->setCapability("chromeOptions","user-data-dir=/path/to/your/custom/profile");
$options = new ChromeOptions();
$options->addArguments(["start-maximized"]);
$options->addArguments(["start-maximized"]);
$options->addArguments(["user-data-dir=c:/Dev/chrome"]);

$capabilities->setCapability("chromeOptions", $options);


try{
$driver = RemoteWebDriver::create($host, $capabilities);
}

catch (Exception\InvalidArgumentException $e){
    $output .=  "Selenium Browser profile is open.";
    $output .=  "<br>";
    
}


foreach ($steamArr as $link) {
    

// navigate to Selenium page on Wikipedia
$driver->get($link);


// print title of the current page to output
$output .=  "The title is '" . $driver->getTitle() . "'\n";
$title = $driver->getTitle();

$output .=  "<br>";


// print URL of current page to output
$output .=  "The current URL is '" . $driver->getCurrentURL() . "'\n";
$output .=  "<br>";




if ($title != 'Steam Community :: Error'){
try {
    $subscribeButton = 
    $driver->findElement(WebDriverBy::cssSelector('#SubscribeItemOptionAdd'));
   
    
    $subscribeButton->click();

    $requiredButton =
    $driver->findElement(WebDriverBy::cssSelector('.btn_green_white_innerfade:nth-child(1) > span'));
    
    
    $requiredButton->click();
    

} 


catch (Exception $e) {
    $output .=  "General Exception";
    $output .=  "<br>";
}

catch (Exception\NoSuchElementException $e) {
    $output .=  "Element Exception";
    $output .=  "<br>";}
catch (Exception\ElementNotInteractableException $e) {
    echo "hi";
}
catch (Exception\WebDriverCurlException $e) {
    $output .=  "Curl Exception";
    $output .=  "<br>";}

} // end if

} // end for each

echo $output;
?>