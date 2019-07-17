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
	.card-body-color1 {
		background-color: #FAF7F6;
	}
</style>

<?php

?>

<body>
	<form action="submit.php" method="post">
		<input name="option" value="relay-table-2-save" hidden>
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
				if ($thermconfig_id == 0 ) {$thermconfig_id_sensorname="0";} else {
				
				$stmtb = $db->query("SELECT * FROM jayfish.thermconfig WHERE id='$thermconfig_id';");
				while($row = $stmtb->fetch(PDO::FETCH_ASSOC)) { 
					$thermconfig_id_sensorname=$row['sensorname'];
				};
			};


				if ($sunrise==1) {$selectedsunrise="selected";} else {$selectedsunrise=NULL;};
				if ($morning==1) {$selectedmorning="selected";} else {$selectedmorning=NULL;};
				if ($daytime==1) {$selecteddaytime="selected";} else {$selecteddaytime=NULL;};
				if ($sunset==1) {$selectedsunset="selected";} else {$selectedsunset=NULL;};
				if ($night==1) {$selectednight="selected";} else {$selectednight=NULL;};
				if ($nolight==1) {$selectednolight="selected";} else {$selectednolight=NULL;};
				
				
		
				print'	

<div style="display: inline-block; margin: 5px;">
  <div class="card theme-standard-card-background">
  <div class="card-body card-body-color1">
    <h5 class="card-title theme-standard-card-title">'.$name.'</h5>
	    
  				   	
							<input name="id[]" value='.$id.' readonly size="1" hidden>
							<hr>
							<label>Title</label>
							<input class="form-control" name="name[]" value="'.$name.'">


							<label>Phase Settings</label>
							<div class="card">
								<div class="card-body">
									<ul class="list-inline">							
									<li class="list-inline-item">Sunrise<br><select class="form-control" name="sunrise[]"><option value="0">Off</option><option value="1" '.$selectedsunrise.'>On</option></select>	</li>
									<li class="list-inline-item">Morning<br><select  class="form-control" name="morning[]"><option value="0">Off</option><option value="1" '.$selectedmorning.'>On</option></select>	</li>
									<li class="list-inline-item">Daytime<br> <select class="form-control" name="daytime[]"><option value="0">Off</option><option value="1" '.$selecteddaytime.'>On</option></select>	</li>
									<li class="list-inline-item">Sunset<br> <select class="form-control" name="sunset[]"><option value="0">Off</option><option value="1" '.$selectedsunset.'>On</option></select>	</li>
									<li class="list-inline-item">Night<br><select class="form-control" name="night[]"><option value="0">Off</option><option value="1" '.$selectednight.'>On</option></select>		</li>
									<li class="list-inline-item">Nolight<br> <select class="form-control" name="nolight[]"><option value="0">Off</option><option value="1" '.$selectednolight.'>On</option></select>	</li>
									</ul>
								</div>
							</div>
							GPIO Settings
							<div class="card">
								<div class="card-body">
								<ul class="list-inline">
								<li class="list-inline-item"><label>GPIO</label><input class="form-control" name="gpio[]" value="'.$gpio.'"></li>
								<li class="list-inline-item"><label>Polarity</label><input class="form-control" name="polarity[]" value="'.$polarity.'"></li>
								</ul>
								</div>
							</div>
							Temperature Reaction Settings
							<div class="card">
								<div class="card-body">
								<ul class="list-inline">
									<li class="list-inline-item"><label>Connected to Sensor</label>
									';
									
									$stmtb = $db->query("SELECT * FROM jayfish.thermconfig;");
										print '<select class="form-control" name="thermbind[]">';
											while($row = $stmtb->fetch(PDO::FETCH_ASSOC)) { 
												$idtherm=$row['id'];
												$thermsensorname=$row['sensorname'];
												print "XXX";
												print $thermconfig_id_sensorname.$thermsensorname;
												if ($thermconfig_id_sensorname == $thermsensorname) {$selected="selected";} else {$selected="";};
												if ($thermconfig_id == '0') {$noneselected="selected";} else {$noneselected="";};
												print '<option value="'.$idtherm.'" '.$selected.'>'.$thermsensorname.'</option>
												';			

												};
											print '<option value="0" '.$noneselected.'>None</option>';
										print '</select></li>';
									
									print '
								<br>
									<li class="list-inline-item"><label>If below</label><input class="form-control" name="ib[]" value="'.$therm_low_value.'"></li>
									<li class="list-inline-item"><label>Action</label><input class="form-control"  name="ibaction[]" value="'.$therm_low_decision.'"></li>
								<br>
									<li class="list-inline-item"><label>If Above</label><input class="form-control" name="ia[]"  value="'.$therm_high_value.'"></li>
									<li class="list-inline-item"><label>Action</label><input class="form-control"  name="iaaction[]" value="'.$therm_high_decision.'"></li>
								</ul>
								</div>
							</div>

<!-- End Divs of collapse routine 1 -->

<!--End Divs of collapse routine 1 -->

</div>
</div>
</div>



				';
							$thermconfig_id_sensorname="None";	}; #End Of Loop

		?>
		<br><button class="btn" action="submit">Save Changes</button>
	</form>
</body>
</html>

