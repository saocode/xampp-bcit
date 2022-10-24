<?php
include "headerScript.php";
$output = "";

echo $output;
?>





<script>
var font = 10,
  html = '';

for (i = 0; i < 20; i++) {
  html += '' +
    '<div style="font-size:' + font + 'px">' +
    '<input type="checkbox" id="' + i + '"></input><label for="' + i + '">Test</label>' +
    '</div>';

  font += 2;
}

document.body.innerHTML = html;
</script>


<?php include $footerFile; ?>