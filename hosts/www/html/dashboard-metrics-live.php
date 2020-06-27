  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<?php
include "connection.php";
$stmt = $db->query("SELECT * FROM codes where code='thermtype';");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  $type=$row['state'];

};

$stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.event;');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_event=$row['totalrecords'];};

$stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.thermlog;');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_thermlog=$row['totalrecords'];};

$stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.alert;');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_alert=$row['totalrecords'];};

  $stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.alert where category="Ato";');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_ato=$row['totalrecords'];};

$stmt = $db->query("SELECT COUNT(*) as totalrecords, DATE_FORMAT(alert.dateset_timeset, '%Y-%m-%d') FROM alert WHERE DATE(alert.dateset_timeset) = CURDATE();");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_alert_today=$row['totalrecords'];};

$stmt = $db->query("SELECT COUNT(*) as totalrecords, DATE_FORMAT(alert.dateset_timeset, '%Y-%m-%d') FROM alert WHERE DATE(alert.dateset_timeset) = CURDATE() and category='Ato';");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_ato_today=$row['totalrecords'];};

  $stmt = $db->query("SELECT COUNT(*) as totalrecords, DATE_FORMAT(thermlog.dateset, '%Y-%m-%d') FROM thermlog WHERE DATE(thermlog.dateset) = CURDATE();");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_thermlog_today=$row['totalrecords'];};



function metrixcube($data,$datatitle,$color,$newrecords) {
  print'
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-'.$color.'">
            <div class="inner">
              <h3>'.$data.'</h3>

              <p>'.$datatitle.'</p>

            </div>
            <div class="icon">
              <i class="fa  fa-cube"></i>
            </div>
            <a href="#" class="small-box-footer">
              '.$newrecords.' <strong style="color: white !important;">New</strong> Records Today
            </a>
          </div>
        </div>
        ';
  ;};


?>

  <?php metrixcube($totalrecords_event,"Total Events","aqua",""); ?>
  <?php metrixcube($totalrecords_thermlog,"Therm Log","red",$totalrecords_thermlog_today); ?>
  <?php metrixcube($totalrecords_alert,"Total Alerts","orange",$totalrecords_alert_today); ?>
  <?php metrixcube($totalrecords_ato,"Total ATO","blue", $totalrecords_ato_today); ?>

              


