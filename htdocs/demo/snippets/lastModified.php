<?php
$reportPath = "tools";
if (!is_dir($reportPath)) $reportPath = "C:/Users/s/AppData/Local/Colossal Order/Cities_Skylines/Report/LoadingScreenMod/";

$skipFiles = array();
array_push($skipFiles, "1530376523", "2119476401", "2035770233", "769659618", "609644643", "2075728904", "2072216451", "812125426", "895061550", "1195319335", "1201045406", "1229443937");


$iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($reportPath), \RecursiveIteratorIterator::CHILD_FIRST);

$reportFiles = array();

foreach ($iterator as $filename => $file) {
	
	if ($file->isFile() && strpos($filename, "check") > 0) {
		$reportFiles[] = $filename;
	}
}

$reportFiles = array_combine($reportFiles, array_map("filemtime", $reportFiles));

arsort($reportFiles);

$lastReport = key($reportFiles);

$file = file_get_contents($lastReport);

echo "Last modified: " . $lastReport;

?>