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
// Page metadata, header HTML and <body> tag are automatic (in header.php) ?>

<?php
$feed = "2007";

// get data feed
$recentCveZip = file_get_contents("https://nvd.nist.gov/feeds/json/cve/1.1/nvdcve-1.1-$feed.json.zip");


// copy zip to local storage
$localZip = fopen('nist.zip', 'w');
fwrite($localZip, $recentCveZip);
$zip = new ZipArchive();
// if ($zip->open('nist.zip')) $json = $zip->getStream('nvdcve-1.1-recent.json');
// echo $json;

// unzip JSON
$zip->open('nist.zip');
$zip->extractTo('./', array(
    "nvdcve-1.1-$feed.json"
));
$zip->close();

// load JSON
$recentCveFile = "nvdcve-1.1-$feed.json";
$cveLibraryFile = 'cveLibrary.json';
$recentCveJSON = file_get_contents($recentCveFile);
$cveLibraryJSON = file_get_contents($cveLibraryFile);

// Convert JSON string to Array
// $someArray = json_decode($data, true);
// print_r($someArray); // Dump all data of the Array
// echo $someArray[0]["name"]; // Access Array data

// Convert JSON string to Object
$RecentCveObj = json_decode($recentCveJSON);
$cveLibraryObj = json_decode($cveLibraryJSON);

// print_r($someObject); // Dump all data of the Object
// echo $someObject->CVE_data_format; // Access Object data

$new = $RecentCveObj->CVE_Items;
$old = $cveLibraryObj->CVE_Items;
$output = null;

// search for each keyword...

if (is_array($new) & is_array($old)){
foreach ($new as $newCVE) {
    array_push($old, $newCVE);    
}
}
$cveLibraryObj->CVE_Items = $old;
$updatedCveJSON = json_encode($cveLibraryObj);
file_put_contents($cveLibraryFile, $updatedCveJSON);
    ?>
 

<?php
echo $output;
?>

<?php $footer = $appDir . "/footer.php";include $footer;?>
</body>
</html>