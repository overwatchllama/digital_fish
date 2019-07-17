    <?php

        include "connection.php";
        include "globals.php";
    ?>

    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
  <script type="text/javascript" src="lib/jquery.timepicker.js"></script>
  <link rel="stylesheet" type="text/css" href="lib/jquery.timepicker.css" />
  <!-- <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script> -->
  <!-- <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css" /> -->
  <!-- <script type="text/javascript" src="lib/site.js"></script> -->
  <!-- <link rel="stylesheet" type="text/css" href="lib/site.css" /> -->

<div class="container">
    <h1 class="headinds">PHASE LENGTHS CONFIG</h1>
<?php
// global $saved;
// global $recordadded;

// if (empty($_GET)) {;} else {
// $savedstatus=$_GET['savedstatus'];
// $recordadded=$_GET['recordadded'];
// if ($savedstatus ==1) {$saved = " Saved";} else {;};
// if ($recordadded ==1) {$recordadded = " Added";} else {;};
// };

$collect_chem = array();
$stmt = $db->query('SELECT * FROM digitalfish.sched;');
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($collect_chem, $row['id']);
      };

function chembuild(){   
    global $special_form;
    global $stmt;
    global $db;
   
    print '<form action="submit.php" method="POST"><input name="option" value="phase_edit" hidden>';
    print '';
    $stmt = $db->query('SELECT * FROM digitalfish.sched;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $id = $row['id'];
            print ''.
'<td>Sunrise</td><td><input id="timeselect1" class="form-control" name="sunrise_start" value='.$row['sunrise_start'].'><td><input  id="timeselect2" class="form-control" name="sunrise_end" value='.$row['sunrise_end'].'><tr></tr>'.

'<td>Morning</td><td><input id="timeselect4" class="form-control" name="morning_start" value='.$row['morning_start'].'><td><input id="timeselect5" class="form-control" name="morning_end" value='.$row['morning_end'].'><tr></tr>'.

'<td>Daytime</td><td><input id="timeselect6" class="form-control" name="daytime_start" value='.$row['daytime_start'].'><td><input id="timeselect7" class="form-control" name="daytime_end" value='.$row['daytime_end'].'><tr></tr>'.

'<td>Afternoon</td><td><input id="timeselect8" class="form-control" name="afternoon_start" value='.$row['afternoon_start'].'><td><input id="timeselect9" class="form-control" name="afternoon_end" value='.$row['afternoon_end'].'><tr></tr>'.

'<td>Sunset</td><td><input id="timeselect10" class="form-control" name="sunset_start" value='.$row['sunset_start'].'><td><input id="timeselect11" class="form-control" name="sunset_end" value='.$row['sunset_end'].'><tr></tr>'.

'<td>Night</td><td><input id="timeselect3" class="form-control" name="night_start" value='.$row['night_start'].'><td><input id="timeselect12" class="form-control" name="night_end" value='.$row['night_end'].'><tr></tr>'.

'<td>No Light</td><td><input id="timeselect13" class="form-control" name="nolight_start" value='.$row['nolight_start'].'><td><input class="form-control" name="nolight_end" value='.$row['sunrise_start'].' disabled><tr></tr>'
.'';
  
                   
             print '<tr></tr>';
             
          };
          
          print '<td colspan="4"><div style="float:right;"><button class="btn btn-success">Save Changes</button></div></td>';
          
         


            return;
    }
?>

<div  align="center">
    <table class="table table-bordered relaytbl softbox">

</div></th><tr></tr>
                <!-- <th>id</th> --><th>Phase</th><th>Start</th><th>End</th><tr></tr>
        
        <?php 
       
                chembuild();    # code...
       
        ?>
    </table>
</div>

</div>


<script>
      $(function() {
        $('#timeselect1').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect2').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect3').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect4').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect5').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect6').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect7').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect8').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect9').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect10').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect11').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect12').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        $('#timeselect13').timepicker({ 'timeFormat': 'H:i', 'step': 1 });
        
      });
    </script>
