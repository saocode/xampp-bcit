<?php
$title = "Cookies";
$description = "Cookies are name-value-pair data object stored in your browser.
			This tools lets you set and delete cookies.";
include "headerScript.php";
?>

<div class="w3-row w3-center">

	<div class="w3-third w3-container">
		<div
			class="w3-card w3-padding w3-margin-top w3-margin-bottom w3-hover-shadow">
			<h2>Set Cookies with HTTP POST</h2>
			<br> <i class="fas fa-cookie w3-margin-bottom w3-text-theme"
				style="font-size: 60px"></i> <i
				class="fas fa-angle-right w3-margin-bottom w3-margin-left w3-text-theme"
				style="font-size: 60px"></i> <i
				class="fas fa-server w3-margin-bottom w3-margin-left w3-text-theme"
				style="font-size: 60px"></i>

  <?php
		include "tools\setCookieForm.php";
		?>    </div>
	</div>

	<div class="w3-third w3-container">
		<div
			class="w3-card w3-padding w3-margin-top w3-margin-bottom w3-hover-shadow">
			<h2>Delete Cookies with HTTP POST</h2>
			<br> <i class="fas fa-cookie-bite w3-margin-bottom w3-text-theme"
				style="font-size: 60px"></i> <i
				class="fas fa-angle-right w3-margin-bottom w3-margin-left w3-text-theme"
				style="font-size: 60px"></i> <i
				class="fas fa-server w3-margin-bottom w3-margin-left w3-text-theme"
				style="font-size: 60px"></i>
  
   <?php
			include "tools\deleteCookieForm.php";
			?>    </div>
	</div>

	<div class="w3-third w3-container">
		<div
			class="w3-card w3-padding w3-margin-top w3-margin-bottom w3-hover-shadow">
			<h2>JavaScript Local Cookie Reader</h2>
			<br> <i class="fas fa-cookie-bite w3-margin-bottom w3-text-theme"
				style="font-size: 60px"></i> <i
				class="fas fa-search w3-margin-bottom w3-margin-left w3-text-theme"
				style="font-size: 60px"></i> <i
				class="fas fa-laptop w3-margin-bottom w3-margin-left w3-text-theme"
				style="font-size: 60px"></i>

			<table id="jsCookies"
				class="w3-border w3-margin-bottom w3-margin-top w3-hoverable w3-table-all"
				width="100%">

				<script>
$(document).ready(function() {
    $('#cookieTable').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false,
        "scrollX": true,
        "searching": false,
    } );
} );
</script>

				<script>
function getCookieArray() {
var allcookies = document.cookie;
var cookieArray = [];   
var cookieSplit = allcookies.split(';');
// Now take key value pair out of this array
for(var i=0; i<cookieSplit.length; i++) {
var name = cookieSplit[i].split('=')[0];
var value = cookieSplit[i].split('=')[1];
cookie = [name, value];
cookieArray.push(cookie);
}
return(cookieArray);
}
var dataSet = getCookieArray();
$(document).ready(function() {
$('#jsCookies').DataTable( {
	"paging":   false,
	"ordering": false,
	"info":     false,
	"scrollX": true,
	"searching": false,
	data: dataSet,
	columns: [
		{ title: "Name","defaultContent": "", },
		{ title: "Value","defaultContent": "No data available in table", }
	]
	} );
} );
</script>
			</table>
		</div>

	</div>
</div>



<?php include $footerFile; ?>