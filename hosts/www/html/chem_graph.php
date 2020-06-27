<!DOCTYPE html>
<html>
<head>
    <title>
        DegitalFish
    </title>
    <?php
        include "nav.php";
        include "connection.php";
        // include "global.php";
    ?>


    <script src="js/Chart.bundle.js"></script>
<script src="js/utils.js"></script>
    <style>
    canvas{
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>
<body>
 <div class="container">

<?php
           $collect_chem = array();
            $stmt = $db->query('SELECT * FROM digitalfish.chem;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        array_push($collect_chem, $row['id']);
                                       };
function chembuild($id){   
    global $stmt;
    global $db;
    $stmt = $db->query('SELECT description FROM digitalfish.chem where id='.$id.';');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $description = $row['description'];
                                        $description = str_replace(' ', '-', $description);
                                        // print $description;
                                        };

    $stmt = $db->query('SELECT * FROM digitalfish.event where chemid='.$id.' ORDER BY id ASC LIMIT 1;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $information = information($description);
             
             // print '<td>'.$row['id'];
             print '<td>'.$information.''.$row['event'];
             print '<td>'.$row['value'];
             print '<td>'.$row['dateset'];             
             print '<td>'.$row['timeset'].'<tr></tr>';
             
          };

            return;
    }
?>

<div  align="center">
<?php




foreach ($collect_chem as $key => $value) {
    $collect_array_data =  array();
    $collect_array_dateset =  array();

    $stmt = $db->query('SELECT * FROM digitalfish.event where chemid='.$value.' ORDER BY id ASC;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $data = $row['value'];
                                        $dateset = $row['dateset'];
                                        // global $event;
                                        // $event = $row['event'];
                                        if ($data == "Added") { $data="0";};
                                        array_push($collect_array_data, $data);
                                        array_push($collect_array_dateset, $dateset);
                                                                                
                                        };
                                        
                                        // print_r ($collect_array);
                                        $fetch = "data".$key;
                                        $$fetch = $collect_array_data;
                                        $fetch = "dateset".$key;
                                        $$fetch = $collect_array_dateset;

                                        
};






// print_r ($data0);
// print_r ($dateset0);

function watergraph($chem_data,$chem_dateset,$canvas,$event_shortname,$event_description){ 

    print '<link href="css/custom.css" rel="stylesheet">

<div class="maxcontent_width">
        <canvas id="canvas'.$canvas.'"></canvas>
</div>    
   
    <script>
       
        var config'.$canvas.' = {
            type: \'line\',
            data: {
                labels: ["'.$chem_dateset.'"],
                datasets: [{
                    label: "'.$event_description.'",
                    backgroundColor: window.chartColors.blue,
                    borderColor: window.chartColors.blue,
                    data: ['.$chem_data.'
                       
                    ],
                    fill: false,
                
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:\''.$event_shortname.'\'
                },
                tooltips: {
                    mode: \'index\',
                    intersect: false,
                },
                hover: {
                    mode: \'nearest\',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: \'Month\'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: \'Value\'
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx'.$canvas.' = document.getElementById("canvas'.$canvas.'").getContext("2d");
            window.myLine = new Chart(ctx'.$canvas.', config'.$canvas.');
        };

       

       
    </script>';




};



?>
<div class="maxcontent_width">
<?php
print '<div><ul class="nav nav-tabs" role="tablist">';
$active = ' active';
foreach ($collect_chem as $key => $value) {
    $stmt = $db->query('SELECT * FROM digitalfish.chem where id='.$value.';');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $event = $row['shortname'];
                                        $event_description = $row['description'] ;
                                        };
                                        $event = str_replace(" ", "-", $event);
    print '<li class="nav-item " ><a class="nav-link '.$active.'" href="#'.$event.'" aria-controls="'.$event.'" role="tab" data-toggle="tab">'.$event.'</a></li>';
    $active='';
                                };
print '</ul>';
 
print '<div class="tab-content">';
$active2=' active';     
foreach ($collect_chem as $key => $value) {
    $stmt = $db->query('SELECT * FROM digitalfish.chem where id='.$value.';');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $event = $row['shortname'];
                                        $event_description = $row['description'] ;                                       
                                    };
                                    $event = str_replace(" ", "-", $event);  
    $getdata = "data".$key;
    $data_retrieved = implode(',', $$getdata);
    $getdateset = "dateset".$key;
    $date_retrieved = implode('","', $$getdateset);
            
    print '<div role="tabpanel" class="tab-pane'.$active2.'" id="'.$event.'">';
    watergraph($data_retrieved,$date_retrieved,$key,$event,$event_description);
    print '</div>';
        $active2='';
};

print '</div>';


print '<script>';
print 'window.onload = function() {';
    foreach ($collect_chem as $key => $value) {
        print 'var ctx = document.getElementById("canvas'.$key.'").getContext("2d");
                window.myLine = new Chart(ctx, config'.$key.');';
    };
print '};';
print '</script></div>';

// print '</div>';

?>
<br>
Data Flows From LEFT to RIGHT
</div>

</div>
</div>

</body>
</html>