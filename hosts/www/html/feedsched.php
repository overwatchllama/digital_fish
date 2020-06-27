<!DOCTYPE html>
<html>
<head>
    <title>
        DigitalFish
    </title>
    <?php
        include "nav.php";
        include "connection.php";
        include "global.php";



    ?>

</head>
<body>
	<div class="container">
<div align="center">
<div class="maxcontent_width">
<?php
$savedstatus = $_GET['savedstatus'];
if ($savedstatus == 1) {$savedstatus = "Saved";} else {$savedstatus ="";};

$feedstatus = $_GET['feedstatus'];
if ($feedstatus == 1) {$feedstatus = "Fed !!!";} else {$feedstatus ="";};


print '
<table class="table table-bordered relaytbl softbox" style="min-width: 300px;">
            <th class="th-heading" colspan="2">Manual Feed</th><tr></tr>
<form action="submit.php" method="POST">
<input name="option" value="feed_remote" hidden>
<tr><td>Manual Feed</td><td><button class="btn">FEED</button>&nbsp'.$feedstatus.'</td></tr>
</form>
';





$phase_array = array();
$description_array = array();
$feed_array = array();
$feed_result_array = array();


$stmt = $db->query('SELECT * FROM digitalfish.schedaction;');
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		array_push($phase_array, $row['phase']);
		array_push($description_array,  $row['description']);
		array_push($feed_array,  $row['feed']);
		array_push($feed_result_array_,  $row['feed_result']);
		// print $row['feed'];
		};


 // print_r ($feed_array);
print '
<table class="table table-bordered relaytbl softbox" style="min-width: 300px;">
            <th class="th-heading" colspan="2">Auto Feed Relay Schedule</th><tr></tr>
<form action="commit.php" method="POST">
<input name="option" value="feedschedule"  hidden>

';

foreach ($phase_array as $key => $value) {
	$y_action="";
	$n_action="";
	if ($feed_array[$key]== "1") {$feed_array_result = "Y"; $y_action = "selected"; $n_action="";} else {$feed_array_result= "N"; $n_action="selected"; $y_action="";};
	print '<tr><td>'.ucwords($description_array[$key]).'</td><td style="max-width:20px;">
	<input name="feedschedule_phase[]" value = "'.$phase_array[$key].'" hidden>
	<select class="form-control" name="feed_array[]">
	<option value="Y" '.$y_action.' >Y</option>
	<option value="N" '.$n_action.'>N</option></select>
	</td></tr>';
	# code...
}


print '	


	<tr><td colspan="2">Selecting Y will cause your feeder relay to actuate when then time phase is detected.  It will only do this once per phase. Afterwhich it will wait for the following day to feed again.</td></tr>
	
	<tr><td colspan="2"><button class="btn" type="submit"> Save</button> '.$savedstatus.'</td></tr>

</form>

';

$compiled_url = $url.$port.'/?username='.$username.'&password='.$password;
?>

</table>
</div>
</div>
</div>
</body>
</html>



