<?php
include "connection.php";
$iddata = $_GET['data'];

$stmt = $db->query("SELECT * FROM relay_master WHERE id='$iddata';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$state = $row['state'];
if ($state == 1) {$state = 0;} else {$state =1;};
};

$stmtv = $db->query("UPDATE relay_master SET state = '$state' WHERE id = '$iddata';");

?>

