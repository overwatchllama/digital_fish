
<?php
include "nav.php";
include "connection.php";

$id = $_GET['id'];
$saved = $_GET['saved'];
if ($saved == 1) {$saved_message="<img src='images/checkok.png' width='30'>Changes Saved";};



$stmt = $db->query("SELECT * FROM relay_dose WHERE id='$id';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    	$id = $row['id'];
    	$polarity = $row['polarity'];
    		if ($polarity==0) {$polarity0='selected';$polarity1='';} else {$polarity0='';$polarity1='selected';};

    	$state = $row['state'];
    	if ($state==0) {$state0='selected';$state1='';} else {$state0='';$state1='selected';};
    	$gpio = $row['gpio'];
    	$mls = $row['mls'];
    	$description=$row['description'];
    };

?>
<div class="container">
	<!-- <div style="max-width: 800px;"> -->
	<div><h1 class="headinds">EDIT DOSING RELAY</h1></div>
<table class="table">
<form action="submit.php" id="form1" method="POST">
	<input type="" name="option" value="editdoserelay" hidden>
	<input type="" name="id" value="<?php print $id;?>" hidden>
	<tr><th>Description</th><th>Polarity (0/1)</th><th>Enabled (0/1)</th><th>GPIO</th><th>ml (per sec) calibrated</th></tr>
	<tr>
	<td><input class="form-control" type="" name="description" value="<?php print $description;?>"></td>
	<td>
		   <select name="polarity" class="form-control" required="">
                                <option value="0" <?php print $polarity0; ?> >0</option>
                                <option value="1" <?php print $polarity1; ?> >1</option>
                            </select>
		<!-- <input class="form-control" type="" name="polarity" value="<?php print $polarity ;?>"> -->
	</td>
	<td>
		<select name="state" class="form-control" required="">
                                <option value="0" <?php print $state0; ?> >Off</option>
                                <option value="1" <?php print $state1; ?> >On</option>
                            </select>


		<!-- <input class="form-control" type="" name="state" value="<?php print $state ;?>"> -->
	</td>
	<td><input class="form-control" type="" name="gpio" value="<?php print $gpio;?>"></td>
	<td><input class="form-control" type="" name="mls" value="<?php print $mls;?>" disabled></td>
</tr>
	</td>
</form>
<td colspan="5">
<div class="btn-group" role="group" aria-label="Basic example" style="float: right;">
	<button class="btn btn-success" form="form1" type="submit">Save</button> <?php print $saved_message; print ' '?>
	<button class="btn btn-info" onclick="window.location.href='index.php?page=dosing'">Return</button>
</div>
</td>
</table>


<div align="left">
<div class="item">
    <a data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion2" aria-expanded="false" aria-controls="exampleAccordion2">
      <button class="btn btn-default">Click For Help</button>
    </a>
    <div id="exampleAccordion2" class="collapse" role="tabpanel">
      <p class="mb-3">
        Help is on it's way, we have some work to do.
      </p>
    </div>
  </div>
</div>

<?php
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
<br>
</div>
<br><br>
<div class="container">
<div align="center">
<br>

</div>

<div align="center">
	<div style="display: block;">
	<table class="table">
		<div><h1 class="headinds">DELETE THIS DOSING RELAY</h1></div>
		<form action="submit.php" method="POST">
			<input name="option" value="deletedoserelay" hidden>
			<input name="id" value="<?php print $id;?>" hidden>
			<input name="description" value="<?php print $description; ?>" hidden>
		<td><button class="btn btn-danger" type="submit">Delete</button> WARNING This cannot be undone</td>
		</form>
	</table>
	</div>
	
</div>


</div>
</div>
</div>