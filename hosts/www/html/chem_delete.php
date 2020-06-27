<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>



<?php
include "connection.php";

$idarray = $_POST['id'];
$checkbox = $_POST['check'];
$hashtag = $_POST['hashtag'];


// print_r ($idarray);
// print '<br>';
// print_r ($checkbox);
$colection = implode(',', $checkbox);
// print '<br>Collection: '.$colection;


foreach ($checkbox as $key => $value) {
	// print '<br>';
	if ($value == 1) {
	// print $idarray[$key]; print '<br>';
	$delete = $idarray[$key];
	// print "delete: " . $delete;
	$stmt = $db->query("DELETE FROM event WHERE id = $delete;");
	};
	# code...
};

print '<meta http-equiv="refresh" content="0;url=chem_age.php?hashtag='.$hashtag.'">';   
print 'a';
?>

</body>
</html>
