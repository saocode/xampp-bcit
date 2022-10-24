<?php
//$title = "PRNG";
//$description = "This is a PRNG.";
include "headerScript.php";?>
<div class="w3-card w3-center w3-container w3-hover-shadow w3-margin w3-padding-top">
<div class="w3-center">

<?php
$output = "";
//Put scripts here.
echo $output;
?>

Put HTML content here.<br>

</div>
</div>


<form action="tools/checkWelcome.php" method="post">
	<p>
		Name:&nbsp <input type="text" name="name">
	</p>
	<p>
		E-mail:&nbsp <input type="text" name="email">
	</p>
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Login</button>
	</p>
</form>

</body>
</html>

<?php include $footerFile; ?>