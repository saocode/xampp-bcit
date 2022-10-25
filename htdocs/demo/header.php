<?php
// Instructions:
// Put the app in a web server directory and request the directory by HTTP
// The web server should serve http(s)://server/directory/index.php
// When the server receives the request it will parse the following values...
// $serverScript is in this format: "directory/index.php"
$include = "tools/helpers.php";
$noTitle = "";
$marginTop = "style=\"margin-top: 22px\"";
if (! isset($title)) {
    $noTitle = "w3-hide";
    $marginTop = "style=\"margin-top: 30.5px\"";
    $title = "Title";
}
if (! isset($description))
    $description = "Description goes here.";
include $include;
require __DIR__ . '/vendor/autoload.php';

// Echo dynamic menu items
function dynamicMenu($menuArray, $directory, $rootURL)
{
    foreach ($menuArray as $value) {
        $isDot = false;
        $isDir = false;
        if (ord($value) == 46)
            $isDot = true;
        $dir = $directory . "\\" . $value;
        $isDir = is_dir($dir);
        $isName = false;
        if ($value == "_template.php")
            $isName = true;
        if ($value == "header.php")
            $isName = true;
        if ($value == "headerScript.php")
            $isName = true;
        if ($value == "footer.php")
            $isName = true;
        if ($value == "index.php")
            $isName = true;
        if ($value == "composer.json")
            $isName = true;
        if ($value == "composer.lock")
            $isName = true;
        if ($value == "composer.phar")
            $isName = true;
        if ($value == "cookiePanel.php")
            $isName = true;
        if ($value == "cookieTable.php")
            $isName = true;

        if ($value == "favicon.ico")
            $isName = true;
        if ($value == "dakar.jpg")
            $isName = true;
        if ($value == "finn.jpg")
            $isName = true;
		if ($value == "hacker.jpg")
            $isName = true;
        $info = pathinfo($value);
        if (isset($info["extension"])) {
            if ($info["extension"] == "json")
                $isName = true;
            if ($info["extension"] == "zip")
                $isName = true;
        }
        $suppress = $isDot || $isDir || $isName;
        if (! $suppress)
            echo "
            <a href=\"" . $rootURL . $value . "\" class=\"w3-bar-item w3-button\">" . $value . "</a>\r\n";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Steve's Demo Site</title>
<meta
	charset="UTF-8"
	name="viewport"
	content="width=device-width, initial-scale=1">
<link
	rel="stylesheet"
	type="text/css"
	href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script
	type="text/javascript"
	src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<link
	rel="stylesheet"
	href="<?php echo $rootURL?>css/w3.css">
<link
	rel="stylesheet"
	href="<?php echo $rootURL?>/css/w3-theme-black.css">
<link
	rel="stylesheet"
	href="<?php echo $rootURL?>css/steve.css">
<link
	rel="stylesheet"
	href="<?php echo $rootURL?>css/all.css">
<link
	rel="stylesheet"
	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body id="body">
	<script>function smallMenu() {
         var x = document.getElementById("navDemo");
         if (x.className.indexOf("w3-show") == -1) {
         	x.className += " w3-show";
         } else { 
         	x.className = x.className.replace(" w3-show", "");
         }
        }
	</script>

	<!-- Navbar -->
	<div class="w3-top">
		<div class="w3-bar w3-black w3-card">
		 <a
				href="#"
				class="w3-border-right w3-bar-item w3-button w3-padding-small"><b>MENU</a>
			<a
				href="#"
				class="w3-border-right w3-bar-item w3-button w3-padding-small">TOP</a>
			<a
				href="#footer"
				class="w3-border-right w3-bar-item w3-button w3-padding-small">BOTTOM</a>
			<div class="w3-border-right w3-dropdown-hover">
				<button
					class="w3-button w3-padding-small"
					title="Demo">
					DEMO <i class="fa fa-caret-down"></i>
				</button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
				
<?php
// Demo dir drop down
$directory = __DIR__;
$menuArray = array();
if (is_dir($directory)) {
    if ($handle = opendir($directory)) {
        while (($file = readdir($handle)) !== FALSE) {
            $menuArray[] = $file;
        }
        closedir($handle);
    }
}



dynamicMenu($menuArray, $directory, $rootURL);
// End demo dir drop down
?>
 
			 </div>
			</div>

			<div class="w3-border-right w3-dropdown-hover">
				<button
					class="w3-button  w3-padding-small"
					title="Damn Vulnerable Web App">
					DAMN VULNERABLE WEB APP <i class="fa fa-caret-down"></i>
				</button>
				<div class="w3-dropdown-content w3-bar-block w3-card-4">
 
<?php


echo "<a href=\"" . $domainURL . "dvwa\" target=\"_blank\" class=\"w3-bar-item w3-button\">DVWA User Interface</a>\r\n";
echo "<a href=\"" . $domainURL . "phpmyadmin\index.php?lang=en\" target=\"_blank\" class=\"w3-bar-item w3-button\">DVWA Database Administrator Interface</a>\r\n";




// End staging dir drop down
?>
 
 
 
 				</div>
			</div>

			<a
				href="javascript:void(0)"
				class="w3-border-left w3-padding-small w3-hover-red w3-right"><i
				class="fa fa-search"></i></a>
		</div>
	</div>

	<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
	

	<div <?=$marginTop?>></div>
	<!-- Page Header -->

	<div
		style="animation-duration: 1.5s;"
		class="w3-card w3-theme w3-center w3-animate-zoom <?=$noTitle?>"
		id="myHeader">

		<div class="w3-card w3-xlarge"><?=$title?></div>
		<div class="w3-card"><?php echo $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];?></div>
		<div class="w3-card w3-padding-small"><?=$description?></div>

	</div>


	<!-- End of Page Header -->