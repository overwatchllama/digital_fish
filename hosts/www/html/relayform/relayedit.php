<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Editable table</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>

<?php
include "connection.php";
?>
<style>
	th {
    	text-transform: uppercase !important;
		}
	input {border:none;}
</style>

<?php
$headings = array('id','name','sunrise','morning','daytime','sunset','night','nolight');
?>

<body>
	<form action="submit.php" method="post">
		<?php
		print '<table class="table table-bordered thead-dark">
			<thead class="thead-dark">
				
				<tr>
				';
				foreach ($headings as $key => $value) {
					print '<th>'.$value.'</th>';
					# code...
				}

				print '
				</tr>
			</thead>';

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
				if ($sunrise==1) {$selected="selected";} else {$selected="";};
				if ($morning==1) {$selected="selected";} else {$selected="";};
				
				print '
				   	<tr>
							<td><input name="id[]" value='.$id.' readonly size="1"></td>
							<td><input name="name[]" value="'.$name.'" style="width:100%;"></td>
							<td><select name="sunrise[]"><option value="0">Off</option><option value="1" '.$selected.'>On</option></select></td>
							<td><select name="morning[]"><option value="0">Off</option><option value="1" '.$selected.'>On</option></select></td>
							<td><select name="daytime[]"><option value="0">Off</option><option value="1" '.$selected.'>On</option></select></td>
							<td><select name="sunset[]"><option value="0">Off</option><option value="1" '.$selected.'>On</option></select></td>
							<td><select name="night[]"><option value="0">Off</option><option value="1" '.$selected.'>On</option></select></td>
							<td><select name="nolight[]"><option value="0">Off</option><option value="1" '.$selected.'>On</option></select></td>
							
						</tr>
				';
								}; #End Of Loop
		print '</table>';
		?>
		<button action="submit">Go</button>
	</form>
</body>
</html>

