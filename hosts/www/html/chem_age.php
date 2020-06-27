<!DOCTYPE html>
<html>
<head>
    <title>
        digitalfish 4.3
    </title>
    <?php
        include "nav.php";
        include "connection.php";
        // include "global.php";
    ?>

     <script src="chartjs/Chart.bundle.js"></script>
    <script src="chartjs/utils.js"></script>
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

$hashtag = $_GET['hashtag'];

// print $hashtag;


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

    $stmt = $db->query('SELECT * FROM digitalfish.event where chemid='.$id.' ORDER BY id DESC LIMIT 1;');
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

    $stmt = $db->query('SELECT * FROM digitalfish.event where chemid='.$value.';');
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


?>
<div class="maxcontent_width">
<?php
print '<div><ul class="nav nav-tabs" role="tablist">';
$active = 'active';

foreach ($collect_chem as $key => $value) {
    $stmt = $db->query('SELECT * FROM digitalfish.chem where id='.$value.';');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $event = $row['shortname'];
                                        $event_description = $row['description'] ;
                                        };
                                        $event = str_replace(" ", "-", $event);
    
    
    
    if ($hashtag == $event) { $active = 'active';} else {$active='';};
    print '<li role="presentation" class="nav-item"><a class="nav-link  '.$active.'" href="#'.$event.'" aria-controls="'.$event.'" role="tab" data-toggle="tab">'.$event.'</a></li>';
    
    $active='';
    
                                };

$active = 'active';  ## active readdressed

print '</ul>';
 
print '<div class="tab-content">';
    
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
        
    
    
    $idarray = array();
    $checkboxarray = array();
    if ($hashtag == $event) { $active = 'active';} else {$active='';};
    print '<div role="tabpanel" class="tab-pane '.$active.'" id="'.$event.'">';

    // watergraph($data_retrieved,$date_retrieved,$key,$event,$event_description);
    // print "data lives here";
    print '<h3>'.$event.' Age Analysis</h3>';
    print '<table class="table">';
    print '<form action="chem_delete.php" method="POST">';
    print '<tr><th>ID</th><th>Shortname</th><th>Value</th><th>Date</th><th>Time</th><th>Del</th></tr>';
    $stmt2 = $db->query('SELECT * FROM digitalfish.event where chemid='.$value.' ORDER BY ID DESC;');
                                    while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        $id = $row['id'];
                                        $data = $row['value'];
                                        $event = $row['event'];
                                        $dateset = $row['dateset'];
                                        $timeset =  $row['timeset'];

                                        print '<tr><td>'.$id.'</td><td>'.$event.'</td><td>'.$data.'</td><td>'.$dateset.'</td><td>'.$timeset.'</td>
                                            <td>
                                            <div style="display:inline;">
                                            <input name="id[]" value="'.$id.'" hidden>
                                            <select class="form-control" name="check[]" style="max-width:40px;display: inline;padding:0px !important;">
                                                <option value="0"></option>
                                                <option value="1">X</option>
                                                </select>
                                                </div>
                                                </td>
                                        </tr>';

                                    };
    print "</table>";
    print '<input name="hashtag" value='.$event.' hidden>';
    print '&nbsp<button class="btn" type="submit">Delete Selected Records</button><br>Deletes records on this Sheet.';
    print '</form>';



    print '</div>';
        $active='';
};

print '</div>';


?>
</div>

</div>
</div>


</body>

</html>