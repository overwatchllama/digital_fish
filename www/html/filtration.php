    <?php
    include "connection.php";
    ?>
    
 <!--    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style> -->

    <style type="text/css">
        .progress {
            height: 30px !important;
            /*font-size: 0.8em !important;*/
            background-color: #555555;
        }
    .table {
        /*max-width: 90%;*/
        /*margin-top: 1%;*/

    }
      
    </style>

<body>
<!-- <div align="center">
    <div class="card mb-3">
        <div class="card-header">
                <h3>Filtration</h3>
        </div>
 -->
<div class="container">

<!-- BEGIN MODAL ADD FIELDS -->
<div><h1 class="headinds">FILTRATION Or Lifespan</h1></div>
    <p><div class="btn-group" role="group" aria-label="">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Add</button>
        <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#deleteFilter">Delete Filter</button>
    </div>
</p>
        <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <div class="modal-body">
        <form action="submit.php" method="POST">
                <!-- SET -->
              <input name="option" value="addfilter" hidden>
                <table width="100%">
                  <tr><td>Filter Name</td><td><input class="form-control" name="fname" required></td></tr>
                  <tr><td>Filter Description</td><td><input class="form-control" name="fdesc" required></td></tr>
                  <tr><td>Expiry Period in Days</td><td><input class="form-control" name="fperiod" required></td></tr>
                  
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

<div class="modal fade" id="deleteFilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    <input name="option" value="deletefilter" hidden>

<h6 class="text-left">Select Relay To Delete</h6></h6><select name="deleteid" class="form-control">
<?php
$stmt = $db->query("SELECT * FROM digitalfish.filter;");
        
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $name = $row['shortname'];
                print '<option value='.$id.'>'.$name.'</option>';
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

<!-- 134123423412 -->






 <!-- <div class="card pad10">           -->
            <table class="table table-bordered">
            <tr><th colspan="6" class="thcolorlevel1"><div style="float: left;">Filter Maintenance</div></th></tr>
            <tr><th class="thcolorlevel2">Shortname</th class="thcolorlevel2"><th class="thcolorlevel2">Description</th class="thcolorlevel2"><th class="thcolorlevel2">Last Action</th class="thcolorlevel2"><th class="thcolorlevel2">Date</th class="thcolorlevel2"><th class="thcolorlevel2">Time</th class="thcolorlevel2"><th class="thcolorlevel2">Tasks</th class="thcolorlevel2"></tr>
            
            
                    <?php
                    print '<form action="submit.php" method="post">';
                    include "connection.php";
                    global $collect_id;
                    $collect_id = array();
                    $stmt = $db->query('SELECT * FROM digitalfish.filter;');
                                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $id = $row['id'];
                            $shortname = $row['shortname'];
                            $description= $row['description'];
                            array_push($collect_id, $id);

                    $stmt2 = $db->query('SELECT * FROM event WHERE filterid='.$id.' ORDER BY id DESC LIMIT 1;');
                                                        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {


                                        $id2 = $row2['filterid'];
                                        $dateset = $row2['dateset'];
                                        $formatdate = strtotime($dateset);
                                        $formatdate= date("F j, Y",$formatdate);
                                        $timeset = $row2['timeset'];
                                        $lastvalue = $row2['value'];
                                    };

                            print '<tr><td>'. $shortname . '</td><td>'. $description . '</td><td>' . $lastvalue . '</td><td>'.$formatdate.'</td><td> '.$timeset .'</td>';
                            print '<td><input name="option" value="filteraction" hidden>
                            <select class="form-control" name="form'.$id.'">
                            <option name="None">None</option>
                            <option name="Clean">Clean</option>
                            <option name="Replace">Replace</option>
                            <option name="Renew">Renew</option>
                            </select></td></tr>';
                            $id2="";
                            $dateset="";
                            $timeset="";
                            $lastvalue="";
                                                            
                    };

                    $collect_id = implode(',', $collect_id);
                    print '
                    <td align="right" colspan="6"><button class="btn btn-success" type="submit">Save New Tasks</button</td><tr>
                        <input name="filtervalues" value="'.$collect_id.'" hidden>
                       </form>
                   </table>   
                   ';

                    ?>

                                         


                    <?php
                    // $collect = array();
                    ?>
 <?php 
function barhealth($health_percent) {

  $health_percent_realvalue = intval($health_percent);
  $health_percent = intval($health_percent);
  if ($health_percent >= 100) {$health_percent = 100;};
  if ($health_percent >= 0  ) $rankhealth = '<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%">&nbsp'.$health_percent.'%</div></div>';
  if ($health_percent >= 20 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
  if ($health_percent >= 50 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-info" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
  if ($health_percent >= 61 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-warning" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
  if ($health_percent >= 80 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent_realvalue.'%</div></div>';
  return $rankhealth;
};

                            ?>


                    


                                <!-- Filter status indicators -->
<div align="center"> -->

   <table class="table table-bordered">
   <th class="thcolorlevel1" colspan="6">Filter Status (days)</th><tr></tr>
       <th class="thcolorlevel2">Filter</th>
       <th class="thcolorlevel2">Cycle</th>
       <th class="thcolorlevel2">Expiry<br><div class="thsecondrow">period (days)</div></th>
       <th class="thcolorlevel2">Used<br><div class="thsecondrow">(days)</div></th>
       <th class="thcolorlevel2">Remaining<br><div class="thsecondrow">(days)</div></th>
       <th class="thcolorlevel2">Exceeding<br><div class="thsecondrow">(days)</div></th>
   <tr></tr>


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
                   // if ($calculation >= 99) { array_push($alerts, '<td>'.$row['shortname'].' Filter it\'s at </td><td>'.intval($calculation).'%</td><tr></tr>');};
                   print '<td>'.$row['shortname'].'</td><td><div align="center">'.$health.'</div></td><td>'.$expiry.'</td><td>'.$datediffsql.'</td><td>'.$daysleft.'</td><td>'.$daysover.'</td><tr></tr>';
               };
       ?>
   </table>

    <!-- </div> -->
<!-- </div> -->
<!-- </div> -->
<br>
</div>



</div>
 <!-- <script src="js/jquery.js"></script> -->


<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<script>
$(document).ready(function () {
    $('div.container').fadeIn(500);
    // OR $('div.toshow').show(2200);
    // OR $('div.toshow').slideDown("slow");
});
</script>