<!DOCTYPE html>
<html>
<head>
    <title>
        DigitalFish
    </title>
    <?php
        // include "nav.php";
        include "connection.php";
    ?>
    <!-- <link href="css/custom.css" rel="stylesheet"> -->
    

</head>
<body>
<?php
global $saved;
global $recordadded;

if (empty($_GET)) {;} else {

$savedstatus=$_GET['savedstatus'];
$recordadded=$_GET['recordadded'];
if ($savedstatus ==1) {$saved = " Saved";} else {;};
if ($recordadded ==1) {$recordadded = " Added";} else {;};
if ($recordadded ==2) {$recorddeleted = " Record Deleted"; $recordadded='';} else {;};



};

?>

<div class="container">

<!-- ******************************** -->
<!-- BEGIN MODAL ADD FIELDS -->
<div><h1 class="headinds">Therm Sensor</h1></div>
    <p><div class="btn-group" role="group" aria-label="">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Add</button>
        <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete Filter</button>
    </div>
</p>

<!-- ******************************** -->







<?php





           $collect_therm = array();
            $stmt = $db->query('SELECT * FROM digitalfish.thermconfig;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        array_push($collect_therm, $row['id']);
                                       };

function thermbuild($saved){   
    global $special_form;
    global $stmt;
    global $db;
    global $recorddeleted;
    global $registeredtherm;
   
    print '<form action="submit.php" method="POST"><input name="option" value="thermedit" hidden>';
    print '';
    $registeredtherm = array();
    $stmt = $db->query('SELECT * FROM digitalfish.thermconfig;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $id = $row['id'];
             $registered = $row['serialnumber'];
             array_push($registeredtherm, $registered);
             print '<td>
             '.$row['id'];
             print '<input name="id[]" value='.$id.' hidden>';
             print '<td><input class="form-control" type="" name="sensorname[]" value="'.$row['sensorname'].'">';
             print '<td><input class="form-control"  type="" name="serialnumber[]" value="'.$row['serialnumber'].'">';
             print '<tr></tr>';
             
          };
          
          print '<td colspan="4"><button class="btn btn-success" style="float: right;">Save Changes</button>'.$saved.''.$recorddeleted.'';
          
          print '</form>';
        


            return;
    }
?>

<div  align="center">
    <table class="table table-bordered relaytbl softbox">
                <th class="th-heading" colspan="6"><div style="float: left;">Edit Therm Types</div><div style="float: right;"><a href="temperature.php"<span class="glyphicon glyphicon glyphicon-arrow-left

" aria-hidden="true" title="Therm Graphs"></span></a>
</div></th><tr></tr>
                <!-- <th>id</th> --><th>Record ID</th><th>therm</th><th>serialnumber</th><tr></tr>
        
        <?php 
       
                thermbuild($saved);    # code...
       
        ?>
    </table>

<?php
   $stmt = $db->query('SELECT * FROM codes where code = "thermtype";');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $check=$row['state'];      
      if ($check=='0'){ $selected_c="selected='selected'";} else {$selected_c="";};
      };
      ?>





<table class="table table-bordered relaytbl softbox">
<form action="submit.php" method="POST">
<input name="option" value="thermset" hidden>
<th class="th-heading" colspan="3">Set Global Therm Type</th><tr></tr>
<td width="200"><select name="thermtype" class="form-control">
  <option <?php print $selected_c; ?> value="1">Celcius</option>
  <option <?php print $selected_c; ?> value="0">Farenheit</option>
</select>
</td>
<td><button type="submit">Set</button></td>
</form>
</table>

<table class="table table-bordered relaytbl softbox">
<form action="submit.php" method="POST">
<input name="option" value="thermdrop" hidden>
<th class="th-heading" colspan="3">FLUSH ALL THERM RECORDS</th><tr></tr>
<td width="">
  This will empty all hostoric therm data and start from fresh.  Naturall you will need to wait for a few records to populate before they are visible in the Therm sections.
  Current record total = 
  <?php
  $stmt = $db->query("SELECT COUNT(*) from thermlog;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { print '<strong>'.$row['COUNT(*)'].'</strong>';};
print ' Over ';
  $stmt = $db->query("SELECT DATEDIFF (NOW(),(SELECT dateset FROM thermlog ORDER BY ID ASC LIMIT 1)) as results;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { print '<strong>'.$row['results'].'</strong>';};


  ?>
&nbspDays as a total period of record collection.

</td>
<td><button type="submit">YES - Drop All Therm Records</button></td>
</form>
</table>


<?php






?>




        <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Therm Sensor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
  <?php

                print '<h5>The Following Sensors Were Detected</h5>';

$files = array_slice(scandir('/sys/bus/w1/devices/'), 2);
array_pop($files);

foreach ($files as $key => $value) {  
  if (in_array($value, $registeredtherm)) {print '<font style="color:red;">*USED*</font> ';} else {;};
  if ( substr( $value, 0, 1 ) == 0 ) {;} else {
  print '<strong>Serial:</strong> '.$value.'<br>';};
  # code...
};?>
        <form action="submit.php" method="POST">
                <!-- SET -->
              <input name="option" value="addtherm" hidden>
                <table width="100%">
                  <tr><td>Sensor Name</td><td><input class="form-control" name="sensorname" required></td></tr>
                  <tr><td>Serial Number</td><td><input class="form-control" name="serialnumber" required></td></tr>
                </table>
              </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        
    </div>
    </div>
    </div>
  

<!-- END MODAL ADD FIELDS -->


<!-- 1234412343214 -->

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete A Relay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
<form action="submit.php" method="POST">
    <input name="option" value="deletetherm" hidden>

<h6 class="text-left">Select Relay To Delete</h6></h6><select name="id" class="form-control">
<?php
$stmt = $db->query("SELECT * FROM digitalfish.thermconfig;");
        
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $name = $row['sensorname'];
                $serialnumber = $row['serialnumber'];
                print '<option value='.$id.'>'.$name.' : '.$serialnumber.'</option>';
            };

?>
</select>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-danger">Delete Filter</buttton>
</form>
      </div>
    </div>
  </div>
</div>




</div>

</body>
</html>