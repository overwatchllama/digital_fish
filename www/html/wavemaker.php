<?php
	// include "nav.php";
	include "connection.php";
?>

	
<script>
function show_alert() {
  if(confirm("Do you really want to do this?"))
    document.forms[0].submit();
  else
    return false;
}
</script>



<style type="text/css">
.waveinput {
	max-width: 50px;
}

.waveinput_onoff {
	max-width: 65px;
}

.phasegreen {
	background: lightgreen;
}
</style>

<div class="container">
	<div><h1 class="headinds">Wave Maker / Pulsor</h1></div>
	<div align="center">
		<table class="table table-bordered relaytbl softbox">
			<tr>
				
				<div style="float: right;"><a href="phase_sched_edit.php"><div style="float: right;"><a href="dashboard.php"<span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span></a></th>
			</tr>
	
	<form action="submit.php" method="post">
		<input name="option" value="wavemakerset" hidden>
		<tr>
			<th>Phase</th>
			<th>Pulse</th>
			<th>Rest</th>
			<th>State</th>
			<th>Pulse</th>
			<th>Rest</th>
			<th>State</th>
		</tr>
	<tr>
		<td class="tdsmall">period</td>
		<td class="tdsmall">seconds</td>
		<td class="tdsmall">seconds</td>
		<td></td>
		<td class="tdsmall">seconds</td>
		<td class="tdsmall">seconds</td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">WAVE MAKER A</td></td>
		<td colspan="3">WAVE MAKER B</td></td>
	</tr>

<?php
		$stmt = $db->query('SELECT * FROM relay_wave WHERE name="wave_a"');
                                    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$wave_a_gpio = $rows['gpio'];
				$wave_a_polarity = $rows['polarity'];
                                    };

		$stmt = $db->query('SELECT * FROM relay_wave WHERE name="wave_b"');
                                    while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$wave_b_gpio = $rows['gpio'];
			$wave_b_polarity = $rows['polarity'];
                                    };

// print $wave_a_gpio.$wave_b_gpio;

	$a=1;
		$stmt = $db->query('SELECT * FROM relay_wave_phase');
        	while($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {

	print '

	<input name="phase'.$a.'" value="'.$rows['description'].'" hidden>
	<tr>
		<td>'.$rows['description'].'</td>
		<td><input name="wave_a_pulse'.$a.'" class="form-control inline waveinput" value='.$rows['wave_a_pulse'].'></input></td>
		<td><input name="wave_a_rest'.$a.'" class="form-control inline waveinput" value='.$rows['wave_a_rest'].'></input></td>
		<td>
			';
			if ($rows['wave_a_state']=="on") {
	print'<select class="form-control waveinput_onoff phasegreen" name="wave_a_state'.$a.'">
				<option value="on">on</option>
				<option value="off">off</option>';
			} else {
				print '
			<select class="form-control waveinput_onoff phasered" name="wave_a_state'.$a.'">
				<option value="off">off</option>
				<option value="on">on</option>';
				
			};
			print '</td>
			
			</select>
				
		<td><input name="wave_b_pulse'.$a.'" class="form-control inline waveinput" value='.$rows['wave_b_pulse'].'></input></td>
		<td><input name="wave_b_rest'.$a.'" class="form-control inline waveinput" value='.$rows['wave_b_rest'].'></input></td>
		<td>
			';
			if ($rows['wave_b_state']=="on") {
	print'<select class="form-control waveinput_onoff phasegreen" name="wave_b_state'.$a.'">
				<option value="on">on</option>
				<option value="off">off</option>';
			} else {
				print '
			<select class="form-control waveinput_onoff phasered" name="wave_b_state'.$a.'">
				<option value="off">off</option>
				<option value="on">on</option>';
				
			};
			print '
			</td>
			</select>
	</tr>

	';

	$a = $a+1;
	};

	?>
<td colspan="3" align="center">
	<div class="nested_table">Gpio :</div><div class="nested_table" style="margin-left: 10px;"><input name="waveagpio"class="form-control" value="<?php print $wave_a_gpio;?>"></div>
</td>

<td>Polarity: <div class="nested_table" style="margin-left: 10px;"><input name="waveapolarity" class="form-control" 	value="<?php print $wave_a_polarity;?>" style="max-width: 45px;">
</td>
	
<td colspan="2" align="center"><div class="nested_table">Gpio :</div><div class="nested_table" style="margin-left: 10px;"><input name="wavebgpio" class="form-control" value="<?php print $wave_b_gpio;?>"></div>
</td>

<td>
	Polarity: <div class="nested_table" style="margin-left: 10px;"><input name="wavebpolarity" class="form-control" value="<?php print $wave_b_polarity;?>" style="max-width: 45px;">
</td>


	</table>
	<div class="<?php print $tablebackground_nolines_header; ?> tablewidth ">
	<button class="btn btn-default" type="submit">Save</button>
	</div>
</form>
</div>
<br>
</div>

