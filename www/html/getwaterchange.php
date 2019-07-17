<style type="text/css">
	.water{
		
		/*min-width: 900px;*/
		text-align: center;

	}

  .progress{
    min-width: 100%;
  }
</style>
<?php
include "connection.php";
?>
<?php

function barhealth($health_percent) {

  $health_percent_realvalue = intval($health_percent);
  $health_percent = intval($health_percent);
  if ($health_percent >= 100) {$health_percent = 100;};
  // $health_percent = 20;
  if ($health_percent >= 0  ) $rankhealth = '
  <div class="progress bg-dark water" style="height: 30px;">
  <div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%"></div>
  <div style="width:100%;color: white; padding-top:3px;">'.$health_percent.'% of cycle</div></div>';
  
  if ($health_percent >= 20 ) $rankhealth = '
  <div class="progress bg-dark water" style="height: 30px;">
  <div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'% of cycle</div></div>';
  if ($health_percent >= 50 ) $rankhealth = '
  <div class="progress" style="height: 30px;">
  <div class="progress-bar bg-info" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'% of cycle</div></div>';
  if ($health_percent >= 61 ) $rankhealth = '
  <div class="progress bg-dark water" style="height: 30px;">
  <div class="progress-bar bg-warning" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'% of cycle</div></div>';
  if ($health_percent >= 80 ) $rankhealth = '
  <div class="progress bg-dark water" style="height: 30px;">
  <div class="progress-bar bg-danger" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent_realvalue.'% of cycle</div></div>';
  return $rankhealth;
};




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
									// print $health;
									print '
                  
                  
                      <div class="card water">
                        <div class="card-body ">
                            <h6 class="card-subtitle mb-2 text-muted">Water Cycle</h6>
                              '.$health.'
                        </div>
                      </div>  
                  
                  
                   ';
									// print intval($waterchange_percent);		
									// print "%";							
									// print '<td>Change</td><td>'.$health.'</td><td>'.$waterchangeresult.'</td><td>'.$watercalc.'</td><td><input class="form-control" name="threshhold" value="'.$waterchange_threshold.'"></td><tr></tr>'; //etc...
								};
?>
