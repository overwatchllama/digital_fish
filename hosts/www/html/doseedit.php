
<?php
include "nav.php";
include "connection.php";


?>


	<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
	<script type="text/javascript" src="lib/jquery.timepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/jquery.timepicker.css" />
	<script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" />
	<script type="text/javascript" src="lib/site.js"></script>
	<!-- <link rel="stylesheet" type="text/css" href="lib/site.css" /> -->



		
		<!-- <input id="timeselect" type="text" class="time" /> -->
		
		



<div class="container">

<?php
if (isset($_GET['relay_dose_id'])) {
$id = $_GET['relay_dose_id'];
$stmt = $db->query("SELECT description FROM relay_dose WHERE id=$id;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    	$description=$row['description'];

    };
}

else{

$id = $_POST['option'];
$description = $_POST['description'];

};



function whatdayisit($x) {
	if ($x == 0) {return "Sunday";};
	if ($x == 1) {return "Monday";};
	if ($x == 2) {return "Tuesday";};
	if ($x == 3) {return "Wednesday";};
	if ($x == 4) {return "Thursday";};
	if ($x == 5) {return "Friday";};
	if ($x == 6) {return "Saturday";};
};

	$stmta = $db->query("SELECT * FROM relay_dose WHERE id='$id';");
    while($rowa = $stmta->fetch(PDO::FETCH_ASSOC)) {
    	global $mls;
	   	$mls=$rowa['mls'];

    };

// DOSING
print '<div align="center">';
print '<div><h1 class="headinds">SCHEDULING : '. $description.'</h1></div>';
print '<input name="option" value="adddosesched" hidden>';
print '<table class="table">';
print '<tr><th>Day</th><th>Time</th><th>Seconds</th><th>Schedule Run</th><th>Delete</th></tr>';
$stmt = $db->query("SELECT * FROM relay_dose_sched WHERE relay_dose_id=$id ORDER BY day,time ;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$day = $row['day'];
	$relay_dose_id = $row['relay_dose_id'];
	$relay_dose_table_id = $row['id'];
	

	
	$dayprint = whatdayisit($day);
	$time = $row['time'];
	$seconds = $row['seconds'];
	
	$dosecompleted = $row['dosecompleted'];
	


	if ($dosecompleted == 1)  {$dosecompletedcount="Completed";$style = 'style="background: lightgreen;"';} 
        	else {$dosecompletedcount ="Pending";$style = 'style="background: lightyellow;"';};
$mlsrate = $mls * $seconds;
$mlsrate = round($mlsrate,2);
print '<tr><td>'.$dayprint.'</td><td>'.$time.'</td><td>'.$seconds." = ".$mlsrate.'(ml dose)</td>
<td '.$style.'>'.$dosecompletedcount.'</td>

<td><form action="submit.php" method="post"><input name="option" value="deletedosesched" hidden>
			<input name="id" value="'.$relay_dose_table_id.'" hidden>
			<input name="relay_dose_id" value="'.$id.'" hidden>
		<button  class="btn btn-danger">DEL</button></form><td>

</tr>';
};
print '</table>';
print '</div>';

$stmt = $db->query("SELECT * FROM relay_dose WHERE id='$id';");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$mlscheck=$row['mls'];
if ($mlscheck == 0 ) {print "
	<div align='center'>
	<div class='alert alert-danger'>WARNING
	This relay has not been calibrated yet, please calibrate by first navigating to /var/www/html/pycode.<br>
	And run the following command <strong>python dose-calibrate</strong></div>
	</div>
	";};
};

?>
<hr><br>
<div align="center">
	 ( Millitre's to seconds calculator - <strong>will auto populate seconds in Add Schedule Dose</strong> )
	<div style="max-width: 890px;" class="alert alert-info">
	<table>
	<td style="padding: 3px;"><input  class="form-control" id="a1" type="text" /></td><td>(ml)</td>
	<td style="padding: 3px;"><button class="btn btn-primary" id="a2" type="text" onclick="calculate()"  />Calc</button></td>
	<!-- <td style="padding: 3px;"><input  class="form-control" id="" type="text" name="total_amt" disabled/></td><td>Seconds</td> -->
	</table>
	</div>
</div>


<div align="center">
<h3>Add Scheduled Dose</h3>
<table class="table">
	<tr><th>Day</th><th>Time <font style="font-weight: normal;">(00:00:00)</font></th><th colspan="2">Seconds</th></tr>
<form action="submit.php" method="POST">
	<input name="option" value="addscheddose" hidden>
	<input name="doseid" value="<?php print $id;?>" hidden >
		<tr>
			<td>
				<select class="form-control" name="day" required>		
					
					<option value="0">Sunday</option>
					<option value="1">Monday</option>
					<option value="2">Tuesday</option>
					<option value="3">Wednesday</option>
					<option value="4">Thursday</option>
					<option value="5">Friday</option>
					<option value="6">Saturday</option>
				</select>
			</td>
		<td>

			<input class="form-control" id="timeselect" type="" name="time" placeholder="00:00:00" required>
			<script>
			$(function() {
				$('#timeselect').timepicker({ 'timeFormat': 'H:i:s', 'step': 15 });
				
			});
		</script>
		</td>
		<td><input class="form-control" id="a3" type="text" name="seconds" placeholder="Use Calc (Recommended)" required></td>
		<td><button  class="btn btn-success" type="submit">ADD</button></td>
</tr>


	
</form>
</table>

<?php
$formula = 1 / $mls;
$formula = round($formula,2);
print '<div align="center">';
print 'Your formula for 1 ml is : <strong>'.$formula.'</strong> seconds<br>';
print 'So forevery <strong>'.$formula.'</strong> seconds your relay will dispense <strong>1ml</strong>';
print '</div>';
?>

<br>

</div>


</div>



<script>
calculate = function()
{
    var ml = document.getElementById('a1').value;
    // var rate = document.getElementById('a2').value; 
    document.getElementById('a3').value = (parseFloat(ml)*parseFloat(<?php print $formula;?>)).toPrecision(3);

   }

</script>