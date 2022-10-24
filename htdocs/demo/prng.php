<?php 
$title = "PRNG";
$description = "This is a PRNG.";
include "headerScript.php";?>
<div class="w3-card w3-center w3-container w3-hover-shadow w3-margin w3-padding-top">
<div class="w3-center">


<ul
	class="w3-ul w3-center w3-margin-top" >
	
	<li class="w3-black w3-xlarge w3-padding-32">PRNGs</li>

<?php
echo "<li>";
echo "PHP rand() = " . rand();
echo "<li>";
echo "PHP mt_rand() = " . mt_rand();
echo "<li>";
echo "cUrl www.random.org = ";
$ch = curl_init("https://www.random.org/integers/?num=1&min=0&max=1000000&col=1&base=10&format=plain&rnd=new"); // such as http://example.com/example.xml
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
?>
</div>

<?php include $footerFile; ?>