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


<!--
<script>alert("Welcome <?php echo $_POST["name"]; ?>")</script>
<script>alert("Welcome")</script>
-->

<p>Welcome <?php echo $_POST["name"]; ?>
<br>Your email address is: <?php echo $_POST["email"]; ?></p>

<h1>What Can JavaScript Do?</h1>

<p id="demo">JavaScript can change HTML content like this paragraph.</p>

<hr>
<p>
	<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="button"
		onclick="document.getElementById('demo').innerHTML = Date()">Click me
		to display Date and Time.</button>
	&nbsp

	<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="button"
		onclick='document.getElementById("demo").innerHTML = "Hello JavaScript!"'>
		Click Me!</button>
	&nbsp

	<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="button"
		onclick='document.getElementById("demo").innerHTML = "<?php echo $_POST["email"]; ?>"'>
		Does this work?</button>

	<br><br>
	<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="button"
		onclick='alert("hi")'>
		Alert</button>
		
		&nbsp
	<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
		type="button"
		onclick="window.location.href = ('https://www.google.com')">
		Go to Google</button>

	</body>

	</body>
	</html>
	
	<?php include $footerFile; ?>