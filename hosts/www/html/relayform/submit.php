<?php
include "connection.php";
$idarray=$_POST['id'];
$namearray=$_POST['name'];
$sunrisearray=$_POST['sunrise'];
print_r($sunrisearray);
foreach ($idarray as $key => $data) {
	print $data;	
	$name = $namearray[$key];
	$sunrise = $sunrisearray[$key];
	print $sunrise;
	if ($sunrise=='checked') {$sunrise=1;};
	// if ($filterid == NULL) {$filterid="NULL";}; #USED FOR POSSIBLE NULL WRITES
	

	$stmt = $db->prepare("UPDATE relay_master SET name='$name', sunrise='$sunrise' WHERE id='$data';");
	$stmt->execute();
};	
?>