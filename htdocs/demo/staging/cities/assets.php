<?php 

$reportPath = "C:/Users/tv/AppData/Local/Colossal Order/Cities_Skylines/Report/LoadingScreenMod/";
if (!is_dir($reportPath)) $reportPath = "C:/Users/s/AppData/Local/Colossal Order/Cities_Skylines/Report/LoadingScreenMod/";

$assetPath = "C:/Program Files (x86)/Steam/steamapps/workshop/content/255710/";
$skipFiles = array();
array_push($skipFiles, "1530376523", "2119476401", "2035770233", "769659618", "609644643", "2075728904", "2072216451", "812125426", "895061550", "1195319335", "1201045406", "1229443937"); 


$assetDir = dir($assetPath);

$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($reportPath), \RecursiveIteratorIterator::CHILD_FIRST);

$reportFiles = array();

foreach ($iterator as $filename => $file) {
    
    if ($file->isFile() && strpos($filename, "Assets Browser") > 0) {
        $reportFiles[] = $filename;
    }
}

$reportFiles = array_combine($reportFiles, array_map("filemtime", $reportFiles));

arsort($reportFiles);

$lastReport = key($reportFiles);

$file = file_get_contents($lastReport);

//file_get_contents("assets.html");
$assets = scandir($assetPath);


$start = strpos($file, "const d=");

echo $start;

$arrayText = substr($file, $start+8);

$start = strpos($arrayText, "$(ini)");



$arrayText = substr($arrayText, 0, $start);

$array = json_decode($arrayText);

foreach ($array as $item) {
    $assNum = $item[6];
    $assName = trim($item[7]);
    $assName = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $assName);
    
//    foreach ($item as $value) {
    if(!$assNum=="0"){
        
    
        if(in_array($item[6], $assets) && !in_array($item[6], $skipFiles)){
        echo $item[6]."<br>";
        echo $item[7]."<br>";
        rename($assetPath.$assNum, $assetPath.$assNum." - ".$assName);
    }
        }
    //}
}

?>