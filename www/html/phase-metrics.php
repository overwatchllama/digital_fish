<?php 
// include "nav.php" 
?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<style>

.leftmargin5{
	margin-left: 5px;
	text-align: left;
}

</style>

<?php
	include "connection.php";
	$stmt = $db->query("SELECT phase FROM digitalfish.sched;");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $phase=$row['phase'];};
?>

	
		<div class="container">
			<div><h1 class="headinds">PHASE STATUS</h1></div>
			<br>
			<div class="row">
			<?php
			$phases = array('sunrise','morning','daytime','afternoon','sunset','night','nolight');
				foreach ($phases as $key => $value) {
				if ($phase==$value) {$phaseclass="alert-success border border-success";$indicator='<i class="fa fa-arrow-circle-right" style="color:green;"></i>';$currentchoice='<i class="fa fa-check-circle"></i>';} else {$phaseclass="lowlight"; $indicator="";$currentchoice='';};
				print'<div class="col-sm">	
						
						<div class="alert '.$phaseclass.'">'.$currentchoice.' '.ucfirst($value).'</div>';	
							$stmt = $db->query("SELECT * FROM relay_master WHERE $value='1' and auto='1' ORDER BY name");
							print '<div class="leftmargin5">';
							while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
							$name=$row['name'];
										print $indicator.' '.$name.'<hr>';	
							};
				 print '</div>';
				print '	</div>
					';};
				?>
			</div>
		</div>
	

<div align="left">
	<div class="pilcdnarrow">
			<div class="container">
				<div><h1 class="headinds">MANUAL RELAYS</h1></div>
				<ol>
					<table>
					<?php

					$stmt = $db->query("SELECT * FROM relay_master WHERE auto='0' ORDER BY name");
								print '<div class="leftmargin5">';
								while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
								$name=$row['name'];
								$state = $row['state'];
								if ($state==1) {$status='<i style="color: green;" class="fas fa-power-off fa-2x"></i>';} else {$status='<i  style="color: red;" class="fas fa-power-off fa-2x"></i>';};
											print '<tr><td><li>'.$indicator.' '.$name.'</td><td>'.$status.'</li></td></tr>';	
								};
					?>
				</table>
				</ol>
<div class="pad5"></div>
			</div>

	</div>

</div>
