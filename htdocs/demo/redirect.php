<?php
$title = "Open Redirect";
$description = "This tool demonstrates the danger of open redirects.";
include "headerScript.php";
?>

<div class="w3-row">
  <div class="w3-container w3-cell">
    <div class="w3-card w3-padding w3-margin-top w3-margin-bottom">
   <p>Where do you want to send your victim?

<form action="tools/redirectTool.php" method="post">
	<p>
		http://&nbsp<input type="text" name="dest" required>&nbsp
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Go</button>

</form>

</li>
</ul>

<?php
$output = "";

echo $output;
?>





<?php include $footerFile; ?>



