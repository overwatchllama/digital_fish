<?php
include "connection.php";
include "nav.php";
$getid = $_GET['id'];


$stmt = $db->query("SELECT * FROM digitalfish.ledim_name WHERE id='$getid';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$name = $row['name'];
};



?>
<style type="text/css">
	input {
		min-width: 50px !important;*/
		/*max-height: 30px !important;*/
	}
</style>

<div class="container">
<?php
$stmt = $db->query('SELECT phase FROM digitalfish.sched;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$currentphase = $row['phase'];
};
?>
<p><font style="font-size: 2.5em !important; float:left;">LDD: <?php print $name; ?></font><font style="font-size: 1.5em !important; float:right;">Current Phase: <?php print ucfirst($currentphase);?></font></p><br><br>


<?php


print '<form action="submit.php" method="POST">';
print '<input name="option" value="ledim" hidden>';

 $stmt = $db->query("SELECT * FROM digitalfish.ledim WHERE ledim_name_id='$getid' LIMIT 1;"); 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $channelmaster = $row['channel'];
        if ($channelmaster==0) {$selected0="selected";};
        if ($channelmaster==1) {$selected1="selected";};
        if ($channelmaster==2) {$selected2="selected";};
        if ($channelmaster==3) {$selected3="selected";};
        if ($channelmaster==4) {$selected4="selected";};
        if ($channelmaster==5) {$selected5="selected";};
        if ($channelmaster==6) {$selected6="selected";};
        if ($channelmaster==7) {$selected7="selected";};
        if ($channelmaster==8) {$selected8="selected";};
        if ($channelmaster==9) {$selected9="selected";};
        if ($channelmaster==10) {$selected10="selected";};
        if ($channelmaster==11) {$selected11="selected";};
        if ($channelmaster==12) {$selected12="selected";};
        if ($channelmaster==13) {$selected13="selected";};
        if ($channelmaster==14) {$selected14="selected";};
        if ($channelmaster==15) {$selected15="selected";};


        $stmtc = $db->query("SELECT * FROM digitalfish.ledim_name WHERE id<>'$getid';");
    
 print '<hr>';
 print '<label><strong>COPY SETTINGS TO:</strong></label>&nbsp&nbsp';
    while($rowc = $stmtc->fetch(PDO::FETCH_ASSOC)) {

        $nameofchannel = $rowc['name'];

    $applyto = $rowc['id'];

    print '<div class="card " style="display:inline-table;padding: 10px; margin:5px;background:#e6eeff;">'.$nameofchannel.'<input name="applyto[]" type=checkbox value="'.$applyto.'" style="height:20px;padding-top:15px"></div>';
        };


print '<hr>';
        
        $automaster = $row['auto'];
        if ($automaster==1) {$selectedauto1="selected";$selectedauto0='';} else {$selectedauto1=''; $selectedauto0='selected';};
        print '<table>';
        print '<td>Name</td><td><input class="form-control" name="name" value="'.$name.'"></td>';
        print '<td>Automatic</td>
        <td>
        <select class="form-control" name="automaster">
            <option value="0"'.$selectedauto0.'>No</option>
            <option value="1"'.$selectedauto1.'>Yes</option>
        
        </td>';
        print '<td>Channel</td>
        <td>
        <select name="channelmaster" class="form-control">
            <option value="0" '.$selected0.'>0</option>
            <option value="1" '.$selected1.'>1</option>
            <option value="2" '.$selected2.'>2</option>
            <option value="3" '.$selected3.'>3</option>
            <option value="4" '.$selected4.'>4</option>
            <option value="5" '.$selected5.'>5</option>
            <option value="6" '.$selected6.' >6</option>
            <option value="7" '.$selected7.' >7</option>
            <option value="8" '.$selected8.' >8</option>
            <option value="9" '.$selected9.' >9</option>
            <option value="1" '.$selected10.' >10</option>
            <option value="11" '.$selected11.' >11</option>
            <option value="12" '.$selected12.' >12</option>
            <option value="13" '.$selected13.' >13</option>
            <option value="14" '.$selected14.' >14</option>
            <option value="15" '.$selected15.' >15</option>
        </select>
        
        </td>';
        print '</table>';

    };

print '<div class="alert alert-warning" role="alert">Start, End & Manual Accept values between 0-4096(Max)</div>';

    $stmt = $db->query("SELECT * FROM digitalfish.ledim WHERE ledim_name_id='$getid';"); 
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

print '<div class="row" style="min-height:75px;border: solid 1px #cdcdcd; border-radius:5px; margin-right: 2px; margin-left: 2px;margin-top:8px; padding:0px;">';

        $id = $row['id'];
        $ledim_name_id = $row['ledim_name_id'];
        $start = $row['start'];
        $end = $row['end'];
        $speed = $row['speed'];
        $speed = abs($speed)          ;
            if ($speed == '1') {$v1='selected';}else { $v1='';};
            if ($speed == '2') {$v2='selected';}else { $v2='';};
            if ($speed == '3') {$v3='selected';}else { $v3='';};
            if ($speed == '4') {$v4='selected';}else { $v4='';};
            if ($speed == '5') {$v5='selected';}else { $v5='';};

        $state = $row['state'];
            if ($state==1){$statemessage='<i class="fas fa-check-square"></i>';} else {$statemessage='';};
        $phase = $row['phase'];
        $channel = $row['channel'];
        $auto = $row['auto'];
        $manual = $row['manual'];
        print ' 
            <div class="col-sm-1 bg-dark" style="padding-top:1.2%; color:white; border-top-left-radius:5px; border-bottom-left-radius:5px;">
            '.ucfirst($phase).'<br>'.$statemessage.'
            </div>
            
            <div class="col-sm-2">
            <strong>Dim Speed</strong><br>
                <select class="form-control" name="speed[]">
                <option value="1" '.$v1.'>1 : Slowest </option>
                <option value="2" '.$v2.'>2 : Slow </option>
                <option value="3" '.$v3.'>3 : Medium </option>
                <option value="4" '.$v4.'>4 : Fast </option>
                <option value="5" '.$v5.'>5 : Fastest </option>
                </select>
            </div>

       
          <input name="id[]" value='.$id.' hidden>
          <input name="ledim_name_id[]" value='.$ledim_name_id.' hidden>    
    ';

    print '
    <div class="col-sm-6">
        <div class="slidecontainer">
            <input type="range" min="1" max="4096" value="'.$end.'" class="slider" id="sunrise-input'.$id.'" name="end[]" style="margin-top:20px;">
            Value: <span id="sunrise-output'.$id.'" style="background-color: white;"></span>
            Percent: <strong><span id="outputpercent'.$id.'" style="background-color: white;"></span>%</strong>
        </div>
    </div>

     <div class="col-sm-2">
          <strong>Manual</strong>
          <input class="form-control" name="manual[]" value='.$manual.'> (4096 max)
        </div>

<script>
        var sunrise'.$id.' = document.getElementById("sunrise-input'.$id.'");
        var output'.$id.' = document.getElementById("sunrise-output'.$id.'");
        var outputpercent'.$id.'= document.getElementById("outputpercent'.$id.'");
        output'.$id.'.innerHTML = sunrise'.$id.'.value;
        outputpercent'.$id.'.innerHTML = Math.round(sunrise'.$id.'.value  * 100 / 4096);
        sunrise'.$id.'.oninput = function() {
        output'.$id.'.innerHTML = this.value;
        outputpercent'.$id.'.innerHTML = Math.round(this.value * 100 / 4096); }
</script>';

print '</div>';
    };
 


    
    // print $ledarray_name[0];
    # code...

print '<br><button class="btn btn-success" type="submit">Save</button>';
print '</form>';
?>
<br>
</div>
<style>
.slidecontainer {
    width: 100%; /* Width of the outside container */
}

/* The slider itself */
.slider {
    -webkit-appearance: none;  /* Override default CSS styles */
    appearance: none;
    width: 100%; /* Full-width */
    height: 25px; /* Specified height */
    background: #d3d3d3; /* Grey background */
    outline: none; /* Remove outline */
    opacity: 0.7; /* Set transparency (for mouse-over effects on hover) */
    -webkit-transition: .2s; /* 0.2 seconds transition on hover */
    transition: opacity .2s;
}

/* Mouse-over effects */
.slider:hover {
    opacity: 1; /* Fully shown on mouse-over */
}

/* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */ 
.slider::-webkit-slider-thumb {
    -webkit-appearance: none; /* Override default look */
    appearance: none;
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}

.slider::-moz-range-thumb {
    width: 25px; /* Set a specific slider handle width */
    height: 25px; /* Slider handle height */
    background: #4CAF50; /* Green background */
    cursor: pointer; /* Cursor on hover */
}
</style>


<style>
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}
</style>

