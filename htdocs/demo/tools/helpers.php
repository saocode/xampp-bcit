<?php
// Helper Functions

// HTML Functions

/**
 * Insert "w3-code" open div tag into HTML.
 *
 * @return <div> tag and CSS class string
 */
function htmlCodeStart(){
    $output = "<div class=\"w3-code\">";
    return $output;
}

/**
 * Insert close div tag into HTML.
 *
 * @return </div> tag 
 */
function htmlCodeEnd(){
    $output = "</div>\r\n";
    return $output;
}

// Data Functions

/**
 * Convert a hex input into an array of bytes.
 * @param string $hexInput: bytestream to convert.
 *
 * @return array of bytes
 */
function byteArray($hexInput){
    $byteArray = array();
    for ($i = 0; $i < strlen($hexInput) / 2; $i ++) {
        array_push($byteArray, substr($hexInput, $i * 2, 2));
        // echo substr($hex, $i * 2, 2) . " ";
    }
    return $byteArray;
}

/**
 * Convert a hex input into a string showing the input bytes seperated by spaces.
 * @param string $hexInput: string to convert.
 *
 * @return string of bytes
 */
function byteString($hexInput){
    // put bytes into string
    $byteString = "";
    for ($i = 0; $i < strlen($hexInput) / 2; $i ++) {
        $byteString .= substr($hexInput, $i * 2, 2);
        $byteString .= " ";
    }
    $byteString = rtrim($byteString, "%");
    return $byteString;
}


// Input Validation Functions

/**
 * Check if input is numeric.
 * @param string $input: string to check
 *
 * @return boolean
 */
function isNumber($input){
    if (!is_numeric($input)) header("Location: ../error.php");
}

/**
 * Count bytes in array of bytes.
 *
 * @param array $array: byte array to count.
 *
 * @return TRUE if byte array is > 1 bytes long else return FALSE.
 */
function isMulti($array)
{
    if (count($array) > 1)
        return true;
        else
            return false;
}

/**
 * Check if HTTP method was POST.
 * @param none: include in a php webpage to see if it was requested by POST. 
 *
 * @return boolean
 */
function isPost(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    return true;// the request method is fine
    } else {
    // redirect to error page
    header("Location: ../hacked.php");
    }
}

/**
 * Check if input is empty and redirect to error page.
 * @param string $input: string to check
 *
 */
function isEmpty($input)
{
    if (empty($input))
        header("Location: ../error.php");
}

/**
 * Confirm if multibyte input is the expected length.
 * @param string $input: string to check
 * @param integer $len: expected length of the string 
 *
 * @return boolean
 */
function howLong($input, $len) {
    if (mb_strlen($input) == $len) return true; 
    else return false; 
}

function getHistory() {
    $output = "";
    $manager = new MongoDB\Driver\Manager();
    $collection = new MongoDB\Collection($manager, "cve", "cve");    
    $logFilter = ["_id" => "updateLog"];
    $logQuery = new MongoDB\Driver\Query($logFilter);
    try {
        $logCursor = $manager->executeQuery('cve.cve', $logQuery);        
    } catch (Exception $e) {
        $output .= "DB is not available.<br><hr>"; 
        return false;
    }

    $logArr = $logCursor->toArray();
    
    if (empty($logArr)) {
        
        
        
        //echo "Empty!";
        
        
        
        $insertOneResult = $collection->insertOne([
            '_id' => 'updateLog',
            'history' => ['1'],
            'last' => '1',
        ]);
        
        //printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
        
        //var_dump($insertOneResult->getInsertedId());
        $logFilter = ["_id" => "updateLog"];
        $logQuery = new MongoDB\Driver\Query($logFilter);
        try {
            $logCursor = $manager->executeQuery('cve.cve', $logQuery);
            
        } catch (Exception $e) {
            $output .= "DB is not available.<br><hr>";
            return false;

        }
        $countCVEs = $collection->countDocuments();
        $logArr = $logCursor->toArray();
    }
    return $logArr;
}

function validate(){
    if (isPost()) return true; else return false;
}

function noErrors($errno, $errstr, $errfile, $errline) {
}

function checkboxBlank(string $string)
{
    return "<label class=\"w3-display-container\"><input class=\"padding-bottom:1px\" name=\"webDelete[]\" value=\"$string\" type=\"checkbox\"><span></span></label>\r\n";
}

?>