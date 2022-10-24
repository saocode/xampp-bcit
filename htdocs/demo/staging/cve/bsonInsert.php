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
$manager = new MongoDB\Driver\Manager();
$bulk = new MongoDB\Driver\BulkWrite();

// load JSON
$cveFile = 'nvdcve-1.1-recent.json';
$cveJSON = file_get_contents($cveFile);
$cveArr = json_decode($cveJSON, true);
$cveArr = $cveArr["CVE_Items"];

// filters
// $filter = ['cve.description.description_data.value' => new MongoDB\BSON\Regex('Sonic', 'i')];
// $filter = ['cve.CVE_data_meta.ID' => "$cveId"];

foreach ($cveArr as $cve) {
    $cveId = $cve["cve"]["CVE_data_meta"]["ID"];
    $filter = ['cve.CVE_data_meta.ID' => "$cveId"];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $manager->executeQuery('cve.cve', $query);
    $mongoArr = $cursor->toArray();
    // if CVE not found add it to bulk insert
    if (empty($mongoArr)) $bulk->insert($cve);
}
// if new CVEs then insert them
if ($bulk->count() > 0) {
    $result = $manager->executeBulkWrite('cve.cve', $bulk);
    $output = $result->getInsertedCount() . " inserted<br>";
} else
    $output .= "Nothing to do.<br>";

echo "$output";

?>
<?php 
// Include site footer
$footer = $appDir . "/footer.php";
include $footer;
?>
</body>
</html>