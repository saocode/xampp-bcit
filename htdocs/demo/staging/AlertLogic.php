<?php
namespace Facebook\WebDriver;
require_once('vendor/autoload.php');
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Chrome\ChromeDriver;

$output = "";

$link = "https://console.alertlogic.net/embedded/ajax_handler.php?cat=get_exposure_manage_scans&customer_id=134247939";

// This is where Selenium server 2/3 listens by default. For Selenium 4, Chromedriver or Geckodriver, use http://localhost:4444/
$host = 'http://localhost:4444';
$capabilities = DesiredCapabilities::chrome();
//$capabilities->setCapability("chromeOptions","user-data-dir=/path/to/your/custom/profile");
$options = new ChromeOptions();
$options->addArguments(["start-maximized"]);
$options->addArguments(["start-maximized"]);
$options->addArguments(["user-data-dir=c:/Dev/chrome"]);

try{
    $driver = RemoteWebDriver::create($host, $capabilities);
}

catch (Exception\InvalidArgumentException $e){
    $output .=  "Selenium Browser profile is open.";
    $output .=  "<br>";
    
}


$driver->get($link);
$driver->

$pageSource = $driver->getPageSource();

// TESTING

$myfile2 = fopen("alertLogic2.htm", "r") or die("Unable to open file!");
file_put_contents("alertLogic.htm", $pageSource);
$myfile = fopen("alertLogic.htm", "r") or die("Unable to open file!");
// END TESTING

$policyArr = array();
// change buffer to source after testing


// https://console.alertlogic.net/reports/pdf/scan_details.php?policy_id=27360&policy_log_id=111223&fast_scan=

// https://console.alertlogic.net/reports/pdf/scan_details.php?policy_id=27359&policy_log_id=111221&fast_scan=

// https://console.alertlogic.net/embedded/ajax_handler.php?cat=get_scan_policy_log_results&policy_id=27360

// https://console.alertlogic.net/reports/pci_scan_results.php?oid=132949


// https://console.alertlogic.net/embedded/ajax_handler.php?cat=get_exposure_manage_scans


    //get policy_ids



while (($buffer = fgets($myfile)) !== false) {
    preg_match('/policy_id=\d*/', $buffer, $output_array);
    if (count($output_array) > 0){
        $number = substr($output_array[0], 10); 
        if($number > 34648) $larger = true; else $larger = false;
        if ($larger)
        array_push($policyArr, $output_array[0]);
        // save largest number for next time
    }
}

    // policy_ids are here: https://console.alertlogic.net/embedded/ajax_handler.php?cat=get_exposure_manage_scans&customer_id=134247939
    
    foreach ($policyArr as $policy){
        //get scan results
        $link = "https://console.alertlogic.net/embedded/ajax_handler.php?cat=get_scan_results&" . $policy;
        $driver->get($link);
        
        $pageSource = $driver->getPageSource();
        file_put_contents("alertLogic2.htm", $pageSource);
        $myfile2 = fopen("alertLogic2.htm", "r") or die("Unable to open file!");
        // $driver->get($link);

        
        //get policy_log_id
        while (($buffer = fgets($myfile2)) !== false) {
            preg_match('/policy_log_id=\d*/', $buffer, $output_array);
            if (count($output_array) > 0){
                $policyLogID = $output_array[0];
            $link = "https://console.alertlogic.net/reports/pdf/scan_details.php?" . $policy . "&" . $policyLogID . "&fast_scan=";
            $driver->get($link);
            
            }
            }
        
        
        // get pdf
        // pdfs are here:
        // https://console.alertlogic.net/reports/pdf/scan_details.php?policy_id=27360&policy_log_id=111223&fast_scan=
        
        }


echo $output;


?>