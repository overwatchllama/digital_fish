<!DOCTYPE html>
<?php
    include "connection.php";
?>
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

<div class="container">
    
<?php
           $collect_chem = array();
            $stmt = $db->query('SELECT * FROM digitalfish.ledim_name;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        array_push($collect_chem, $row['id']);
                                       };
function chembuild($id){   
    

    global $stmt;
    global $stmt2;
    global $db;
    $stmt = $db->query('SELECT name FROM digitalfish.ledim_name where id='.$id.';');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $name = $row['name'];
                                        // $name = str_replace(' ', '-', $name);
                                        // print $name;
                                        };

    $stmt = $db->query('SELECT * FROM digitalfish.ledim where ledim_name_id='.$id.' ORDER BY id DESC;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
                   $stmt2 = $db->query('SELECT * FROM digitalfish.ledim_name where id='.$id.';');
                        while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        $nameis = $row2['name'];
                        };
            
             
             // print '<td>'.$row['id'];
             print '<tr>
             <td>'.$name.'</td>
             <td>'.$row['start'].'</td>';
             print '<td>'.$row['end'].'</td>';
             print '<td>'.$row['speed'].'</td>';             
             print '<td>'.$row['phase'].'</td>
             
             </tr>';
                 
          };


            return;

    }
?>

<div  align="center">

<form action="submit.php" method="POST">
            <input name="option" value="chem_entry_delete" hidden>

    <div><h1 class="headinds">Chemical Readings</h1></div>
    <div class="table-responsive">
        <table class="table table-bordered" id="rssfeedTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Speed</th>
                    <th>State</th>

                    
                </tr>
            </thead>

            <?php 
            
                foreach ($collect_chem as $key => $value) {
                    chembuild($value);    # code...
                };
                
            ?>
        </table>
        <button type="submit">Submit</button></form>
    </div>


<?php

foreach ($collect_chem as $key => $value) {
    $collect_array_data =  array();
    $collect_array_dateset =  array();

    $stmt = $db->query('SELECT * FROM digitalfish.ledim where ledim_name_id='.$value.';');
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

<br>
</div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){$("#rssfeedTable").DataTable({
    "aaSorting": [[0,'desc']]
  })});
</script>

<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>