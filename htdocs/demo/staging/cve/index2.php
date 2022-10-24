<?php
// Instructions:
// Put the app in a web server directory and request the directory by HTTP
// The web server should serve http(s)://server/directory/index.php
// When the server receives the request it will parse the following values...
// $serverScript is in this format: "directory/index.php"
$serverScript = $_SERVER["SCRIPT_NAME"];
// $appName is in this format: "directory"
$appName = substr($serverScript, 1);
$slashPos = stripos($appName, "/");
$appName = substr($appName, 0, $slashPos);
// appURL is in this format: "http(s)://server/directory"
$appURL = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $appName;
// appDir is in this format: "C:/xampp/htdocs/directory"
$appDir = $_SERVER["DOCUMENT_ROOT"] . "/" . $appName . "/";
// This includes the app and HTML header data and functions
$include = $appDir . "/header.php";
include $include;
?>

<?php
$output = "";


// load JSON
$keywordsFile = 'tools/keywords.json';
$keywordsJSON = file_get_contents($keywordsFile);

// Convert JSON string to Array
// $someArray = json_decode($data, true);

// Convert JSON string to Object
$keywordsObj = json_decode($keywordsJSON);
$keywords = $keywordsObj->Keywords;

?>




<h1>CVE Feed Tool...</h1>
<form action="tools/cveTool.php" method="post">
	<input type="hidden" name="webFunction" value="download">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Get new CVE feed</button>  
</form>
<form action="tools/cveTool.php" method="post">
	<input type="hidden" name="webFunction" value="compare">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Compare new feed to DB</button>
</form>
<form action="tools/cveTool.php" method="post">
	<input type="hidden" name="webFunction" value="update">
<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Update DB</button>
</form>
<form action="tools/jsonTable.php" method="post">
	<input type="hidden" name="webFunction" value="mongoTable">
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Show new CVEs (all keywords)</button>  
</form>


<hr>
<h1>Show CVEs in DB...</h1>

<?php
$findForm = "
<form action=\"tools/mongoTable.php\" method=\"post\">
	<input type=\"hidden\" name=\"webFunction\" value=\"mongoTable\">
";
foreach ($keywords as $kw) {
    $findForm .= "<input type=\"radio\" name=\"webFind\" value=\"$kw->kw\">&nbsp $kw->kw<br>\r\n";
}
$findForm .= "<p>
    <button class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\" type=\"submit\">Show CVEs</button>
</p>
</form>";
echo $findForm;

// <form action="tools/mongoTable.php" method="post">
// <input type="hidden" name="webFunction" value="mongoTable">
// <p>
// <button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
//     type="submit">Show all keywords (Slow AF)</button>
//     </form>

?>

    
<hr>
<h1>Delete CVE keywords...</h1>

<?php
$deleteForm = "
<form action=\"tools/keywordsTool.php\" method=\"post\">
	<input type=\"hidden\" name=\"webFunction\" value=\"deleteKw\">
";
foreach ($keywords as $kw) {
    $deleteForm .= "<input type=\"checkbox\" name=\"webDelete[]\" value=\"$kw->kw\">&nbsp $kw->kw<br>\r\n";
}
$deleteForm .= "<p>
    <button class=\"w3-btn w3-white w3-border w3-border-red w3-round-large\" type=\"submit\">Delete</button>
</p>
</form>";
echo $deleteForm;


?>

<hr>
<h1>Add a CVE keyword...</h1>
<form action="tools/keywordsTool.php" method="post">
	<input type="hidden" name="webFunction" value="addKw">
	<p>
		<input type="text" name="webKeyword">
	</p>
	<p>
		<button class="w3-btn w3-white w3-border w3-border-red w3-round-large"
			type="submit">Add</button>
	</p>
</form>






</footer>
<?php $footer = $appDir . "/footer.php";include $footer;?>
</body>
</html>