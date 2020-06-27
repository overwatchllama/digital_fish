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
</head>
<body>
<div class="container">
  <div><h1 class="headinds">SERVICES</h1></div>


<!-- <form> -->
<p><input type="button" class="btn btn-success" onClick="history.go(0)" VALUE="Refresh Now"></p>
<!-- </form> -->
  <h3 class="headinds">SERVICE STATUS</h3>
  <?php
    exec('systemctl list-units --type=service | grep Jay ',$output);
    // print '<pre>';
    // print_r($output);
    // print '</pre>';
    print '<table class="table">';
    // print_r($output);
    foreach ($output as $key => $value) {
      print '<strong>';
      $value = str_replace("loaded active running DigitalFish", "<td><font style='padding-left: 5px; padding-right: 5px;color:white; background: green;'>ACTIVE</font></td>", $value);
      $value = str_replace("loaded failed", "<td><font style='padding-left: 5px; padding-right: 5px;color:white; background: red;'>FAILED</font></td>", $value);
      
      $value = str_replace(" ATO", "", $value);
      $value = str_replace(" Doser", "", $value);
      $value = str_replace(" Feeder", "", $value);
      $value = str_replace(" Manual Relay", "", $value);
      $value = str_replace(" SChedule Check", "", $value);
      $value = str_replace(" Therm Check", "", $value);
      $value = str_replace(" Wave-A", "", $value);
      $value = str_replace(" Wave-B", "", $value);


      print '<td>'.$value . '</td></tr>';
      print '</strong>';
      # code...
    }
    print '</table>';

  ?>
  <br>
<h3 class="headinds">MANAGING SERVICES</h3>
<ol>
<li>
  Simply break to the command line on the raspberry pi and type in <strong>sudo systemctl stop xxxx</strong> where xxxx = schedulecheck.service ( or which ever service you wish to stop.)
</li>
<li>
  to Start the service again do the opposite. <strong>sudo systemctl start xxxx</strong>
</li>
<li>
  And if you wish to validate services stopped or started at the command prompt type in <strong>sudo systemctl list-units --type=service | grep DigitalFish</strong>
</li>
</ol>
<br>
</div>
