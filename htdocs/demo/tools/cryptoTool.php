<?php include "headerScript.php";?>
<?php

// This is needed to suppress "no IV" errors with AES
function errorBlink($errno, $errstr, $errfile, $errline)
{
    return header("Location: ../error.php");
}
$referer = $_SERVER["HTTP_REFERER"];

//
$function = $_POST["webFunction"];
$output = null;
switch ($function) {

    case "aes":
        $action = $_POST["webAction"];
        $string = $_POST["webText"];

        // convert key input to 256 bits (32 bytes)
        $key = hash('sha256', $_POST["webKey"], 1);
        // convert IV input to 16 bytes
        if ($_POST["webIV"] == "") {
            $iv = "";
            $ivText = $iv;
        } else {
            $iv = $_POST["webIV"];
            $ivText = $iv;
            $iv = getIV($iv);
        }

        if ($action == 'encrypt') {
            $plainText = $string;
            $cipherText = encrypt_decrypt('encrypt', $plainText, $key, $iv);

            // Show plaintext
            $output .= "<h1>Plaintext</h1>\r\n";
            // Show plaintext in UTF-8
            $output .= "<h2>String:</h2>\r\n";
            $output .= htmlCodeStart() . $plainText . htmlCodeEnd();
            // Show plaintext in base 64
            $output .= "<h2>Base64:</h2>\r\n";
            $output .= htmlCodeStart() . base64_encode($plainText) . htmlCodeEnd();

            // Show plaintext as byte array
            // put bytes into array
            $output .= "<h2>Bytes:</h2>\r\n";
            $plainHex = bin2hex($plainText);
            $byteArray = array();
            for ($i = 0; $i < strlen($plainHex) / 2; $i ++) {
                array_push($byteArray, substr($plainHex, $i * 2, 2));
            }
            // put bytes into string
            $byteString = "";
            for ($i = 0; $i < strlen($plainHex) / 2; $i ++) {
                $byteString .= substr($plainHex, $i * 2, 2) . " ";
            }
            $output .= htmlCodeStart() . $byteString . htmlCodeEnd();

            $output .= "<h1>Ciphertext</h1>";
            $output .= "<h2>Base64:</h2>\r\n";
            $output .= htmlCodeStart() . base64_encode($cipherText) . htmlCodeEnd();
            $output .= "<h2>String:</h2>\r\n";
            $output .= htmlCodeStart() . $cipherText . htmlCodeEnd();
            $output .= "<h2>Bytes:</h2>\r\n";
            $cipherHex = bin2hex($cipherText);
            $byteArray = array();
            for ($i = 0; $i < strlen($cipherHex) / 2; $i ++) {
                array_push($byteArray, substr($cipherHex, $i * 2, 2));
            }
            // put bytes into string
            $byteString = "";
            for ($i = 0; $i < strlen($cipherHex) / 2; $i ++) {
                $byteString .= substr($cipherHex, $i * 2, 2) . " ";
            }
            $output .= htmlCodeStart() . $byteString . htmlCodeEnd();
            // Show key as bytes
            $output .= "<h1>Key</h1>";
            $output .= "<h2>Bytes:</h2>\r\n";
            $output .= htmlCodeStart() . bin2hex($key) . htmlCodeEnd();
            // Show IV as bytes
            $output .= "<h1>IV</h1>";
            $output .= "<h2>Bytes:</h2>\r\n";
            $output .= htmlCodeStart() . bin2hex($iv) . htmlCodeEnd();
            setcookie(lastCiphertext, base64_encode($cipherText), time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie(lastPlaintext, $plainText, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie(lastIV, $ivText, time() + (86400 * 30), "/"); // 86400 = 1 day
        } else if ($action == 'decrypt') {
            $cipherText = $string;
            $output .= "<h1>Ciphertext:</h1>\r\n";
            $output .= htmlCodeStart() . $cipherText . htmlCodeEnd();
            $plainText = encrypt_decrypt('decrypt', $cipherText, $key, $iv);
            $output .= "<h1>Plaintext:</h1>\r\n";
            $output .= htmlCodeStart() . $plainText . htmlCodeEnd();
            setcookie($lastCiphertext, $cipherText, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie($lastPlaintext, $plainText, time() + (86400 * 30), "/"); // 86400 = 1 day
        }

        break;

    case "pbkdf2":
        $string = $_POST["webPassword"];
        $length = $_POST["webLength"];
        $iterations = $_POST["webIterations"];
        $output .= deriveKey($string, $length, $iterations);
        break;

    case "hash":
        // set_error_handler("errorBlink");
        // set_error_handler("noErrors");
        $string = $_POST["webText"];
        $salt = $_POST["webSalt"];
        $message = $string . $salt;
        $algo = $_POST["webAlgo"];
        $digest = hash($algo, $message);
        setcookie("lastMessage", $string, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("lastSalt", $salt, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("lastAlgo", $algo, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("lastDigest", $digest, time() + (86400 * 30), "/"); // 86400 = 1 day

        $output .= $digest;

        break;
    
    default:
        echo $_POST["webFunction"];
}
echo $output;
?>

<?php

// Encrypt and decrypt with AES-256-CBC
/**
 * simple method to encrypt or decrypt a plain text string
 * initialization vector(IV) has to be the same when encrypting and decrypting
 *
 * @param string $action:
 *            can be 'encrypt' or 'decrypt'
 * @param string $string:
 *            string to encrypt or decrypt
 *            
 * @return string
 */

// IV must be 16 bytes for AES-256-CBC
function getIV($string)
{
    // if ($string == "") return random_bytes("16");
    // else
    $hash = hash('sha256', $string, 1);
    return substr($hash, 16);
    // return $hash;
}

function encrypt_decrypt($action, $string, $key, $iv)
{
    set_error_handler("noErrors");
    $output = false;
    $encrypt_method = "AES-256-CBC";

    if ($action == 'encrypt') {

        // returns raw output
        $output = openssl_encrypt($string, $encrypt_method, $key, 1, $iv);

        return $output;
    } else if ($action == 'decrypt') {
        // $binString = hex2bin($string);
        $output = openssl_decrypt($string, $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
?>


<?php

// Derive a key using PBKDF2
/**
 * simple method to derive a key from a password.
 * more text here
 *
 * @param string $string:
 *            string to convert to fixed-length key
 * @param string $length:
 *            how long the key should be (i.e. for AES-128 vs. RSA-2048)
 * @param string $iterations:
 *            the number of iterations (https://en.wikipedia.org/wiki/Key_stretching#Strength_and_time)
 *            
 * @return string
 */
function deriveKey($string, $length, $iterations)
{
    $output = false;
    $startTime = time();
    $output = "<p>Start time: " . $startTime . "<br>\r\n";
    $algo = "sha256";
    $salt = "123";
    $output .= "<p>";
    $output .= hash_pbkdf2($algo, $string, $salt, $iterations, $length) . "<br>\r\n";
    $endTime = time();
    $elapsed = $endTime - $startTime;
    $output .= "<p>End time: " . $endTime . "<br>\r\n";
    $output .= "<p>Key generation took " . $elapsed . " seconds.";
    return $output;
}
?>


<hr>
<form action="<?php echo $referer;?>" method="post">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Thanks!</button>

</form>
<?php include $footerFile; ?>