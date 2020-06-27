
<script src="js/Chart.bundle.js"></script>
<script src="js/utils.js"></script>

<?php
include "connection.php";
include "nav.php";

$thermconfigid= array();
$stmt = $db->query("SELECT * FROM digitalfish.thermconfig;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($thermconfigid, $row['id']);
    };

// print implode('.', $thermconfigid);

foreach ($thermconfigid as $key => $value) {

    $array = array();
    $dateset_array = array();   

$stmt = $db->query("SELECT * FROM digitalfish.thermlog where id_thermconfig='$value' ORDER BY id DESC LIMIT 24;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $the_time = $row['dateset'];                 
        $the_time = date('Y-m-d G:i:s');
        $the_time = date('G:i');
        // $the_time = date('G:i:s');
        // print $the_time;
        array_push($array, $row['reading']);
        // print $row['dateset'];
        // array_push($array.$value, $row['reading']);
        array_push($dateset_array, $the_time);               

    };
    
    $datalog = "datalog_";
    ${$datalog.$value} = $array;
};

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
<div style="max-width: 95%;">

    <div style="width:100%;">
        <canvas id="canvas"></canvas>
    </div>
    
    <script>
        // var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var config = {
            type: 'line',
            data: {
                labels: [<?php foreach ($dateset_array as $key => $value) {print "'".$value."',";};  ?>],
                datasets: [
    <?php 
                foreach ($thermconfigid as $key => $value) {
                             $datalog = "datalog_";
                            $info = implode(',',${$datalog.$value});                        
                print '
                    {
                    label: "My First dataset",
                    backgroundColor: window.chartColors.grey,
                    borderColor: window.chartColors.grey,
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
                    text: '24 Hour Window'
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
</div>
</div>