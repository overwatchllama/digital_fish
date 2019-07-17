<!DOCTYPE html>
	<head>
  <!-- <meta charset="utf-8"> -->
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <!-- <title>AdminLTE 2 | Starter</title> -->
  
  <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
  <!-- <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- <link rel="stylesheet" href="dist/css/AdminLTE.min.css"> -->
  <!-- <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css"> -->
<!--   <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <!-- <script src="js/jquery.js"></script> -->
</head>

<!-- <table class="table">
	<tr><th>Column</th><th>Column</th><th>Column</th><th>Column</th><th>Column</th><th>Column</th></tr>
	<tr><td>Data  </td><td>Data  </td><td>Data  </td><td>Data  </td><td>Data  </td><td>Data  </td></tr>

</table> -->
123
<?php
include "connection.php";
$stmt = $db->query("SELECT * FROM codes where code='thermtype';");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  $type=$row['state'];

};


$stmt = $db->query("SELECT * FROM thermconfig;");
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
  $sensorname=$row['sensorname'];
  $current_therm=$row['current_therm'];
  if ($type==0) {$current_therm = $current_therm *2;};

print'

<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">'.$sensorname.'</span>
              <span class="info-box-number">'.$current_therm.'</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>   


';
};



?>