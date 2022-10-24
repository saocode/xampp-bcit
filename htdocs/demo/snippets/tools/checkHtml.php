<?php 
$include = $_SERVER["DOCUMENT_ROOT"] . "/demo/header.php";
include $include;
?>

<?php
// binary input from browser
$input = $_POST["webString"];
$encoded = htmlentities($input);


$output = "<h1>Your raw input was: ";
$output .= $input;
$output .= "<h1>Your encoded input was: ";
$output .= $encoded;
echo $output;
?>

<script>alert("Hard Coded!")</script>

<hr>
<form action="../htmlEncode.php" method="post">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Thanks!</button>
</form>
</body>
</html>