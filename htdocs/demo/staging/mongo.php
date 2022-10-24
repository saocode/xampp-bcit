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
$logArr = getHistory();
$output = "";
$output .= $logArr[0]->last;

$manager = new MongoDB\Driver\Manager('mongodb://127.0.0.1/');
$collection = (new MongoDB\Client())->cve->cve;

// $cveFile = 'nvdcve-1.1-recent.json';
// $cveJSON = file_get_contents($cveFile);
// $cveObj = json_decode($cveJSON);
// $cveArr = json_decode($cveJSON, true);
// $cveArr = $cveArr["CVE_Items"];

// $keywordsFile = 'keywords.json';
// $keywordsJSON = file_get_contents($keywordsFile);
// $keywordsObj = json_decode($keywordsJSON);
// $keywords = $keywordsObj->Keywords;

// $cveDate = strtotime("2020-01-09");


// $result = $collection->find(array( 'publishedDate' => array (
//     '$gt' => $cveDate
// )
// ));
// $options = ['sort' => ['timestamp' => -1]];
// $cursor = $collection->find([
//     'cve.description.description_data.value' => new MongoDB\BSON\Regex('Sonic', 'i')
// ], $options);

// $mongoArr = $result->toArray();


// $filter  = [];


//$client = new MongoDB\Client('mongodb://localhost');
//$client->mydb->mycollection->find($filter, $options);



// $cursor = $collection->find([
// 'cve.CVE_data_meta.ID' => "$cveId"
// ]);

// $updateResult = $collection->updateOne(
// ['state' => 'ny'],
// ['$set' => ['country' => 'us']]
// );

/* // Find CVEs
$cves = $cveObj->CVE_Items;
$i = 0;
foreach ($cves as $key => $value) {
    $i ++;
    $cveId = $value->cve->CVE_data_meta->ID;
    $cursor = $collection->find([
        'cve.CVE_data_meta.ID' => "$cveId"
    ]);
    $output .= "<br> . $i . ";
}
 */
/*// Find and count keyword CVEs
foreach ($keywords as $kw) {

    // query keywords

    $query = [
        'cve.description.description_data.value' => new MongoDB\BSON\Regex("$kw->kw", 'i')
    ];
    $cursor = $collection->find($query);
    $mongoArr = $cursor->toArray();
    $i = 0;

    foreach ($mongoArr as $arr)
        $i ++;

    echo $i . "<br>";
} */

/*// Filters to find keyword or ID
$filter = [
    'cve.description.description_data.value' => new MongoDB\BSON\Regex('Sonic', 'i')
];
$filter = [
    'cve.CVE_data_meta.ID' => "$cveId"
]; */

$filename = 'https://media.mongodb.org/zips.json';
$lines = file($filename, FILE_IGNORE_NEW_LINES);

$bulk = new MongoDB\Driver\BulkWrite();

foreach ($lines as $line) {
    $bson = MongoDB\BSON\fromJSON($line);
    $document = MongoDB\BSON\toPHP($bson);
    $bulk->insert($document);
}

$manager = new MongoDB\Driver\Manager('mongodb://127.0.0.1/');

// $collection = (new MongoDB\Client())->test->zips;
// $collection->drop();
// $result = $manager->executeBulkWrite('test.zips', $bulk);
// printf("Inserted %d documents to test.zips <br>\r\n", $result->getInsertedCount());

// Manager Class
// $manager = new MongoDB\Driver\Manager("mongodb+srv://s:stevesteve@cluster0-x0lhs.gcp.mongodb.net/test?retryWrites=true&w=majority");
// $manager = new MongoDB\Driver\Manager();
$collection = new MongoDB\Collection($manager, "cve", "cve");

$logFilter = ["_id" => "updateLog"];
$logQuery = new MongoDB\Driver\Query($logFilter);
try {
    $logCursor = $manager->executeQuery('cve.cve', $logQuery);
    
} catch (Exception $e) {
    $output .= "DB is not available.<br><hr>";
}

//$logArr = $logCursor->toArray();
$logDoc = $logArr[0];
// $output .= print_r($logDoc);

$previous = 0;

foreach ($logDoc->history as $timestamp){
    
    //$output .= $timestamp;
//     $timestamp =  strtotime($timestamp);
//     $output .= "Timestamp: $timestamp<br>";
//     $output .= "Previous: $previous<br>";
//     $delta .= date_diff($timestamp, $previous);
//     //$delta = $delta/60/60/24;
//     $output .= "Delta: $delta days<br>";
    //$output .= " $previous<br>";
    $delta = $timestamp-$previous;
    $delta = $delta/60/60;
    if ($delta > 2) $output .= " $delta hours<br><br>";
    $previous = $timestamp;
    
}
echo $output;


// read
// Query Class
// $query = new MongoDB\Driver\Query(array('_id' => 'Andrea Le'));
// $query2 = new MongoDB\Driver\Query(array('cve.CVE_data_meta.ID' => 'CVE-2008-0001'));
// $query = new MongoDB\Driver\Query(array(
//     'cve.description.description_data.value' => array(
//         '$regex' => 'Sonic'
//     )
// ));

// $adobe = $collection->deleteMany($filter);
// find(array('cve.description.description_data.value'=> array('$regex' => 'Adobe')));
// $adobeArr = $adobe->toArray();
// echo "<br>" . $collection->countDocuments() . "<br>";
// $collection = $collection->find($query);
// echo "<br>" . $collection->countDocuments() . "<br>";

// $collection = (new MongoDB\Client())->test->users;
// $collection->drop();

// $collection->insertOne([
//     'name' => 'Bob',
//     'state' => 'ny'
// ]);
// $updateResult = $collection->replaceOne([
//     'name' => 'Bob'
// ], $cveArr[0]);

// printf("xMatched %d document(s)\n", $updateResult->getMatchedCount());
// printf("xModified %d document(s)\n", $updateResult->getModifiedCount());

// $collection->insertOne([
//     'name' => 'Bob',
//     'state' => 'ny'
// ]);
// $collection->insertOne([
//     'name' => 'Alice',
//     'state' => 'ny'
// ]);

// $updateResult = $collection->updateMany([
//     'state' => 'ny'
// ], [
//     '$set' => [
//         'country' => 'us'
//     ]
// ]);

// printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
// printf("Modified %d document(s)\n", $updateResult->getModifiedCount());

// $deleteResult = $collection->deleteMany([
//     'state' => 'ny'
// ]);
// printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());

// $collection = (new MongoDB\Client())->cve->cve;
// $deleteResult = $collection->deleteMany([
//     'cve.description.description_data.value' => new MongoDB\BSON\Regex('XXXX', 'i')
// ]);
// printf("Deleted %d document(s)\n", $deleteResult->getDeletedCount());

// $cursor = $collection->find([
//     'cve.description.description_data.value' => new MongoDB\BSON\Regex('Sonic', 'i')
// ]);

// $mongoArr = $cursor->toArray();

// $insertOneResult = $collection->insertOne(['_id' => time(), 'name' => 'Alice', "array" => ["1","2",time()]]);

// printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());

// var_dump($insertOneResult->getInsertedId());

?>

<?php



// echo $collection->countDocuments($query) . "<br>";
// $delResult = $collection->findOneAndDelete($query2);
// Output of the executeQuery will be object of MongoDB\Driver\Cursor class
// $cursor = $manager->executeQuery('sample_mflix.comments', $query);
// $cursor = $manager->executeQuery('cve.cve', $query);

// Convert cursor to Array and print result
// $mongoArr = $cursor->toArray();

// $i = 0;

// foreach ($mongoArr as $arr)
//     $i ++;

// var_dump($mongoArr);
// var_dump($mongoArr);

// echo "Keyword found " . $i . "<br>";


// $collection = new MongoDB\Collection($manager, "cve", "cve");
// $search = array();
// foreach ($cveObj->CVE_Items as $cve) {

// array_push($search, array('_id' => $cve->cve->CVE_data_meta->ID));

// }

// $results = $collection->find( 
//     array(
//         '$or' => $search   //array(
//             //array('cve.CVE_data_meta.ID' => 'CVE-2008-0001'), array('fruit' => 'Orange')
//         //) 
     
//     ) );

// $query2 = new MongoDB\Driver\Query(array('cve.CVE_data_meta.ID' => 'CVE-2008-0001'));


// $fruitArr = $results->toArray();

echo $output;
?>






<?php $footer = $appDir . "/footer.php";include $footer;?>
</body>
</html>
<?php 

/*
 * // write
 *
 * $bulk = new MongoDB\Driver\BulkWrite;
 *
 * $doc1 = ([
 *
 * 'movie_name' => 'Casggdfsfper',
 *
 * 'genre' => 'comedy',
 *
 * 'language' => 'English',
 *
 * ]);
 *
 * $doc2 = ([
 *
 * 'movie_name' => 'Eon Flux',
 *
 * 'genre' => 'action',
 *
 * 'language' => 'Korean',
 *
 * ]);
 *
 * $bulk->insert($doc1);
 *
 * $bulk->insert($doc2);
 *
 * $json = '{ "_id": { "$oid": "563143b280d2387c91807965" } }';
 * $bson = MongoDB\BSON\fromJSON($json);
 * $value = MongoDB\BSON\toPHP($bson);
 * var_dump($value);
 */

// $manager->executeBulkWrite('test.test', $bulk);

// Using PHP Library

// $collection = (new MongoDB\Client)->test->test;

// $insManyResult = $collection->insertMany([

// [

// 'movie_name' => 'Casper',

// 'genre' => 'comedy',

// 'language' => 'English',

// ],

// [

// 'movie_name' => 'Eon Flux',

// 'genre' => 'action',

// 'language' => 'Korean',

// ],

// ]);



?>