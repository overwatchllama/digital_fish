<!DOCTYPE html>
<?php
    include "connection.php";


$id_array = array();
$shortname_array = array();
$description_array = array();
$measuerment_array = array();
$threshold_array = array();

$stmt = $db->query('SELECT * FROM digitalfish.chem;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$id = $row['id'];
$idcollect = $row['id'];
$shortname = $row['shortname'];
$description = $row['description'];
$measurement = $row['measurement'];
$threshold = $row['thershold'];

$readings_array = array();
$date_array = array();
			$stmta = $db->query("SELECT * FROM digitalfish.event WHERE chemid = '$id'  ORDER by id DESC limit 3;");
			    while($rowa = $stmta->fetch(PDO::FETCH_ASSOC)) {
					$reading = $rowa['value'];
					$date = $rowa['dateset'];
					array_push($readings_array, $reading);
					array_push($date_array, $date);

			
				};

$readings_array = array_reverse($readings_array);
$readingname = 'group'.$id;
$$readingname = $readings_array;

$date_array = array_reverse($date_array);
$datename = 'groupdate'.$id;
$$datename = $date_array;


array_push($id_array, $id);
array_push($shortname_array, $shortname);
array_push($description_array, $description);
array_push($measurement_array, $measurement);
array_push($thershold_array, $threshold);

};

?>

	



	<form action="submit.php" method="POST">
		<input name="option" value="chemreadsubmit" hidden>
<div class="row">
	<div class="col-sm-1"></div>
		<div class="col-sm-10" align="center">
			<?php
				foreach ($id_array as $key => $value) {
					global $inject_shortname;
					$inject_shortname = $shortname_array[$key];
					
					$render = 'group'.$value;
					$renderdate = 'groupdate'.$value;
					$allvalues = $$render;
					$alldates = $$renderdate;

					print '
					
					<div class="card" style="width: 15rem; margin:10px; display:inline-table;">
				  		
				  			<div class="card-body">
				    			<h5 class="card-title">'.$shortname_array[$key].'</h5>
				    			<table class="table">';

											foreach ($allvalues as $key => $data) {
												$alldatesdate = $alldates[$key];
												$datesetup = strtotime($alldatesdate);
												$shortdate = date("F j",$datesetup);
											if ($dataprev < $data) {$result='<i style="color:#8cf442;" class="fas fa-arrow-up"></i>';}
											if ($dataprev > $data) {$result='<i style="color:red;" class="fas fa-arrow-down"></i>';}
												print '<tr><td>'.$shortdate.'</td><td>'.$data.'</td><td>'.$result.'</td></tr>';
											
											$dataprev = $data;

											};	
				    			
				    			print '</table>

				    			<input name="id[]" value="'.$value.'" hidden>
				    			<input name="shortname[]" value="'.$inject_shortname.'" hidden >
				    			<p class="card-text"><input type="number" step="0.001" style="width: 120px;font-size:2em !important;" name="reading[]" class="form-control" autocomplete="off"></p>
				    			
				    			<button class="btn btn-primary">Submit Reading +</button>
				    			
				  			</div>
					</div>
					

					';
				};
			?>
		</div>
			<div class="col-sm-1">	</div>
</div>		
	</form>


<?php





?>
