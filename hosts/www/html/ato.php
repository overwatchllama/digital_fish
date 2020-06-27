    <?php
                include "connection.php";
    ?>
<?php
$stmt = $db->query('SELECT * FROM digitalfish.ato_relay;');
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$duration = $row['value'];
		$gpio = $row['gpio'];
		$ml = $row['ml'];
		$polarity = $row['polarity'];
		if ($polarity==1) { $polarity1='selected'; $polarity0='';} else { $polarity1=''; $polarity0='selected';};
		$switchgpio = $row['switchgpio'];
		$failswitchgpio = $row['failswitchgpio'];
		$resevoir = $row['resevoirgpio'];
};
?>

<form id="form1" action="submit.php" method="POST">
<input  name="option"  value="ato"  hidden>
<div class="container">
<div>
	<h1 class="headinds">ATO CONFIGURATION</h1>
</div>
	<div style="max-width: 600px; margin: 0 auto;">
		<button class="btn btn-success" type="submit" form="form1">Save Changes</button>
		<div class="card text-dark bg-light mb-3" style="min-width: 18rem; margin:5px;">
			<div class="card-header text-white bg-dark">Parameters</div>
				<div class="card-body">
					<p class="card-text">
				    	<table>
							<tr>
								<td>Dispense Duration&nbsp</td>
								<td><input class="form-control" type="" name="value" value="<?php print $duration;?>"></td><td>s</td>
							</tr>
				    		<tr>
				    			<td>Millitres Per Dispense</td>
				    			<td><input class="form-control" type="" name="ml" value="<?php print $ml;?>"></td><td>ml</td>
				    		</tr>
				    	</table>
					</p>
				</div>
		</div>
	<div class="card text-dark bg-light mb-3" style="min-width: 18rem; margin:5px;">
		<div class="card-header text-white bg-dark">Float Switch 1</div>
		<div class="card-body">    
		<table>
		<tr>
			<td>Pump Relay GPIO</td><td><input class="form-control" type="" name="gpio" value="<?php print $gpio; ?>"></td>
		</tr>
		<tr>
			<td>Pump GPIO Polarity</td>
			<td>
				<select name="polarity" class="form-control">
					<option <?php print $polarity1;?>>1</option>
					<option <?php print $polarity0;?>>0</option>
				</select>


				</td>
		</tr>
		<tr>
			<td>Float GPIO</td><td><input class="form-control" type="" name="switchgpio" value="<?php print $switchgpio; ?>"></td>
		</tr>
	</table>
				    
  		</div>
	</div>

	<div class="card text-dark bg-light mb-3" style="min-width: 18rem; margin:5px;">
				  <div class="card-header text-white bg-dark">Float Switch 2 (Fail)</div>
				  <div class="card-body">    
					<table>
						<tr>
							<td>Float GPIO</td>
							<td><input class="form-control" type="" name="failswitchgpio" value="<?php print $failswitchgpio; ?>"></td>
						</tr>
					</table>
					</div>
	</div>
	<div class="card text-dark bg-light mb-3" style="min-width: 18rem; margin:5px;">
				  <div class="card-header text-white bg-dark">Resevoir Fail Switch 3 (Fail) ** OPTIONAL</div>
				  <div class="card-body">    
					<table>
						<tr>
							<td>Resevoir Float GPIO</td>
							<td><input class="form-control" type="" name="resevoirgpio" value="<?php print $resevoir; ?>"></td>
						</tr>
					</table>
					</div>
	</div>
	<br>
</div>
</div>
</form>	

	