<?php
$include = $_SERVER["DOCUMENT_ROOT"] . "/demo/header.php";
include $include;
?>

<p>This tool will URL encode a text string entered here:
<form action="tools/checkHtml.php" method="post">
	<p>
		<input type="text" name="webString" required> &nbsp
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>
</body>
</html>