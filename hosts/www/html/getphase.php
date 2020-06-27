

<?php
include "connection.php";
	$stmt = $db->query('SELECT * FROM digitalfish.sched;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$phase = $row['phase'];
		$startprep = $phase.'_start';
		$endprep = $phase.'_end';
		$start = $row[$startprep];
		$end= $row[$endprep];
// print'
// <div class="card">
//   <h5 class="card-header bg-dark"><font style="color:white;"><i class="far fa-clock"></i>&nbsp'.ucfirst($phase).'</font></h5>
//   	<div class="card-body">
//     	<p class="card-text">Phase Range:<br> Start=<strong>'.$start.'</strong> End=<strong>'.$end.'</strong></p>
//    </div>
// </div>';

print '
<div class="row phasefont">
  <div class="col-sm-4">'.ucfirst($phase).'</div>
  <div class="col-sm-4">Begins at '.$start.'</div>
  <div class="col-sm-4">Ends at '.$end.'</div>
</div>

';


};
?>
