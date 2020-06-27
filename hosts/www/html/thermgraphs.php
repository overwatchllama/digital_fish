
<script src="js/Chart.bundle.js"></script>
<script src="js/utils.js"></script>

<?php
include "connection.php";
// include "nav.php";

global $thermtype;
$stmt = $db->query("SELECT state FROM digitalfish.codes WHERE code='thermtype';");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $thermtype = $row['state'];
};


$thermconfigid= array();
$thermconfiglabels = array();
$stmt = $db->query("SELECT * FROM digitalfish.thermconfig;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($thermconfigid, $row['id']);
        array_push($thermconfiglabels, $row['sensorname']);

    };

// print implode('.', $thermconfigid);

foreach ($thermconfigid as $key => $value) {

    $array = array();
    $dateset_array = array();   
$stmt = $db->query("SELECT * FROM (SELECT * FROM thermlog WHERE id_thermconfig='$value' GROUP BY UNIX_TIMESTAMP(dateset) DIV 3600  ORDER BY ID DESC LIMIT 25) AS Y ORDER BY id ASC;");
// $stmt = $db->query("SELECT * FROM digitalfish.thermlog where id_thermconfig='$value' ORDER BY id DESC LIMIT 24;");
// $stmt = $db->query("SELECT * FROM digitalfish.thermlog where id_thermconfig='$value' ORDER BY id DESC LIMIT 24;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $the_time = $row['dateset'];
        $phpdate = strtotime( $the_time );
        // $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
        $mysqldate = date( 'H:i', $phpdate );
        $id = $row['id'];
        // print $id.'.';

        // $the_time = date('Y-m-d G:i:s');
        // $the_time = date('G:i');

        // $the_time = date('G:i:s');
         $reading = $row['reading'];
         if ($thermtype==0) {$reading = $reading *9/5+32;};
         // $reading = round($reading);

        array_push($array, $reading);
        // print $row['dateset'];
        // array_push($array.$value, $row['reading']);
        array_push($dateset_array, $mysqldate);               

    };
    
    $datalog = "datalog_";
    ${$datalog.$value} = $array;
};


// $arrayReverse = array_reverse($array);
// $dateset_arrayReverse = array_reverse($dateset_array);
// $array = $arrayReverse;
// $dateset_array = $dateset_arrayReverse;

?>

<head>
    <style type="text/css">

    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<div class="container">

    <div><h1 class="headinds">24 HOURS - Hourly</h1></div>
<div style="max-width: 95%;">

    <div style="width:100%;">
        <canvas id="canvas"></canvas>
    </div>
 
 
</div>
</div>
   
    <script>
        // var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var config = {
            type: 'line',
            data: {
                labels: [<?php foreach ($dateset_array as $key => $value) {print "'".$value."',";};  ?>],
                datasets: [
    <?php 
                $colors = array("blue","red","green","yellow","gray","purple","black");
                foreach ($thermconfigid as $key => $value) {
                            $datalog = "datalog_";
                            $info = implode(',',${$datalog.$value});   

                print '
                    {
                    label: "'.$thermconfiglabels[$key].'",
                    backgroundColor: window.chartColors.'.$colors[$key].',
                    borderColor: window.chartColors.'.$colors[$key].',
                    data: [
                        '.$info.'
                    ],
                    fill: false,
                }, ';

                };
    ?>
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Thermal Graphs for Each Thermal Sensor'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,                            
                            labelString: '24 Hrs'
                        },
                        ticks: {
                            maxRotation: 80,
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };
            window.myLine.update();
        
    </script>

<!-- ------------------------------------------------------------------------------------------- -->
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<div class="container">
<?php
           $collect_chem = array();
            $stmt = $db->query('SELECT * FROM digitalfish.thermconfig;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        array_push($collect_chem, $row['id']);
                                       };
function chembuild(){   
    global $stmt;
    global $db;
    // $stmt = $db->query('SELECT sensorname FROM digitalfish.thermlog ;');
    //                                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //                                     $description = $row['sensorname'];
    //                                     $description = str_replace(' ', '-', $description);
    //                                     // print $description;
    //                                     };
$count=501;

    $stmt = $db->query("SELECT * FROM digitalfish.thermlog ORDER BY id DESC LIMIT 500;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $reading = $row['reading'];
            global $thermtype;
            if ($thermtype==0) {$reading = $reading *9/5+32;};            
            // $reading = round($reading);
            $date = $row['dateset'];
            $dateconverted = strtotime($date);
            $timeconverted = strtotime($date);
            $dateconvert = date("D M j",$dateconverted);
            $timeconvert = date("H:i:s",$dateconverted);
            $date = $dateconvert;
            $time = $timeconvert;
            $count--;

             print '<tr>';
             print '<td>'.$count.'</td>';
             print '<td>'.$row['sensorname'].'</td>';
             print '<td>'.$reading.'</td>';
             print '<td>'.$date.'</td>';             
             print '<td>'.$time.'</td></tr>';
             $date="";
             $time="";
          };

            return;
    }
?>

<div  align="center">

    <div><h1 class="headinds">Thermal Table - Last 500</h1></div>
    <div class="table-responsive">
        <table class="table table-bordered" id="rssfeedTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Number</th>
                    <th>Sensor Name</th>
                    <th>Last Reading</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>

            <?php 
                
                    chembuild();    # code...
                
            ?>
        </table>
    </div>




<br>
<?php

?>
</div>
</div>



<!-- <script src="vendor/jquery/jquery.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function(){
        $("#rssfeedTable").DataTable({"aaSorting": [[0,'desc']]})
    });
</script>

<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>