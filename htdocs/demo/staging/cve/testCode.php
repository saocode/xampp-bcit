<?php

// filters
// $filter = ['cve.description.description_data.value' => new MongoDB\BSON\Regex('Sonic', 'i')];
// $filter = ['cve.CVE_data_meta.ID' => "$cveId"];

/*
 * // bulk search
 * $search = array();
 * foreach ($cveObj->CVE_Items as $cve) {
 *
 * array_push($search, array('_id' => $cve->cve->CVE_data_meta->ID));
 *
 * }
 *
 * $results = $collection->find(
 * array(
 * '$or' => $search //array(
 * //array('cve.CVE_data_meta.ID' => 'CVE-2008-0001'), array('fruit' => 'Orange')
 * //)
 *
 * ) );
 *
 * // $query2 = new MongoDB\Driver\Query(array('cve.CVE_data_meta.ID' => 'CVE-2008-0001'));
 *
 *
 * $fruitArr = $results->toArray();
 */




// $query = new MongoDB\Driver\Query($filter);
// $cursor = $manager->executeQuery('cve.cve', $query);
// $mongoArr = $cursor->toArray();
// if CVE not found add it to bulk insert
// if (empty($mongoArr)) {
// $bulk->insert($cve);
// $time = $cve["publishedDate"];

// }




// if ($zip->open('nist.zip')) $json = $zip->getStream('nvdcve-1.1-recent.json');
// echo $json;


