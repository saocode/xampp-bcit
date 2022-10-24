<?php // Get app context from the request and include site header functions and HTML
$serverScript = $_SERVER["SCRIPT_NAME"];$appName = substr($serverScript, 1);$slashPos = stripos($appName, "/");$appName = substr($appName, 0, $slashPos);$appURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $appName;$appDir = $_SERVER["DOCUMENT_ROOT"] . "/" . $appName . "/";$include = $appDir . "/header.php";include $include;
// Page metadata, header HTML and <body> tag are automatic (in header.php)?>




<?php
$output = "";

$manager = new MongoDB\Driver\Manager();
$collection = new MongoDB\Collection($manager, "cve", "cve");
$query = new MongoDB\Driver\Query(
    array(
    '_id' => 'updateLog'
    )
);
$filter = ["_id" => "updateLog"];

echo $collection->countDocuments() . "<br>";




// get last modified date
$lastMod = $doc->last;
echo "$lastMod<br>";
    
// add last modified date to history
array_push($doc->history, $lastMod);


// set new last modified date to be current time
$time = time();
$doc->last = $time;

// finish
$updateOption = [
"last" => $time,
"history" => $doc->history
        ];


$result = $collection->updateOne(
    $filter,
    ['$set' => $updateOption],
    );


echo $output;
?>

Put HTML content here.<br>






<?php $footer = $appDir . "/footer.php";include $footer;?>
</body>
</html>