<style type="">
	
	.progress {height: 30px !important;width: 100%;}

</style>


<?php
include "connection.php";
function barhealth($health_percent) {

			$health_percent_realvalue = intval($health_percent);
			$health_percent = intval($health_percent);
			if ($health_percent >= 100) {$health_percent = 100;};
			if ($health_percent <= 12 )	$rankhealth = '<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width:'.$health_percent.'%"></div>&nbsp'.$health_percent.'%</div>';
			if ($health_percent >= 13 )	$rankhealth = '<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
			if ($health_percent >= 65 )	$rankhealth = '<div class="progress"><div class="progress-bar progress-bar-warning" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
			if ($health_percent >= 70 )	$rankhealth = '<div class="progress"><div class="progress-bar progress-bar-warning" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
			if ($health_percent >= 80 )	$rankhealth = '<div class="progress"><div class="progress-bar progress-bar-danger" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent_realvalue.'%</div></div>';
		  	
		  	return $rankhealth;
		  };

?>

<script>
function confirm_waterchange()
{
var r=confirm("You are about to log a water change entry. If yes click OK. This will cause the water AGE to be reset.")
if (r==true)
  {
  location.href = "submit.php";
  }
else
  {
  location.href = "dashboard.php";
  }
}

</script>
<form action="submit.php" method="POST">
<input type="" name="option" value="waterchange" hidden> 

<div class="container">
	<div><h1 class="headinds">Water Change</h1></div>
<table class="table table-bordered">
					<th class="th-heading" colspan="5"><div style="float: left;">Water Change (days)</div><div style="float: right;"><button class="btn btn-danger" type="submit" onclick="confirm_waterchange()" value="Display a confirm box">Log Water Change</button></div>
					</th>
					<tr>
					<th>Water Change</th>	
					<th>Cycle Spent</th>
					<th>Periods<br><div class="thsecondrow">Total Days</div></th>
					<th>Over<br><div class="thsecondrow">Expiry Days</div></th>
					<th>Expiry<br><div class="thsecondrow">Days Set</div></th>
				</tr>
						<?php
							$stmt = $db->query('SELECT * FROM digitalfish.event where event ="waterchange" LIMIT 1;');
								while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									$waterchange_threshold = $row['value'];
									$waterchange = $row['dateset'];
									$waterchange = strtotime($waterchange);
									$waterchangeresult = time() - $waterchange ;
									$waterchangeresult = intval($waterchangeresult/60/60/24);
									$watercalc =  $waterchangeresult - $waterchange_threshold;
									$waterchange_percent = $waterchangeresult * 100 / $waterchange_threshold;							
									$health = barhealth($waterchange_percent);
									// Allert
									if ($waterchange_percent >= 99) { array_push($alerts, '<td>Your Water Change/Top Up needs attention it\'s at </td><td>'.intval($waterchange_percent).'%</td><tr></tr>');};
									// Alert End
									if ($watercalc <= 0) {$watercalc=0;};									
									print '<td>Change</td><td>'.$health.'</td><td>'.$waterchangeresult.'</td><td>'.$watercalc.'</td><td><input class="form-control" name="threshhold" value="'.$waterchange_threshold.'"></td><tr></tr>'; //etc...
								};
						?>
</table>

<br>
</div>
</form>