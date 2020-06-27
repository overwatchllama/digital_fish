<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Editable table</title>

 
</head>

<?php
include "connection.php";
?>
<style>
	th {
    	text-transform: uppercase !important;
		}
	/*input {border:none;}*/

	.form-control {
		min-width: 80px !important;
	}


</style>

<?php

?>
<body>
	<form action="submit.php" method="post">
		<input name="option" value="relay-table-save" hidden>

<table class="table table-bordered">
            <tr><th colspan="7" class="thcolorlevel1"><div style="float: left;">Relays</div></th></tr>
            <tr><th class="thcolorlevel2">Name</th class="thcolorlevel2"><th class="thcolorlevel2">Sunrise</th class="thcolorlevel2"><th class="thcolorlevel2">Morning</th class="thcolorlevel2"><th class="thcolorlevel2">Daytime</th class="thcolorlevel2"><th class="thcolorlevel2">Sunset</th class="thcolorlevel2"><th class="thcolorlevel2">Night</th class="thcolorlevel2"><th class="thcolorlevel2">Nolight</th></tr>


		<?php
				$stmt = $db->query("SELECT * FROM jayfish.relay_master;");
			
				

				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
				$name = $row['name'];
				$sunrise = $row['sunrise'];
				$morning = $row['morning'];
				$daytime = $row['daytime'];
				$sunset = $row['sunset'];
				$night = $row['night'];
				$nolight = $row['nolight'];
				$gpio = $row['gpio'];
				$polarity = $row['polarity'];
				$therm_low_value  = $row['therm_low_value']; #temperature value
				$therm_high_value  = $row['therm_high_value'];#temperature value
				$therm_low_decision  = $row['therm_low_decision'];# 0 to instruct off
				$therm_high_decision  = $row['therm_high_decision'];# 1 to instruct on
				$thermconfig_id  = $row['thermconfig_id'];#Bound to therm id 
				$stmtb = $db->query("SELECT * FROM jayfish.thermconfig WHERE id='$thermconfig_id';");
				while($row = $stmtb->fetch(PDO::FETCH_ASSOC)) { $thermconfig_id_sensorname=$row['sensorname'];};


				if ($sunrise==1) {$selectedsunrise="selected";$sclr="-";} else {$selectedsunrise=NULL;};
				if ($morning==1) {$selectedmorning="selected";} else {$selectedmorning=NULL;};
				if ($daytime==1) {$selecteddaytime="selected";} else {$selecteddaytime=NULL;};
				if ($sunset==1) {$selectedsunset="selected";} else {$selectedsunset=NULL;};
				if ($night==1) {$selectednight="selected";} else {$selectednight=NULL;};
				if ($nolight==1) {$selectednolight="selected";} else {$selectednolight=NULL;};
				


				print '
				<tr>
				<td>'.$name.' <input name="id[]" value="'.$id.'" hidden></td>
				<td class="mytd">
					<select name="sunrise[]" class="form-control" ><option value="0" >Off</option><option value="1"'.$selectedsunrise.'><i class="fa fa-arrow-circle-right" style="color:green;"></i>On</option></select>
				</td>
				<td>
					<select name="morning[]" class="form-control"><option value="0" >Off</option><option value="1"'.$selectedmorning.'>On</option></select>
				</td>
				<td>
					<select name="daytime[]" class="form-control"><option value="0" >Off</option><option value="1"'.$selecteddaytime.'>On</option></select>
				</td>
				<td>
					<select name="sunset[]" class="form-control"><option value="0" >Off</option><option value="1"'.$selectedsunset.'>On</option></select>
				</td>
				<td>
					<select name="night[]" class="form-control"><option value="0" >Off</option><option value="1"'.$selectednight.'>On</option></select>
				</td>
				<td>
					<select name="nolight[]" class="form-control"><option value="0" >Off</option><option value="1"'.$selectednolight.'>On</option></select>
				</td>
				</tr>
			';
			
			}; #End Of Loop

		?>
		
</table><button class="btn" action="submit">Save Changes</button></form></body>

</body>
</html>

<!-- Configure button start -->
  <!-- <a class="btn btn-primary" data-toggle="collapse" href="#relay1" role="button" aria-expanded="false" aria-controls="relay1"> -->
    <!-- Configure</a> -->
<!-- Configure button start -->

<!-- Beginning of collapse routine 1 -->
<!-- <div class="collapse" id="relay1"> -->
  <!-- <div class="card card-body"> -->
    <!-- DATA -->
  <!-- </div> -->
<!-- </div> -->
<!-- End of collapse routine 1 -->

