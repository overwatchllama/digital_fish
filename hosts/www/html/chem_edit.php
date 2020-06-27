<!DOCTYPE html>
<html>
<head>
    <title>
        DigitalFish
    </title>
    <?php
        // include "nav.php";
        include "connection.php";
    ?>
    <link href="css/custom.css" rel="stylesheet">

</head>
<body>
  <div class="container">





<!-- BEGIN MODAL ADD FIELDS -->
<div><h1 class="headinds">Add/Remove Chemicals</h1></div>
    <p><div class="btn-group" role="group" aria-label="">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Add</button>
        <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#deleteFilter">Delete Chemical</button>
    </div>
</p>
        <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <div class="modal-body">

        <form action="submit.php" method="POST">
                <!-- SET -->
              <input name="option" value="addchemical" hidden>
                <table width="100%">
                  <tr><td>Chemical</td><td><input class="form-control" name="shortname" required></td></tr>
                  <tr><td>Description</td><td><input class="form-control" name="description" required></td></tr>
                  <tr><td>Measurement</td><td><input class="form-control" name="measurement" required></td></tr>
                  
                </table>
              </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        
    </div>
    </div>
    </div>


<!-- 1234412343214 -->

<div class="modal fade" id="deleteFilter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete A Chemical</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
<form action="submit.php" method="POST">
    <input name="option" value="chem_delete" hidden>

<h6 class="text-left">Select Relay To Delete</h6></h6><select name="deleteid" class="form-control">
<?php
$stmt = $db->query("SELECT * FROM digitalfish.chem;");
        
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $name = $row['shortname'];
                print '<option value='.$id.'>'.$name.'</option>';
            };

?>
</select>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-danger">Delete Chemical</buttton>
</form>
      </div>
    </div>
  </div>
</div>

<!-- 134123423412 -->


<?php
global $saved;
global $recordadded;

// if (empty($_GET)) {;} else {

// $savedstatus=$_GET['savedstatus'];
// $recordadded=$_GET['recordadded'];
// if ($savedstatus ==1) {$saved = " Saved";} else {;};
// if ($recordadded ==1) {$recordadded = " Added";} else {;};
// };





           $collect_chem = array();
            $stmt = $db->query('SELECT * FROM digitalfish.chem;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        array_push($collect_chem, $row['id']);
                                       };

function chembuild(){   
    global $special_form;
    global $stmt;
    global $db;
   
    print '<form action="submit.php" method="POST"><input name="option" value="chemedit" hidden>';
    print '';
    $stmt = $db->query('SELECT * FROM digitalfish.chem;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $id = $row['id'];
             print '<td>
             '.$row['id'];
             print '<td><input class="form-control" type="" name="shortname'.$id.'" value="'.$row['shortname'].'">';
             print '<td><input class="form-control"  type="" name="description'.$id.'" value="'.$row['description'].'">';
             print '<td><input  class="form-control" type="" name="measurement'.$id.'" value="'.$row['measurement'].'">' ; 
                   
             print '<tr></tr>';
             
          };
          
          print '<td colspan="4"><button class="btn">Save Changes</button>';
          
          print '</form>';
        print '</td>';


            return;
    }
?>

<div  align="center">
    <table class="table table-bordered relaytbl softbox">
                <th class="th-heading" colspan="6"><div><h1 class="headinds">Edit Chemicals</h1></div><div style="float: right;"><a href="chem.php"<span class="glyphicon glyphicon glyphicon-arrow-left

" aria-hidden="true"></span></a>
</div></th><tr></tr>
                <!-- <th>id</th> --><th>Record ID</th><th>Chemical</th><th>Description</th><th>Measurement</th><tr></tr>
        
        <?php 
       
                chembuild();    # code...
       
        ?>
    </table>

<?php

?>

</div>
</body>

</html>