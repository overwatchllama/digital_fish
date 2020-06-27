

<link rel="stylesheet" type="text/css" href="css/style.css">

<style type="text/css">

</style>
<?php
include "connection.php";
$stmt = $db->query("SELECT * FROM codes where code='thermtype';");
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $thermtype = $row['state'];
                                    };
?>

<div class="container">
    <div align="center">       
        <div><h1 class="headinds">DOSING</h1></div>
        
            <div class="nested_table">    
                <form action="submit.php" method="post">
                <input name="option" value="doseadd" hidden>
                    <table class="table table-bordered " >
                        <th class="thcolorlevel1" colspan="4">Add Dosing Relay</th><tr></tr>
                        <th class="">Dose Relay (Chemical) Name</th>
                        <th class="" width="95px">GPIO</th><th width="95px">Polarity</th><th width="95px">Enable</th><tr></tr>
                        <td><input class="form-control" type="text" name="relayname" required=""></td>
                        <td ><input class="form-control" type="number" name="gpio" placeholder="#" required="" ></td>
                        <td>
                            <select name="polarity" class="form-control" required="">
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                            <!-- <input class="form-control" type="number" name="polarity" placeholder="0 or 1" required=""> -->
                        </td>
                        <td>
                            <select name="state" class="form-control" required="">
                                <option value="0">Off</option>
                                <option value="1">On</option>
                            </select>
                            <!-- <input class="form-control" type="number" name="state" placeholder="0 or 1" required=""> -->
                        </td><tr></tr>
                        <td colspan="4"><button type="submit" class="btn">Add</button></td>
                        <tr><td colspan="4">
                        	Millitres per second can be calibrated once the relays has been added.
                        </td></tr>
                    </table>
                </form>
            </div>

        <!-- <div align="center"> -->
        	<!-- <div style="max-width: 800px;"> -->
        <div class="item">
            <a data-toggle="collapse" data-parent="#exampleAccordion" href="#exampleAccordion2" aria-expanded="false" aria-controls="exampleAccordion2">
              <button class="btn btn-warning">Click For Help on How to Calibrate</button>
            </a>
            <div id="exampleAccordion2" class="collapse" role="tabpanel">
              <div align="left">
              <p class="mb-3">
                <p><Strong>Add your relays first, at least one before trying to run calibration.</Strong></p>
                <p><strong>DO NOT CALIBRATE INTO YOUR TANK !!!! Caliibrate into a meassuring beaker for ml(millilitres)</strong></p>
                <p>Since you have to calibrate each relay, it's easier to add all the relays you intend to use first and then calibrate them via the command line calibration tool.</p>
                <p>The tool does allow you to configure others later, or re-configure existing dose relays. YOU CANNOT enter the millitres per second value via the webpage, this can ONLY be done via the tool.  This is for safety.</p>
                <p><Strong>The reason you have to run a calibration tool first, is to determine exactly how much your dose pump dispenses in (ml) per second.  From this we are work out how much time it would take in seconds to dispense X(ml).</Strong></p>
                <p>HOW TO CALIBRATE</p>
                <p>Calibration effectively figures out your ml per second, this will allow you to create percise dispenses.</p>
                <p>Goto your raspberry pi command line and navigate to the following foolder  by typing in <strong>cd /var/www/html/pycode</strong></p> then type in the following command to calibrate relays added. <strong>python dose-calibrate.py</strong> follow the instructions there, and then your done.</p>
                <p>Naturally once you have added all your relays here, you can use the calibration tool to test them at the same time.</p>
          <!-- </div> -->
            </div>
            </div>
        </div>
    </div>
    <br>
</div>
<br>
</div>
<div class="container">
<div><h1 class="subheadinds">SCHEDULEABLE RELAYS</h1></div>
<?php

$stmt = $db->query('SELECT * FROM relay_dose;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$description = $row['description'];
$polarity = $row['polarity'];
$gpio = $row['gpio'];
$mls = $row['mls'];
$state = $row['state'];
$id = $row['id'];
if ($state == 1) {$state_print="On"; $tdclass="";} else {$state_print="Off";$tdclass='style="background:red;color:white;"';};

$relayedit = '<div style="float: right;"><a href="doserelayedit.php?id='.$id.'"><span class="glyphicon glyphicon glyphicon-cog
" aria-hidden="true"></span><font size="2">EDIT</font></a></div>';
print   '<div style="display:inline-table;margin: 10px;">';
print '
        <table class="table table-striped table-hover" >
            <tr><th = class="th-heading" colspan="4">'.$description.' '.$relayedit.'</th>
            <th><form action="doseedit.php" method="post">
                    <input name="option" value="'.$id.'" hidden>
                    <input name="description" value="'.$description.'" hidden>
                    <button  class="btn btn-success">+ Schedule</button>
                </form></th></tr>
            <tr><th>GPIO</th><th>POLARITY</th><th>MLS</th><th colspan="2" >Enabled</th></tr>
            <tr><td align="center">'.$gpio.'</td><td align="center">'.$polarity.'</td><td align="center">'.$mls.'</td><td colspan="2" '.$tdclass.'>'.$state_print.'</td></tr>
            </div>
        </table>
        </div>
        ';

};


?>
</div>
<br>
</div>

<div class="container">

<div><h1 class="subheadinds">CALENDAR SCHEDULE</h1></div>
<?php
// Create arrrays
$time = array();
$description = array();
$seconds = array();
$days = array(0,1,2,3,4,5,6);
$dosecompleted = array();
$mlsarray = array();
// Create arrays - END

// Start of Main Foreach Loop
foreach ($days as $key => $value) {
        # code...
    // print "hello";
    print '<table class="table table-bordered table-hover"><thead>';

    $stmt = $db->query("SELECT polarity,state,gpio,day,time,seconds,description,dosecompleted,mls 
    from relay_dose 
    INNER JOIN relay_dose_sched 
    ON relay_dose.id = relay_dose_sched.relay_dose_id
    WHERE day=$value ORDER BY day;");
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                                            
                                            array_push($time, $row['time']);
                                            array_push($description, $row['description']);
                                            array_push($seconds, $row['seconds']);
                                            array_push($dosecompleted, $row['dosecompleted']);
                                            array_push($mlsarray, $row['mls']);
                                            
                                            };
                                            
     
    switch ($value) {
                                                        case 1:$dayprint = "Monday";break;
                                                        case 2:$dayprint = "Tuesday";break;
                                                        case 3:$dayprint = "Wednesday";break;
                                                        case 4:$dayprint = "Thursday";break;
                                                        case 5:$dayprint = "Friday";break;
                                                        case 6:$dayprint = "Saturday";break;
                                                        case 0:$dayprint = "Sunday";break;
                                                    };

    print '<tr><th colspan="4"class="thcolorlevel1">'.$dayprint.'</th></tr>';
    print '<tr><th>Additive</th><th>Dispense Time</th><th>Period (sec)</th><th>Dose Completed</th></tr></thead>';

    // Segment builds tables in each day
    
    foreach ($time as $key => $value) {
        $desc = ($description[''.$key.'']);
        $mls = ($mlsarray[''.$key.'']);
        $dosetime = ($time[''.$key.'']);    # code...
        $doseseconds = ($seconds[''.$key.'']);    # code...
        $dosecompletedcount = ($dosecompleted[''.$key.'']);
        if ($dosecompletedcount == 1)  {$dosecompletedcount="Completed";$style = 'style="background: lightgreen;"';} 
        	else {$dosecompletedcount ="Pending";$style = 'style="background: lightyellow;"';};
        $mlsanswer = $mls * $doseseconds;
        $mlsanswer = round($mlsanswer,2);
        print '<tr><td>'.$desc .'</td><td>'. $dosetime.'</td><td>'.$doseseconds." = ".$mlsanswer.'(ml)</td><td '.$style.'>'.$dosecompletedcount.'</td></tr>';
        };
    // Segment builds tables in each day - END

    print '<br>';
    //clean arrays
    $time = array();
    $description = array();
    $seconds = array();
    $dosecompleted = array();
    $mlsarray = array();
    //clean arrays - END
    print '</table>';
};  
// END of Main Foreach Loop

?>

<br>
</div>

</div>

</div>

