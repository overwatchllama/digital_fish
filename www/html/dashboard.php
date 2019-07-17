<!DOCTYPE html>
<html>

	<title>Dashboard</title>
	<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Starter</title>
  <script src="js/jquery.js"></script>
</head>

<?php 
	include "connection.php";


// $stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.event;');
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_event=$row['totalrecords'];};
// $stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.thermlog;');
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_thermlog=$row['totalrecords'];};
// $stmt = $db->query('SELECT COUNT(*) as totalrecords FROM digitalfish.alert;');
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { $totalrecords_alert=$row['totalrecords'];};


?>



<div class="row">

<?php
?>

</div>

<body>

<?php

?>


<!-- Dashboard: Chemical Metric Section -->

<!-- Dashboard: SQL Metric Section -->
<div id="content"></div>
<!-- Dashboard: Therm Metric Section -->
<div id="content2"></div>
   
</body>

<script type="text/javascript">
  (function($)
  {
   $(document).ready(function()
  {
    $.ajaxSetup(
       {
           cache: false,
           beforeSend: function() {
                // $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                // $('#content').show();
            },
            success: function() {
                $('#loading').hide();
                $('#content').show();
                $('#content2').show();
        
            }
        });
        
        var $container = $("#content");
        var $container2 = $("#content2");
        $container.load("dashboard-metrics-live.php");
        $container2.load("dashboard-metrics-live2.php");
        
        var refreshId = setInterval(function()
        {
            
        
            $container.load('dashboard-metrics-live.php');
            $container2.load('dashboard-metrics-live2.php');
        }, 2000);
    });
  })(jQuery);
</script>

</html>