<?php
header('Content-Type: text/html; charset=utf-8');

$db = new PDO('sqlite:form/db/uppskriftir.db') or die ('unable to connect');



if (!$db) die ($error);	
	
$query = "SELECT nafn,tegund,innskraning FROM uppskriftir";

$result = $db->query($query);

echo "<table cellpadding=10 border=1>";
foreach($result as $row) {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] . "</td>";
    echo "</tr>";
}
echo "</table>";

if (!$result) die("Cannot execute query.");

$rows = sqlite_num_rows($result);

$field1 = sqlite_field_name($result, 0);
$field2 = sqlite_field_name($result, 1);

echo "<table style='font-size:12;font-family:verdana'>";
echo "<thead><tr>";
echo "<th align='left'>$field1</th>";
echo "<th align='left'>$field2</th>";
echo "</tr></thead>";

?>