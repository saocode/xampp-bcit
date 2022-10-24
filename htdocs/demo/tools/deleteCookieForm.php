<?php
$deleteForm = "
<form class=\"w3-margin-top\" action=\"tools/cookieTool.php\" method=\"post\">
";
echo $deleteForm;
?>


<?php
$cookieArr = $_COOKIE;
$cookieTable = "";
$cookieTable .= "
<table id=\"cookieTable\" class=\"w3-hoverable w3-table-all\" style=\"width:100%\">
<thead>
<tr>
<th></th>
<th>Name </th>
<th>Value</th>
</thead>
</tr>
<tbody >
";

foreach ($cookieArr as $key => $value) {

    $cookieTable .= "
    <tr>
    <td>";
    $cookieTable .= checkboxBlank($key);
    $cookieTable .= "
    </td>
    <td>$key</td>
    <td>$value</td>
    ";
    $cookieTable .= "
    </tr>
    ";
}

echo $cookieTable;

$deleteFormEnd = "
</tbody>
</table>


<input type=\"hidden\" name=\"webFunction\" value=\"delete\">


<button 
class=\"w3-hover-shadow-red w3-margin-top w3-margin-bottom w3-block w3-btn w3-white w3-border w3-border-red w3-round-large\"
type=\"submit\"><b>Delete Selected</b></button>
</form>

";

echo $deleteFormEnd;
?>


