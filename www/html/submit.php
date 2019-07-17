<?php
include "connection.php";
include "nav.php";

$saving = '<div align="center"><div style="background-color: white; width:300px; border-radius:10px;"><div align="center" style="margin-top: 5%;"><img src="saving.gif"></div></div></div>';

$option = $_POST['option'];

if ($option == "flushatoyes") {

    $stmt = $db->query("DELETE FROM event WHERE event='ato';");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=atostats"/>';

 };


if ($option == "flushato") {
    print '<div class="container"><div align="center"><div class="maxcontent_width">';
    print "<h3>Drop All ATO Records</h3><p>You are about to flush all your ATO data are you sure.</p>";
    print '
    <form action="submit.php" method="POST">
    <input name="option" value="flushatoyes" hidden>
    <button class="btn btn-success" type="submit">YES</button>
    
    <a href="/index.php?page=atostats"><div class="btn btn-danger">NO</button></div></a>
    </form>';
    print '</div></div><br></div>';

};

if ($option=="adminaccount") {
    $username=$_POST['username'];
    $password=$_POST['password'];
   $stmt = $db->query("UPDATE users SET password='$password', email='$username' WHERE id=1;") ;
   print '<meta http-equiv="refresh" content="0;url=index.php?page=userconfig"/>';
};


if ($option =="ato") {
        $duration = $_POST['value'];
        $gpio = $_POST['gpio'];
        $ml = $_POST['ml'];
        $polarity = $_POST['polarity'];
        $switchgpio = $_POST['switchgpio'];
        $failswitchgpio = $_POST['failswitchgpio'];
        $resevoirgpio = $_POST['resevoirgpio'];
        $stmt = $db->query("UPDATE ato_relay SET value='$duration', gpio='$gpio', ml='$ml', polarity='$polarity', switchgpio='$switchgpio',failswitchgpio='$failswitchgpio', resevoirgpio='$resevoirgpio' WHERE id = '1';");
        print '<meta http-equiv="refresh" content="0;url=index.php?page=atoconfig"/>';   


};

 if ($option == "wavemakerset") {
        
        $waveagpio = $_POST['waveagpio'];
        $wavebgpio = $_POST['wavebgpio'];
        $waveapolarity = $_POST['waveapolarity'];
        $wavebpolarity = $_POST['wavebpolarity'];
        $stmt = $db->query("UPDATE relay_wave set gpio='$waveagpio', polarity='$waveapolarity' where id=1");
        $stmt = $db->query("UPDATE relay_wave set gpio='$wavebgpio', polarity='$wavebpolarity' where id=2");


        $count = array(1,2,3,4,5,6,7,8);
        foreach ($count as $key => $value) {
            // print $key;

        // if ($key==0) { print "";}
        //     else {
        $phase = $_POST['phase'.$key.''];
        print $phase;
        $pulsea = $_POST['wave_a_pulse'.$key.''];
        $resta = $_POST['wave_a_rest'.$key.''];
        $statea = $_POST['wave_a_state'.$key.''];
        $pulseb = $_POST['wave_b_pulse'.$key.''];
        $restb = $_POST['wave_b_rest'.$key.''];
        $stateb = $_POST['wave_b_state'.$key.''];
        $stmt = $db->query("UPDATE relay_wave_phase SET 
        wave_a_pulse='$pulsea', wave_a_rest='$resta', wave_a_state='$statea',wave_b_pulse='$pulseb', wave_b_rest='$restb', wave_b_state='$stateb'
        WHERE description='$phase'");
           // };
        };

        print '<meta http-equiv="refresh" content="0;url=index.php?page=wavemaker" />';

        };


 if ($option=='waterchange') {
    $threshhold = $_POST['threshhold'];
    $stmt = $db->query("UPDATE event SET value='$threshhold',event='waterchange', dateset=CURRENT_DATE(), timeset=CURRENT_TIME() WHERE event='waterchange';");
    $stmt = $db->query("INSERT into alert SET collection='rss', category='Maintenance', title='Water Change',message='Water Change Recorded';");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=waterchange" />';
    };


if ($option == "addtherm"){
    $sensorname = $_POST['sensorname'];
    $sensorname =preg_replace('/[^A-Za-z0-9\-]/', '', $sensorname);
    $serialnumber = $_POST['serialnumber'];
    $stmt = $db->query("INSERT INTO digitalfish.thermconfig SET sensorname='$sensorname', serialnumber='$serialnumber';");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=thermedit" />';
};


if ($option == "thermedit"){
    $id = $_POST['id'];
    $sensorname = $_POST['sensorname'];
    $serialnumber = $_POST['serialnumber'];
    foreach ($id as $key => $value) {
    $stmt = $db->query("UPDATE digitalfish.thermconfig SET sensorname='$sensorname[$key]', serialnumber='$serialnumber[$key]' WHERE id='$value';");
         };

print '<meta http-equiv="refresh" content="0;url=index.php?page=thermedit" />';
}

if ($option == "deletetherm"){
    $id = $_POST['id'];
    $stmt = $db->query("DELETE FROM digitalfish.thermconfig WHERE id='$id';");
print '<meta http-equiv="refresh" content="0;url=index.php?page=thermedit" />';
};

if ($option == "thermset"){
    $thermtype = $_POST['thermtype'];
    $stmt = $db->query("UPDATE digitalfish.codes set state='$thermtype' WHERE code='thermtype';");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=thermedit" />';
};


if ($option == "thermdrop"){
    $stmt = $db->query("TRUNCATE thermlog;");
    // print "<br><br><Br><div class=\"container\">Therm Drop (Still to do)</div>";
    print $saving;
    print '<meta http-equiv="refresh" content="2;url=index.php?page=thermedit" />';

};

if ($option == "chem_entry_delete") {
    // print '<div class="container">You are here</div>';

    $id = $_POST['del'];
    // print_r ($id);
    foreach ($id as $key => $value) {
        // print $value;
        $stmt = $db->query("DELETE FROM digitalfish.event WHERE id='$value';");
    };

    print '<meta http-equiv="refresh" content="0;url=index.php?page=chemtable" />';

};

if ($option == "chemreadsubmit") {
    // print '<div class="container">';
    
    $id = $_POST['id'];
    // print_r($id);
    $shortname = $_POST['shortname'];
    // print_r($shortname);
    $reading = $_POST['reading'];
    foreach ($id as $key => $value) {
        If ($reading[$key]=='') {;} else {
        $id_data = $id[$key];
        $reading_data = $reading[$key];
        $shortname_data = $shortname[$key];
        print $shortname[$key];
        print $shortname_data;
        $stmt = $db->query("INSERT INTO event SET event='$shortname_data', value='$reading_data', chemid='$id_data', dateset=CURRENT_DATE, timeset=CURRENT_TIME;");
        };
    
    };
print '<meta http-equiv="refresh" content="0;url=index.php?page=chemread"/>';
     
};


    if ($option == "chem_value_add") {
        // print $_POST['New_Chem'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $stmt = $db->query("SELECT * FROM chem");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $shortname = $row['shortname'];
            $strip = str_replace(" ", "_", $shortname);
            $value = $_POST["$strip"];
            // print $shortname . " Value: " . $value . ' time:'.$time.'<br>';
            if (empty($value)) {
;
            } else {
                $stmta = $db->query("INSERT INTO event SET event = '$shortname', value='$value',chemid='$id', dateset='$date', timeset = '$time';");
            }; // 
        };
        print '<meta http-equiv="refresh" content="0;url=chemistry.php"/>';
        // print 'Troubleshooting mode';
    };


 if ($option == "addchemical"){
        $shortname = $_POST['shortname'];
        $description = $_POST['description'];
        $measurement = $_POST['measurement'];
        $stmt = $db->query("INSERT INTO digitalfish.chem (shortname, description, measurement) VALUES ('$shortname', '$description', '$measurement');");
        $stmt = $db->query("SELECT * FROM digitalfish.chem WHERE shortname='$shortname';");
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            global $id;
                                            $id = $row['id'];
                                            // print 'kk'.$id;
                                           };

        $stmt = $db->query("INSERT INTO digitalfish.event (event, value, chemid,dateset,timeset) VALUES ('$shortname', 'Added', '$id',CURRENT_DATE, CURRENT_TIME);");
        print '<meta http-equiv="refresh" content="0;url=index.php?page=chemedit" />';
        print "???";
        };


  if ($option == "chem_delete"){
        $id = $_POST['deleteid'];
        
        $stmt = $db->query("DELETE FROM digitalfish.chem WHERE id=$id;");
        $stmt = $db->query("DELETE FROM digitalfish.event WHERE chemid=$id;");
        print '<meta http-equiv="refresh" content="0;url=index.php?page=chemedit" />';
        };




  if ($option == "chemedit"){
        // print "Chemical Edit - Commit Changes";
        $collect_chem = array();
                $stmt = $db->query('SELECT * FROM digitalfish.chem;');
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            array_push($collect_chem, $row['id']);
                                           };
        foreach ($collect_chem as $key => $value) {
            $id = $value;
            $shortname = $_POST['shortname'.$id.''];
            $description = $_POST['description'.$id.''];
            $measurement = $_POST['measurement'.$id.''];
            // print '<br> ?: '.$id.$shortname . $description;
            # code...
            $stmt = $db->query("UPDATE digitalfish.chem SET shortname='$shortname', description='$description', measurement='$measurement' WHERE id=$id ;");
            $stmt2 = $db->query("UPDATE digitalfish.event SET event='$shortname' WHERE chemid='$id' ;");
                                       
        };
         print '<meta http-equiv="refresh" content="0;url=index.php?page=chemedit" />';

        };



if ($option =="feed_remote") {
    $stmt = $db->query("UPDATE admin SET value=1 where setting='feed';");
    print '<meta http-equiv="refresh" content="0;url=feedsched.php" />';
    
};


if ($option =="resetlddnow") {
    $stmt = $db->query("UPDATE digitalfish.ledim SET state='0';");
    $stmt = $db->query("UPDATE digitalfish.codes SET state='0' WHERE code='lddreboot';");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=lddlights&message=LDD Reset for current phase, observe lights." />';
};

if ($option =="addlddname") {

    
    $name=$_POST['name'];
    $channel=$_POST['channel'];
    $count = 0;
    $stmt = $db->query('SELECT * FROM digitalfish.ledim;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $channelindb = $row['channel'];
            if ($channelindb == $channel) { $count = $count + 1 ; print $count;} 
          };

    if ($count > 0) { print '<div class="container"><div align="center">Channel '.$channel.' is already taken, please choose another channel<br><br>
        <button class="btn btn-danger" onclick="window.location.href=\'index.php?page=lddlights\'">Try Again</button>
        </div><br></div>';} else {

    $stmt = $db->query("INSERT INTO digitalfish.ledim_name SET name='$name'");
    $stmt = $db->query("SELECT * FROM digitalfish.ledim_name WHERE name='$name'");
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $id = $row['id']; };
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='0', end='300', speed='1', state='0',phase='sunrise',channel='$channel',auto='1', manual='4000'");
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='300', end='1000', speed='1', state='0',phase='morning',channel='$channel',auto='1', manual='4000'");
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='1000', end='4000', speed='5', state='0',phase='daytime',channel='$channel',auto='1', manual='4000'");
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='4000', end='2000', speed='-5', state='0',phase='afternoon',channel='$channel',auto='1', manual='4000'");
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='1000', end='500', speed='-5', state='0',phase='sunset',channel='$channel',auto='1', manual='4000'");
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='500', end='300', speed='-1', state='0',phase='night',channel='$channel',auto='1', manual='4000'");
    $stmt = $db->query("INSERT INTO digitalfish.ledim SET ledim_name_id='$id', start='300', end='0', speed='-1', state='0',phase='nolight',channel='$channel',auto='1', manual='4000'");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=lddlights" />';

    ;}      



    };

if ($option == "deleteldd") {
                $id = $_POST['deleteid'];
                $stmt = $db->query("DELETE FROM digitalfish.ledim_name WHERE id='$id'");
                $stmt = $db->query("DELETE FROM digitalfish.ledim WHERE ledim_name_id='$id'");
                print '<meta http-equiv="refresh" content="0;url=index.php?page=lddlights" />';

};

if ($option == "ledim") {

        $applyto=$_POST['applyto'];
        // print '<div class="container">';
        print_r($applyto);     
        $id = $_POST['id'];
        $ledim_name_id = $_POST['ledim_name_id'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $speed = $_POST['speed'];             
        $state = $_POST['state'];
                // $phase = $_POST['phase'];
        $channel = $_POST['channelmaster'];
        $auto = $_POST['automaster'];
        $manual = $_POST['manual'];
        $name = $_POST['name'];
        $idfornamechange = $ledim_name_id[1];
        $stmt = $db->query("UPDATE digitalfish.ledim_name SET name='$name' WHERE id='$idfornamechange';");
        // print $channelmaster;
        // $stmt = $db->query("UPDATE digitalfish.ledim SET )";
        // print_r ($id);
        $count = 0;
        foreach ($id as $key => $value) {
            
            $endx = $end[$key];  

            $ledim_name_idx = $ledim_name_id[$key];
            if ($count==0) {$startx = 0;} 
            if ($count >=1) {$startx = $prevend;}               
            $count++;
                 

            $speedx = $speed[$key];
            if ($endx < $prevend) {$speedx='-'.$speedx;};
            $statex =   $state[$key];
            // $phasex =   $phase[$key];
            // $channelx = $channel[$key];
            // $autox =    $auto[$key];
            $manualx =  $manual[$key];
            
            // print $value;
            // print $startx;

            $stmt = $db->query("UPDATE digitalfish.ledim SET 
                ledim_name_id='$ledim_name_idx',
                start='$startx',
                `end`='$endx',
                speed='$speedx',
                -- state='$statex',
                channel='$channel',
                auto='$auto',
                manual='$manualx'
                WHERE id='$value';");

// print $startx.$endx.$speedx;

        $prevend = $endx;
        };

foreach ($applyto as $key => $valueb) {
print "A";
$stmtf = $db->query("SELECT * FROM digitalfish.ledim WHERE ledim_name_id='$ledim_name_idx';");
    while($rowf = $stmtf->fetch(PDO::FETCH_ASSOC)) {

$start = $rowf['start'];
$end = $rowf['end'];
$speed = $rowf['speed'];
$phase = $rowf['phase'];
print $phase;
$stmt = $db->query("UPDATE digitalfish.ledim SET start='$start', `end`='$end', speed='$speed' WHERE phase='$phase' AND ledim_name_id='$valueb';");

    };

};
    


        print '<meta http-equiv="refresh" content="0;url=index.php?page=lddlights" />';
   // print '</div>';


}; //END








if ($option == "leddimadd") {
    print "here";

};

if ($option == "rssflush") {
    $answer=$_POST['answer'];
    print '<div align="center">
    <div class="container">
    <form action="submit.php" method="POST">
    <input name="answer" value="yes" hidden>
    <input name="option" value="rssflush" hidden>
    <button class="btn btn-danger" type="submit">YES DELETE ALL RSS MESSAGES</button>
    <hr>
    </form>
    <a href="index.php?page=rssfeed"><button class="btn btn-default">CANCEL</button></a>
    <br><br>
    </div>

    </div>
    ';


    if ($answer=='yes') {
        $stmt = $db->query("TRUNCATE alert;");
         
        print '<meta http-equiv="refresh" content="0;url=index.php?page=rssfeed"/>';
    };



};



if ($option == "editdoserelay") {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $polarity = $_POST['polarity'];
    $state = $_POST['state'];
    $gpio = $_POST['gpio'];
    $mls = $_POST['mls'];
    $stmt = $db->query("UPDATE relay_dose SET polarity='$polarity', state='$state', gpio='$gpio', description='$description' WHERE id='$id';");
    print '<meta http-equiv="refresh" content="0;url=doserelayedit.php?id='.$id.'"/>';


};


 if ($option == "phase_edit"){

        $sunrise_start=$_POST['sunrise_start'];

        $sunrise_end=$_POST['sunrise_end'];
        $morning_start=$_POST['morning_start'];
        $morning_end=$_POST['morning_end'];
        $daytime_start=$_POST['daytime_start'];
        $daytime_end=$_POST['daytime_end'];
         $afternoon_start=$_POST['afternoon_start'];
        $afternoon_end=$_POST['afternoon_end'];
        $sunset_start=$_POST['sunset_start'];
        $sunset_end=$_POST['sunset_end'];
        $night_start=$_POST['night_start'];
        $night_end=$_POST['night_end'];
        $nolight_start=$_POST['nolight_start'];
        

        $stmt = $db->query("UPDATE digitalfish.sched SET 
            sunrise_start='$sunrise_start',sunrise_end='$sunrise_end',
            morning_start='$morning_start', morning_end='$morning_end', daytime_start='$daytime_start', daytime_end='$daytime_end', afternoon_start='$afternoon_start', afternoon_end='$afternoon_end', sunset_start='$sunset_start', sunset_end='$sunset_end', nolight_start = '$nolight_start', night_start='$night_start',night_end='$night_end', nolight_start='$nolight_start' WHERE id='0' ;");
        print '<meta http-equiv="refresh" content="0;url=index.php?page=phaseconfig" />';


        };

if ($option == "delete-template") {
    $id = $_POST['id'];
    $answer=$_POST['answer'];
    $description=$_POST['description'];
    // print $answer.$id;
    include "nav.php";
    print '
    <div class="container">
    <div align="center">
    <form action="submit.php" method="POST">
    <input name="answer" value="yes" hidden>
    <input name="id" value="'.$id.'" hidden>
    <input name="option" value="deletedoserelay" hidden>
    <div><h1 class="headinds">ARE YOU SURE</h1></div>
    <br>
    <h4>Delete '.$description.' ?</h4>
    <button class="btn btn-danger" type="submit">YES DELETE</button>

    </form>
    <br>
    </div>
    </div>
    ';

    if ($answer=='yes') {
        $stmt = $db->query("DELETE FROM relay_dose_sched WHERE relay_dose_id=$id;");
        $stmt = $db->query("DELETE FROM relay_dose WHERE id=$id;");        
        print '<meta http-equiv="refresh" content="0;url=index.php?page=dosing"/>';
    };

};




if ($option == "deletedosesched") {
    // print "It Work!";
    $id = $_POST['id'];
    $relay_dose_id = $_POST['relay_dose_id'];
    // print $id."<br>";
    // print $relay_dose_id;
    $stmt = $db->query("DELETE FROM relay_dose_sched WHERE id=$id;");
    print '<meta http-equiv="refresh" content="0;url=doseedit.php?relay_dose_id='.$relay_dose_id.'"/>';

};

if ($option == "addscheddose") {

    $relay_dose_id=$_POST['doseid'];
    print $id;
    $day=$_POST['day'];
    $time=$_POST['time'];
    $seconds=$_POST['seconds'];
    print "Hello";
    $stmt = $db->query("INSERT INTO relay_dose_sched SET day='$day', time='$time', seconds='$seconds', relay_dose_id='$relay_dose_id', dosecompleted=0;");
    print '<meta http-equiv="refresh" content="0;url=doseedit.php?relay_dose_id='.$relay_dose_id.'"/>';

    };




if ($option == "deletedoserelay") {
    $id = $_POST['id'];
    $answer=$_POST['answer'];
    $description=$_POST['description'];
    // print $answer.$id;
    include "nav.php";
    print '
    <div class="container">
    <div align="center">
    <form action="submit.php" id="deletedoserelay" method="POST">
    <input name="answer" value="yes" hidden>
    <input name="id" value="'.$id.'" hidden>
    <input name="option" value="deletedoserelay" hidden>
    <div><h1 class="headinds">ARE YOU SURE</h1></div>
    <br>
    <h4>Delete '.$description.' ?</h4>
    
    </form>
	<button class="btn btn-info" onclick="window.location.href=\'index.php?page=dosing\'">Cancel</button>
	<button class="btn btn-danger" form="deletedoserelay" type="submit">DELETE</button>
    <br>
    <br>
    </div>
    </div>
    ';

    if ($answer=='yes') {
        $stmt = $db->query("DELETE FROM relay_dose_sched WHERE relay_dose_id=$id;");
        $stmt = $db->query("DELETE FROM relay_dose WHERE id=$id;");        
        print '<meta http-equiv="refresh" content="0;url=index.php?page=dosing"/>';
    };



};


if ($option == "doseadd") {
    
    $relayname = $_POST['relayname'];
    $gpio = $_POST['gpio'];
    $polarity = $_POST['polarity'];
    $state = $_POST['state'];
    $stmt = $db->query("INSERT INTO relay_dose SET polarity='$polarity', state='$state', gpio='$gpio', description='$relayname';");
    print '<meta http-equiv="refresh" content="0;url=index.php?page=dosing"/>';
    };


if ($option =="addfilter") {
	$fname=$_POST['fname'];
	$fdesc=$_POST['fdesc'];
	$fperiod=$_POST['fperiod'];
	$stmt = $db->query("INSERT INTO digitalfish.filter SET shortname='$fname',description='$fdesc',expiry='$fperiod';");
	$stmt = $db->query("SELECT * FROM digitalfish.filter WHERE shortname='$fname';");
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            global $id;
                                            $id = $row['id'];                                            
                                           };
	$stmt = $db->query("INSERT INTO digitalfish.event (event, value, filterid,dateset,timeset) VALUES ('$fname', 'Added', '$id',CURRENT_DATE, CURRENT_TIME);");
   	print '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php?page=filtration">';
   };

if ($option =="deletecategory") {
	$category = $_POST['category'];
	$stmt = $db->query("DELETE FROM digitalfish.inhab_category WHERE id='$category';");
   	print '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php?page=inhabitants">';
   };



if ($option =="addinhabcategory") {
	$category = $_POST['category'];
	$stmt = $db->query("INSERT INTO digitalfish.inhab_category SET category='$category';");
   	print '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php?page=inhabitants">';
   };

if ($option =="commit-inhab") {
	// print "here";
	$returnurl = $_POST['returnurl'];
	$image = $_POST['image'];
	$inhab_id = $_POST['inhab_id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$category = $_POST['category'];
	$status = $_POST['status'];
	$latin = $_POST['latin'];
	$date_introduced = $_POST['date_introduced'];
	$filename = $_FILES['uploaded']['name'];
	if (empty($filename)) {$filename=$image;}
	else {
	$target = "species/";
    $target = $target . basename( $_FILES['uploaded']['name']) ;
    $filename = $_FILES['uploaded']['name'];
    print "<br>";
    // print $target;
    $ok=1;
    
    if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
    { echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded"; } 
    else { echo "Sorry, there was a problem uploading your file."; }

};

// print $filename;
$stmt = $db->query("SELECT * FROM inhab_species WHERE id='$inhab_id';");
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$current_status = $row['inhab_status_id'];
		if ($current_status == $status) {;} else {
			$stmt2 = $db->query("UPDATE inhab_species SET dateset=CURRENT_TIMESTAMP WHERE id='$inhab_id' ;");
			;};
		};
$stmt = $db->query("UPDATE inhab_species SET latin='$latin',date_introduced='$date_introduced',inhab_category_id='$category',name='$name',description='$description', inhab_status_id='$status', image='$filename' WHERE id='$inhab_id';");
print "is:";
// print $returnurl;
print $saving;

if ($returnurl=="inhabreport") {print '<meta HTTP-EQUIV="REFRESH" content="2; url=index.php?page=inhabitantsreport">';} else { print '<meta HTTP-EQUIV="REFRESH" content="2; url=index.php?page=inhabitants">';};

};

if ($option == "addspecies") {
        // print '<br>ADD SPECIES';
        $article = $_POST['article'];
        // print $article;
        $articletitle = $_POST['article-title'];
        $articleimage = $_POST['article-image'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $latin = $_POST['latin'];
        $date_introduced = $_POST['date_introduced'];

        $target = "species/";
        $target = $target . basename( $_FILES['uploaded']['name']) ;
        $filename = $_FILES['uploaded']['name'];
        print "<br>";
        // print $target;
        $ok=1;
        
        if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
        { echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded"; } 
        else { echo "Sorry, there was a problem uploading your file."; }


        $file = 'test.txt';
        file_put_contents($file, $article);
        $article = strip_tags($article);
        $article = str_replace('"', "", $article);
        $article = str_replace("'", "", $article);
        
        $stmt = $db->query("INSERT INTO inhab_species SET latin='$latin',date_introduced='$date_introduced',inhab_category_id = '$category',description = '$article', name = '$articletitle', image = '$filename', inhab_status_id='$status' ");
        print '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php?page=inhabitants">';
        };

if ($option == "delete_inhab") {
        $id = $_POST['id'];
        $image = $_POST['image'];
        $stmt = $db->query("DELETE FROM inhab_species WHERE id=$id");
        exec ("rm species/".$image);
        print '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php?page=inhabitants">';
        };

   if ($option == "filteraction") {

        $collect_id = $_POST['filtervalues'];
        $collect_id = explode(',', $collect_id);

        foreach ($collect_id as $key => $value) {
            $id = $value;
            $formaction = 'form' . $value;          #This retrieves the unique form name/s from the posting form
            $action = $_POST[$formaction];          #This retrieves the unique form name/s from the posting form
            $stmt = $db->query("SELECT * FROM filter WHERE id='$id';");
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 $shortname = $row['shortname'];
            };
            
             if ($action == "None") {;}
            else {
            $stmt = $db->query("INSERT INTO event SET dateset=CURRENT_DATE,timeset=CURRENT_TIME, event='$shortname',value='$action',filterid='$id'");
            $stmt = $db->query("UPDATE filter SET dateset=CURRENT_DATE WHERE shortname='$shortname'");
            $stmt = $db->query("INSERT into alert SET collection='rss', category='Maintenance', title='Filter/LifeSpan',message='$action';");
    
         
                };

        };

        print '<meta HTTP-EQUIV="REFRESH" content="0; url=index.php?page=filtration">';
        };

if ($option == "deletefilter") {
	$id = $_POST['deleteid'];
	$stmt = $db->query("DELETE FROM filter WHERE id='$id';");
	print $saving;
	print '<meta http-equiv="refresh" content="1;url=index.php?page=filtration"/>';

};


if ($option == "deletenormalrelay") {
	$id = $_POST['deleteid'];
	$stmt = $db->query("DELETE FROM relay_master WHERE id='$id';");
	print $saving;
	print '<meta http-equiv="refresh" content="1;url=index.php?page=relays"/>';

};


if ($option == "addnormalrelay") {
	print "HERE";
	$relayname=$_POST['relayname'];
	$stmt = $db->query("INSERT INTO relay_master SET name='$relayname' ;");
	print $saving;
	print '<meta http-equiv="refresh" content="1;url=index.php?page=relays"/>';

};


if ($option == "relay-table-save") {
	
	$id = $_POST['id'];
	$sunrise = $_POST['sunrise'];
	$morning = $_POST['morning'];
	$daytime = $_POST['daytime'];
    $afternoon = $_POST['afternoon'];
	$sunset = $_POST['sunset'];
	$night = $_POST['night'];
	$nolight = $_POST['nolight'];
	foreach ($id as $key => $value) {
		$stmt = $db->query("UPDATE relay_master SET sunrise='$sunrise[$key]', morning='$morning[$key]', daytime='$daytime[$key]',afternoon='$afternoon[$key]',sunset='$sunset[$key]', night='$night[$key]', nolight='$nolight[$key]' WHERE id='$value';");
 		
	};
	
    // print "<div class=container>";
    $mid=$_POST['mid'];
    // print_r($mid);
    // print "<br>";
    $manual=$_POST['manual'];
    // print_r($manual);
    // print '</div>';
    foreach ($mid as $key => $value) {
        $stmt = $db->query("UPDATE relay_master SET state='$manual[$key]' WHERE id='$value';");
    };



    print '<meta http-equiv="refresh" content="0;url=index.php?page=relaystable"/>';

};

if ($option == "relay-table-2-save") {
	// print "Relay-edit-2";
	$id = $_POST['id'];
	$auto = $_POST['auto'];
	$name = $_POST['name'];
	$sunrise = $_POST['sunrise'];
	$morning = $_POST['morning'];
	$daytime = $_POST['daytime'];
    $afternoon = $_POST['afternoon'];
	$sunset = $_POST['sunset'];
	$night = $_POST['night'];
	$nolight = $_POST['nolight'];
	$gpio  = $_POST['gpio'];
	$polarity = $_POST['polarity'];
	$ib = $_POST['ib'];
	$ibaction = $_POST['ibaction'];
	$ia = $_POST['ia'];
	$iaaction = $_POST['iaaction'];
	$thermbind = $_POST['thermbind'];
	// print_r($thermbind);


	foreach ($id as $key => $value) {
// print $thermbind[$key];

		$stmt = $db->query("UPDATE relay_master SET 
			gpio='$gpio[$key]',
			polarity='$polarity[$key]',
			therm_low_value='$ib[$key]',
			therm_low_decision='$ibaction[$key]', 
			therm_high_value='$ia[$key]',
			therm_high_decision='$iaaction[$key]',
			thermconfig_id='$thermbind[$key]',
			sunrise='$sunrise[$key]',
			morning='$morning[$key]',
			daytime='$daytime[$key]',
            afternoon='$afternoon[$key]',
			sunset='$sunset[$key]',
			night='$night[$key]',
			nolight='$nolight[$key]',
			auto='$auto[$key]',
			name='$name[$key]'

			WHERE id='$value';");
 		
	};
	print $saving;
	print '<meta http-equiv="refresh" content="0.5;url=index.php?page=relays"/>';
};



?>
