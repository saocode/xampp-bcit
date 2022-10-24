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
// get data feed
// $nist = file_get_contents('https://nvd.nist.gov/feeds/json/cve/1.1/nvdcve-1.1-recent.json.zip');

// load JSON
$cveFile = 'nvdcve-1.1-2005.json';
$cveJSON = file_get_contents($cveFile);

// Convert JSON string to Array
// $someArray = json_decode($data, true);
// print_r($someArray); // Dump all data of the Array
// echo $someArray[0]["name"]; // Access Array data

// Convert JSON string to Object
$cveArr = json_decode($cveJSON, true);
$cveArr = $cveArr["CVE_Items"];
// print_r($cveObj); // Dump all data of the Object
// echo $someObject->CVE_data_format; // Access Object data


$output = "";
$bulk = new MongoDB\Driver\BulkWrite;

foreach ($cveArr as $key => $value) {
    $cve = $value;
    //$singleCveJSON = json_encode($value);

   // $bson = MongoDB\BSON\fromJSON($singleCveJSON);
   // $value = MongoDB\BSON\toPHP($bson);

    // $json = '{ "_id": { "$oid": "563143b280d2387c91807965" } }';

    // var_dump($value);
    $doc1 = $cve;
    
    // ([
    
    //     'movie_name' => 'Cavncbmbcmsper',
    
    //     'genre' => 'comedy',
    
    //     'language' => 'English',
    
    // ]);
    
    $manager = new MongoDB\Driver\Manager("mongodb+srv://s:stevesteve@cluster0-x0lhs.gcp.mongodb.net/test?retryWrites=true&w=majority");
    $bulk->insert($doc1);

}

//$result = $manager->executeBulkWrite('cve.cve', $bulk);
$output .= $result->getInsertedCount();


?>
 

<?php
echo $output;
?>

<?php $footer = $appDir . "/footer.php";include $footer;?>
</body>
</html>