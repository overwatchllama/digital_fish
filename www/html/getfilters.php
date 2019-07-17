
   <?php
   include "connection.php";

function barhealth($health_percent) {

  $health_percent_realvalue = intval($health_percent);
  $health_percent = intval($health_percent);
  if ($health_percent >= 100) {$health_percent = 100;};
  if ($health_percent >= 0  ) $rankhealth = '<div class="progress bg-dark" style="height: 30px;"><div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%"></div><div style="width:100%;color: white; padding-top:3px;">'.$health_percent.'%</div></div>';
  if ($health_percent >= 20 ) $rankhealth = '<div class="progress bg-dark" style="height: 30px;"><div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
  if ($health_percent >= 50 ) $rankhealth = '<div class="progress bg-dark" style="height: 30px;"><div class="progress-bar bg-info" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
  if ($health_percent >= 61 ) $rankhealth = '<div class="progress bg-dark" style="height: 30px;"><div class="progress-bar bg-warning" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
  if ($health_percent >= 80 ) $rankhealth = '<div class="progress bg-dark" style="height: 30px;"><div class="progress-bar bg-danger" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent_realvalue.'%</div></div>';
  
  return $rankhealth;
};


?>
<div align="center">
<?php

           $stmt = $db->query('SELECT * FROM digitalfish.filter;');
               while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   $shortname = $row['shortname'];
                  $stmt2 = $db->query("SELECT DATEDIFF((SELECT dateset from digitalfish.filter WHERE filter.shortname='$shortname' ORDER BY ID DESC LIMIT 1), NOW()) AS daysdiff");
                           while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                   $datediffsql = $row2['daysdiff'];};
                   
                   $expiry = $row['expiry'];   $expiry = intval($expiry);
                   $datediffsql = abs($datediffsql);
                   $calculation = $datediffsql * 100 / $expiry;
                   $daysleft = $expiry - $datediffsql;
                   if ($daysleft < 0) {$daysleft = 0;};
                   $daysover = $datediffsql - $expiry;
                   if ($daysover < 0) {$daysover = 0;};
                   $health = barhealth($calculation);                                 
                   
                   print '

                   <div style="display:inline-table">
                   <div class="card" style="width: 9rem;">
                    <div class="card-body">
                      <h6 class="card-subtitle mb-2 text-muted">'.$shortname.'</h6>
                      '.$health.'
                    </div>
                  </div>
                  </div>
                   ';
               };
               
       ?>
     </div>