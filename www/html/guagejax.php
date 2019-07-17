<?php
include "connection.php";

$datafetch = $_GET['datafetch'];

$labelarray = array();
$thermarray = array();

$stmtv = $db->query("SELECT * FROM thermconfig;");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
      $label = $row['sensorname'];    array_push($labelarray, $label);
      $therm = $row['current_therm']; array_push($thermarray, $therm);
};

$stmt = $db->query("SELECT state FROM jayfish.codes WHERE code='thermtype';");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $thermtype = $row['state'];
};

$reading =  $thermarray[$datafetch];
if ($thermtype==0) {$reading = $reading *9/5+32 ;};
print $reading;
?>

 