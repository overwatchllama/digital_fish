<!DOCTYPE html>
<?php
    include "connection.php";
?>
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

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

    $stmt = $db->query('SELECT * FROM digitalfish.event where chemid='.$id.' ORDER BY id DESC;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            
             
             // print '<td>'.$row['id'];
             print '<tr><td>'.$row['event'].'</td>';
             print '<td>'.$row['value'].'</td>';
             print '<td>'.$row['dateset'].'</td>';             
             print '<td>'.$row['timeset'].'</td><td>
             <input class="form-control" style="height:20px;" type="checkbox" value='.$id.' name="del[]"></td>
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
                    <th>Chemical</th>
                    <th>Last Reading</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <?php 
            
                foreach ($collect_chem as $key => $value) {
                    chembuild($value);    # code...
                };
                
            ?>
        </table>
        <button type="submit">Process Delete</button></form>
    </div>


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