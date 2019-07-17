<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Editable table</title>
</head>

<?php
$onchange= "onChange=\"this.style.background='#fdff8e';\"";
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
.card {
	max-width: 350px;
}
</style>

<?php

?>

<body>

<!-- Button trigger modal -->
<div align="center">
<div class="btn-group" role="group" aria-label="Basic example">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add Relay</button>
	<button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#deleteRelay">Delete Relay</button>
	<button class="btn btn-success" type="submit" form="form1">Save Changes</button>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<form action="submit.php" method="POST">
    	<input onChange=\"this.style.background='#fdff8e';\" name="option" value="addnormalrelay" hidden>
        <h6 class="text-left">Relay Name<input class="form-control" name="relayname" required></h6>
      </div>
      <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary">Save changes</button>
    		</form>
      </div>
       </div>
  </div>
</div>

<!-- Button trigger modal -->


<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="deleteRelay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete A Relay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
<form action="submit.php" method="POST">
	<input onChange=\"this.style.background='#fdff8e';\" name="option" value="deletenormalrelay" hidden>

<h6 class="text-left">Select Relay To Delete</h6></h6><select name="deleteid" class="form-control">
<?php
$stmt = $db->query("SELECT * FROM digitalfish.relay_master;");
		
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
				$name = $row['name'];
				print '<option value='.$id.'>'.$name.'</option>';
			};

?>
</select>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-danger">Delete Relay</buttton>
</form>
      </div>
    </div>
  </div>
</div>



<div align="center">
	<form id="form1" action="submit.php" method="post">
		<input name="option" value="relay-table-2-save" hidden>
		<?php
	

				$stmt = $db->query("SELECT * FROM digitalfish.relay_master;");
		
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
				$auto = $row['auto'];
				$name = $row['name'];
				$sunrise = $row['sunrise'];
				$morning = $row['morning'];
				$daytime = $row['daytime'];
				$afternoon = $row['afternoon'];
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
				
				if ($polarity=='0') {$polzero='selected'; $polone='';} else {$polzero=''; $polone='selected';}
				if ($auto=='0') {$autozero='selected'; $autoone='';} else {$autozero=''; $autoone='selected';}
				if ($therm_low_decision=='0') {$ibactionzero='selected'; $ibactionone='';} else {$ibactionzero=''; $ibactionone='selected';}
				if ($therm_high_decision=='0') {$iaactionzero='selected'; $iaactionone='';} else {$iaactionzero=''; $iaactionone='selected';}

				if ($thermconfig_id == 0 ) {$thermconfig_id_sensorname="0";} else {
				
				$stmtb = $db->query("SELECT * FROM digitalfish.thermconfig WHERE id='$thermconfig_id';");
				while($row = $stmtb->fetch(PDO::FETCH_ASSOC)) { 
					$thermconfig_id_sensorname=$row['sensorname'];
				};
			};


				if ($sunrise==1) {$selectedsunrise="selected";$sclr="select-lightgreen";} else {$selectedsunrise=NULL;$sclr='';};
				if ($morning==1) {$selectedmorning="selected";$mclr="select-lightgreen";} else {$selectedmorning=NULL;$mclr='';};
				if ($daytime==1) {$selecteddaytime="selected";$dclr="select-lightgreen";} else {$selecteddaytime=NULL;$dclr='';};
				if ($afternoon==1) {$selectedafternoon="selected";$aclr="select-lightgreen";} else {$selectedafternoon=NULL;$aclr='';};
				if ($sunset==1) {$selectedsunset="selected";$ssclr="select-lightgreen";} else {$selectedsunset=NULL;$ssclr='';};
				if ($night==1) {$selectednight="selected";$nclr="select-lightgreen";} else {$selectednight=NULL;$nclr='';};
				if ($nolight==1) {$selectednolight="selected";$nlclr="select-lightgreen";} else {$selectednolight=NULL;$nlclr='';};
				
				
		
				print'	

<div style="display: inline-block; margin: 5px;">
  <div class="card theme-standard-card-background">
  	<div class="card-body card-body-color1">
  	<div><h1 class="headinds" stlye="text-align:center !imporant;">'.$name.'</h1></div>
    	
	    
  				   	
							<input name="id[]" value='.$id.' readonly size="1" hidden>
							
							<div><h1 class="minheadinds">Title</h1></div>
							<input  '.$onchange.' class="form-control" name="name[]" value="'.$name.'">


							<div><h1 class="minheadinds">Phase Settings</h1></div>
							<div class="card">
								<div class="card-body">
									<ul class="list-inline">							
									<li class="list-inline-item">Sunrise<br><select '.$onchange.' class="form-control  '.$sclr.'" name="sunrise[]"><option value="0">Off</option><option value="1" '.$selectedsunrise.'>On</option></select>	</li>
									<li class="list-inline-item">Morning<br><select  '.$onchange.'  class="form-control '.$mclr.'" name="morning[]"><option value="0">Off</option><option value="1" '.$selectedmorning.'>On</option></select>	</li>
									<li class="list-inline-item">Daytime<br> <select '.$onchange.'  class="form-control '.$dclr.'" name="daytime[]"><option value="0">Off</option><option value="1" '.$selecteddaytime.'>On</option></select>	</li>
									<li class="list-inline-item">Afternoon<br> <select '.$onchange.'  class="form-control '.$aclr.'" name="afternoon[]"><option value="0">Off</option><option value="1" '.$selectedafternoon.'>On</option></select>	</li>
									<li class="list-inline-item">Sunset<br> <select  '.$onchange.' class="form-control '.$ssclr.'" name="sunset[]"><option value="0">Off</option><option value="1" '.$selectedsunset.'>On</option></select>	</li>
									<li class="list-inline-item">Night<br><select '.$onchange.'  class="form-control '.$nclr.'" name="night[]"><option value="0">Off</option><option value="1" '.$selectednight.'>On</option></select>		</li>
									<li class="list-inline-item">Nolight<br> <select  '.$onchange.' class="form-control '.$nlclr.'" name="nolight[]"><option value="0">Off</option><option value="1" '.$selectednolight.'>On</option></select>	</li>
									</ul>
								</div>
							</div>
							<div><h1 class="minheadinds">GPIO Settings</h1></div>
							<div class="card">
								<div class="card-body">
								<ul class="list-inline">
								<li class="list-inline-item"><h6 class="text-left">GPIO</h6><input  '.$onchange.' class="form-control" name="gpio[]" value="'.$gpio.'" size="5"></li>
								
								<li class="list-inline-item">
									<h6 class="text-left">Polarity</h6>
								    
									
									<select  class="form-control" '.$onchange.'  name="polarity[]">
										<option value="0" '.$polzero.'>0</option>
										<option value="1" '.$polone.'>1</option>
									</select>

								</li>
								
								<li class="list-inline-item"><h6 class="text-left">Automatic</h6>
								

								<select  class="form-control" '.$onchange.'  name="auto[]">
										<option value="0" '.$autozero.'>No</option>
										<option value="1" '.$autoone.'>Yes</option>
									</select>
								
								</ul>
								</div>
							</div>
							<div><h1 class="minheadinds">Temperature Reaction Settings</h1></div>
							<div class="card">
								<div class="card-body">
								<ul class="list-inline">
									<li class="list-inline-item"><h6 class="text-left">Connected to Sensor</h6>
									';
									
									$stmtb = $db->query("SELECT * FROM digitalfish.thermconfig;");
										print '<select  '.$onchange.' class="form-control" name="thermbind[]">';
											while($row = $stmtb->fetch(PDO::FETCH_ASSOC)) { 
												$idtherm=$row['id'];
												$thermsensorname=$row['sensorname'];
												
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
									<li class="list-inline-item"><h6 class="text-left">If below</h6><input  '.$onchange.' class="form-control" name="ib[]" value="'.$therm_low_value.'" size="2"></li>
									<li class="list-inline-item"><h6 class="text-left">Action</h6>

									<select  class="form-control" '.$onchange.'  name="ibaction[]">
										<option value="0" '.$ibactionzero.'>Off</option>
										<option value="1" '.$ibactionone.'>On</option>
									</select> 

									</li>
									<li class="list-inline-item">---</li>
									<li class="list-inline-item"><h6 class="text-left">If Above</h6><input  '.$onchange.' class="form-control" name="ia[]"  value="'.$therm_high_value.'" size="2"></li>
									<li class="list-inline-item"><h6 class="text-left">Action</h6>

									<select  class="form-control" '.$onchange.'  name="iaaction[]">
										<option value="0" '.$iaactionzero.'>Off</option>
										<option value="1" '.$iaactionone.'>On</option>
									</select> 


									</li>
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
	</form>
</div>







</body>
</html>

