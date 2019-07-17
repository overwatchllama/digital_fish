<?php
include "connection.php";
?>
<style>
	th {
    	text-transform: uppercase !important;
		}
	/*input {border:none;}*/

select {
	max-width: 120px !important;
	text-align: center;
}

.form-control {
	/*width: 60px !important;*/
}
</style>

<?php

?>
<body>
	<div class="container">
		<div><h1 class="headinds">RELAY SCHEDULE</h1></div>
		<div align="right" style="padding-bottom: 10px;"><button class="btn btn-success" action="submit" form="form1">Save Changes</button></div>
	<div class="card pad10">
	<form action="submit.php" method="post" id="form1">
		<input name="option" value="relay-table-save" hidden>

<table class="table table-bordered">
            <tr><th colspan="8" class="thcolorlevel1"><div style="float: left;">Automatically Scheduled Relays</div></th></tr>
            <tr><th class="thcolorlevel2">Name</th class="thcolorlevel2">
            	<th class="thcolorlevel2">Sunrise</th class="thcolorlevel2">
            		<th class="thcolorlevel2">Morning</th class="thcolorlevel2">
            			<th class="thcolorlevel2">Daytime</th class="thcolorlevel2">
            				<th class="thcolorlevel2">Afternoon</th class="thcolorlevel2">
	            				<th class="thcolorlevel2">Sunset</th class="thcolorlevel2">
	            					<th class="thcolorlevel2">Night</th class="thcolorlevel2">
	            						<th class="thcolorlevel2">Nolight</th></tr>

		<?php
				$stmt = $db->query("SELECT * FROM digitalfish.relay_master where auto='1';");
			
				

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
				$stmtb = $db->query("SELECT * FROM digitalfish.thermconfig WHERE id='$thermconfig_id';");
				while($row = $stmtb->fetch(PDO::FETCH_ASSOC)) { $thermconfig_id_sensorname=$row['sensorname'];};


				if ($sunrise==1) {$selectedsunrise="selected";$sclr="select-lightgreen";} else {$selectedsunrise=NULL;$sclr='';};
				if ($morning==1) {$selectedmorning="selected";$mclr="select-lightgreen";} else {$selectedmorning=NULL;$mclr='';};
				if ($daytime==1) {$selecteddaytime="selected";$dclr="select-lightgreen";} else {$selecteddaytime=NULL;$dclr='';};
				if ($afternoon==1) {$selectedafternoon="selected";$aclr="select-lightgreen";} else {$selectedafternoon=NULL;$aclr='';};
				if ($sunset==1) {$selectedsunset="selected";$ssclr="select-lightgreen";} else {$selectedsunset=NULL;$ssclr='';};
				if ($night==1) {$selectednight="selected";$nclr="select-lightgreen";} else {$selectednight=NULL;$nclr='';};
				if ($nolight==1) {$selectednolight="selected";$nlclr="select-lightgreen";} else {$selectednolight=NULL;$nlclr='';};
				
				
				if ($auto == '1') {

				$onchange= "onChange=\"this.style.background='#fdff8e';\"";

				print '
				<tr>
				<td>'.$name.' <input name="id[]" value="'.$id.'" hidden></td>
				<td>
					<select name="sunrise[]" class="form-control '.$sclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selectedsunrise.'>On</option></select>
				</td>
				<td>
					<select name="morning[]" class="form-control '.$mclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selectedmorning.'>On</option></select>
				</td>
				<td>
					<select name="daytime[]" class="form-control '.$dclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selecteddaytime.'>On</option></select>
				</td>
				<td>
					<select name="afternoon[]" class="form-control '.$aclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selectedafternoon.'>On</option></select>
				</td>
				<td>
					<select name="sunset[]" class="form-control '.$ssclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selectedsunset.'>On</option></select>
				</td>
				<td>
					<select name="night[]" class="form-control '.$nclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selectednight.'>On</option></select>
				</td>
				<td>
					<select name="nolight[]" class="form-control '.$nlclr.'" '.$onchange.'><option value="0" >Off</option><option value="1"'.$selectednolight.'>On</option></select>
				</td>
				</tr>
			';}

			else {print 
				'
					<tr>
				<td>'.$name.' <input name="id[]" value="'.$id.'" hidden></td>
				<td class="mytd">
					Manual
				</td>
				<td>
					Manual
				</td>
				<td>
					Manual
				</td>
				<td>
					Manual
				</td>
				<td>
					Manual
				</td>
				<td>
					Manual
				</td>
				</tr>
				';
			};
			
			}; #End Of Loop

		?>
		
</table>

<table class="table table-bordered">
            <tr><th colspan="7" class="thcolorlevel1"><div style="float: left;">Manual Relays</div></th></tr>
            <tr><th class="thcolorlevel2">Name</th class="thcolorlevel2"><th  class="thcolorlevel2">Condition</th></tr>

	<?php
				$stmt = $db->query("SELECT * FROM digitalfish.relay_master where auto='0';");
			
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$mid = $row['id'];				
				$auto = $row['auto'];
				$name = $row['name'];
				// $sunrise = $row['sunrise'];
				$state = $row['state'];
				if ($state == 1) {$selected="selected";$sclr="select-lightgreen";} else {$selected="";$sclr="";};
				$onchange= "onChange=\"this.style.background='#fdff8e';\"";
				print '
	
					<tr>
				<td>'.$name.' <input name="mid[]" value="'.$mid.'" hidden ></td>
					<td>
						<select name="manual[]" class="form-control '.$sclr.'" '.$onchange.'>
							<option value="0" >Off</option>
							<option value="1"'.$selected.'>On</option>
						</select>
					</td>
		
				</tr>
				';
			
			
			}; #End Of Loop

		?>
		
</table>

</form>







</body>
</div>

</div>
<br>

