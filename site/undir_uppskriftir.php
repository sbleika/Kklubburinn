
<?php
header('Content-Type: text/html; charset=utf-8');

include('views/header.php');

$db = new PDO('sqlite:db/uppskriftir.db') or die ('unable to connect');


if (!$db) die ($error);	
	
$query = "SELECT nafn,tegund,innskraning FROM uppskriftir";

$result = $db->query($query);
include('views/table.html');

echo "<table >";
foreach($result as $row) {
    echo "<tr>";
    echo "<td>" . $row[0] . "</td>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>" . $row[2] . "</td>";
    echo "</tr>";
}
echo "</table>";

if (!$result) die("Cannot execute query.");

//loka síðu
include('views/footer.php');