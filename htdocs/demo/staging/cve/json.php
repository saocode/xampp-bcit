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
$nist = file_get_contents('https://nvd.nist.gov/feeds/json/cve/1.1/nvdcve-1.1-recent.json.zip');

// copy zip to local storage
$localZip = fopen('nist.zip', 'w');
fwrite($localZip, $nist);
$zip = new ZipArchive();
// if ($zip->open('nist.zip')) $json = $zip->getStream('nvdcve-1.1-recent.json');
// echo $json;

// unzip JSON
$zip->open('nist.zip');
$zip->extractTo('./', array(
    'nvdcve-1.1-recent.json'
));
$zip->close();

// load JSON
$cveFile = 'nvdcve-1.1-recent.json';
$cveJSON = file_get_contents($cveFile);
$keywordsFile = 'keywords.json';
$keywordsJSON = file_get_contents($keywordsFile);

// Convert JSON string to Array
// $someArray = json_decode($data, true);
// print_r($someArray); // Dump all data of the Array
// echo $someArray[0]["name"]; // Access Array data

// Convert JSON string to Object
$cveObj = json_decode($cveJSON);
$keywordsObj = json_decode($keywordsJSON);
// print_r($someObject); // Dump all data of the Object
// echo $someObject->CVE_data_format; // Access Object data

$cves = $cveObj->CVE_Items;
$keywords = $keywordsObj->Keywords;
$output = "";

// search for each keyword...
foreach ($keywords as $kw) {
    $output .= "<hr><h1>$kw->kw CVEs</h1>";
    foreach ($cves as $key => $value) {
        $cve = $value;
        $cveDesc = $cve->cve->description->description_data;
        $cveProb = $cve->cve->problemtype->problemtype_data;
        $cveId = $cve->cve->CVE_data_meta->ID;
        $cveMod = $cve->lastModifiedDate;

        // ... in each CVE
        $haystack = $cveDesc[0]->value;
        $needle = $kw->kw;

        $match = mb_stristr($haystack, $needle); // this function doesn't return a true
        if (! $match) { // so negate it and do nothing when it is false
                          // $output .= "Did not find \"$needle\" in CVE $key<br>\r\n";
        } else { // and when it isn't false do something because there is a match
            $output .= "<hr>\r\n";
            $output .= "<h2>Found \"$needle\" in Item #$key</h2>\r\n";
            $output .= "$haystack<br><br>\r\n";
            $output .= "Modified: $cveMod<br>\r\n";

            if (isset($cveProb[0]->description[0])) {
                $CWE = $cveProb[0]->description[0]->value;
                $CWEnum = mb_stristr($CWE, "-", false);
                $CWEnum = mb_strcut($CWEnum, 1);
                // $output .= "$CWEnum <br>";

                $output .= "<p><a href=\"https://nvd.nist.gov/vuln/detail/$cveId\" target=\"_blank\">Vulnerability: $cveId</a>";
                $output .= "<p><a href=\"https://cwe.mitre.org/data/definitions/$CWEnum.html\" target=\"_blank\">Weakness: $CWE</a>";

                $output .= "<br><br>";
            }
        }
    }
}

// Loop through Array
// foreach ($someArray as $key => $value) {
// echo $value . "<br>";
// }
// }

/*
 * Get file from URL and use as variable
 * $nist = file_get_contents('https://nvd.nist.gov/feeds/json/cve/1.1/nvdcve-1.1-2019.json.zip');
 * $zip = new ZipArchive();
 * if ($zip->open('nist.zip')) {
 * $fp = $zip->getStream('nvdcve-1.1-2019.json'); //file inside archive
 * if(!$fp)
 * die("Error: can't get stream to zipped file");
 * $stat = $zip->statName('myfile.txt');
 *
 * $buf = ""; //file buffer
 * ob_start(); //to capture CRC error message
 * while (!feof($fp)) {
 * $buf .= fread($fp, 2048); //reading more than 2156 bytes seems to disable internal CRC32 verification (bug?)
 * }
 * $s = ob_get_contents();
 * ob_end_clean();
 * if(stripos($s, "CRC error") != FALSE){
 * echo 'CRC32 mismatch, current ';
 * printf("%08X", crc32($buf)); //current CRC
 * echo ', expected ';
 * printf("%08X", $stat['crc']); //expected CRC
 * }
 *
 * fclose($fp);
 * $zip->close();
 * //Done, unpacked file is stored in $buf
 * echo $buf;
 * }
 */
?>
 

<?php
echo $output;
?>

<?php $footer = $appDir . "/footer.php";include $footer;?>
</body>
</html>