<?php 

$reportPath = "C:/Users/tv/AppData/Local/Colossal Order/Cities_Skylines/Report/LoadingScreenMod/";

$assetPath = "C:/Program Files (x86)/Steam/steamapps/workshop/content/255710/";

$assetDir = dir($assetPath);

$lastReport = "collection.html";

$file = file_get_contents($lastReport);

$assets = scandir($assetPath);

$start = strpos($file, "Items in this collection");

$string = substr($file, $start+8);

preg_match_all('#\bhttps?://steamcommunity.com/sharedfiles/filedetails[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $string, $match);

$urlSet = array();

foreach ($match[0] as $url){
    if (!in_array($url, $urlSet)){
        array_push($urlSet, $url);
    }
}

echo "<pre>";
print_r($urlSet);
echo "</pre>";

$ids = array();

foreach ($urlSet as $url) {
    $start = strpos($url, "id=");
    
    $url = substr($url, $start+3);
    array_push($ids, $url);
    if (!in_array($url, $assets)){
        echo $url."<br>";
    }
}

foreach ($assets as $asset) {

    if (!in_array($asset, $ids)){
        echo $asset."<br>";
    }
}

?>