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

$output = "";

// get mongodb
$collection = (new MongoDB\Client())->cve->cve;

// load JSON
$cveFile = 'nvdcve-1.1-recent.json';
$cveJSON = file_get_contents($cveFile);
$cveArr = json_decode($cveJSON, true);
$cveArr = $cveArr["CVE_Items"];

$i = 0;
foreach ($cveArr as $cve) {
    // get CVE from JSON
    $cveId = $cve["cve"]["CVE_data_meta"]["ID"];
    // find CVE in Mongo
    $filter = ['cve.CVE_data_meta.ID' => "$cveId"];
    $cursor = $collection->find($filter);
    $mongoArr = $cursor->toArray();
    $i ++;
    $updateResult = $collection->replaceOne($filter, $cve);
}

$output .= $i . " updated. <br>";

echo $output;
?>

<?php
// Include site footer
$footer = $appDir . "/footer.php";
include $footer;
?>
</body>
</html>