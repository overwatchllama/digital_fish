<!DOCTYPE html>
<html>
<head>
    <title>
        
    </title>
    <?php
        // include "globals.php";
        include "connection.php";
    ?>

<style type="text/css">
  .nav {
    margin-bottom: 10px !important;
  }
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
  background-color: #383c42 !important;
}
.card {
  margin-bottom: 10px;
 
}

</style>
</head>
<body>

<div class="container">
<div><h1 class="headinds">INHABITANTS</h1></div>


<div>
<div class="btn-group" role="group" aria-label="Basic example">
  
  <button type="button" class="btn btn-success" onclick="location.href='inhab_add.php'">Add New Species</button>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add Category</button>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="submit.php" method="POST">
      <input name="option" value="addinhabcategory" hidden>
        <h6 class="text-left">Category Name<input class="form-control" name="category" required></h6>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
       </div>
  </div>
</div>



<div class="pad5"></div>
<div class="card pad10">


<?php

function getmymodal($modal,$id,$name) {
                global $stmt_inhab;
                global $row_inhab;
                global $db;
                global $status;
                
              print '
              <button type="button" class="btn" data-toggle="modal" data-target="#target'.$modal.'">
                View Notes
              </button>
              

              <!-- Modal -->
              <div class="modal fade" id="target'.$modal.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">'.$name.'</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">';
                    // print 'Modal;'.$modal.$id;
                    // print 'Id;'.$id;
                      // include "test.txt";
                      $stmt_inhab = $db->query("SELECT * FROM digitalfish.inhab_species where id='$id';");
                                                        while($row_inhab = $stmt_inhab->fetch(PDO::FETCH_ASSOC)) {
                                                        $description = $row_inhab['description'];
                                                        $image = $row_inhab['image'];
                                                        print '<img src="species/'.$image.'" style="max-width:450px;"><br>';                                                        
                                                        print '<h6>Notes</h6>';
                                                        print $description;
                                                        if ($status == "Sick") {$sick = '<div class="sickimg"><img src="images/sick.jpg" width="60"></div>';} else {$sick = "";};
                                                 };

                  print '
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      
                    </div>
                  </div>
                </div>
              </div>';}





global $inhab_category_id;
$inhab_category_id = array();
$stmt = $db->query('SELECT * FROM digitalfish.inhab_category;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        // print_r($row);
                                        array_push($inhab_category_id, $row['id']);

                                };

?>
  <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
<?php
$x = 1;
$active = "active";
$selected = 'aria-selected="true"';
        $stmt = $db->query('SELECT * FROM digitalfish.inhab_category;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $category=$row['category'];
                                        
                                        print'<li class="nav-item"><a class="nav-link '.$active.'" data-toggle="pill" href="#menu'.$x.'" '.$selected.'>'.$category.'</a></li>';
                                        $x = $x +1;
                                        $active='';
                                        $selected='aria-selected="false"';

                                };
?>

</ul>

<div class="tab-content">

<?php
global $classactive;
$classactive=' class="tab-pane fade show active"';
$tab_build = '<div id="home" class="tab-pane fade show active">';
    foreach ($inhab_category_id as $key => $value) {
        $key = $key+1;
        print '<div id="menu'.$key.'" '.$classactive.'>';
    // print '<table class="table">';
    $stmt = $db->query("SELECT * FROM digitalfish.inhab_species where inhab_category_id='$value';");
                                      $count = $stmt->rowCount();
    if ($count<1) {print '<div style="margin-left: 20px;">No species found, would you like to delete this category.
                          <p><form action="submit.php" method="post">
  <input name="option" value="deletecategory" hidden> 
  <input name="category" value='.$value.' hidden>
   <button class="btn btn-danger" type="submit">YES</button>
</form></p></div>
      ';};

                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                     $speciesid = $row['id'];
                                     $name = $row['name'];
                                     $status_id = $row['inhab_status_id'];
                                     $date_introduced = $row['date_introduced'];
                                     $date_introduced = strtotime($date_introduced);
                                     $date_introduced = date("d-M-Y",$date_introduced);
                                     $latin = $row['latin'];
                                     $description = $row['description'];
                                      
                                     // print'<td style="border-top: 0px !important;border-bottom: solid 1px #cdcdcd !important;"><h4>'.$row['name'].'</h4>';
                                     // CARD BEGIN //////////////////
                                     print '                                     
                                     <div style="" class="list-inline-item">
                                        <div class="card pad10 cardinhab" style="width: 20rem;">
                                        <img class="inhabimg" src="species/'.$row['image'].'">

                                       ';
                                         $stmt_a = $db->query("SELECT * FROM digitalfish.inhab_status where id=$status_id;");
                                          while($row_a = $stmt_a->fetch(PDO::FETCH_ASSOC)) {
                                          $status = $row_a['status'];
                                          // if ($status == "Sick") {$sick = 'Sick';} else {$sick = "";};
                                   };
                                    
                               
                                    
                                     

                                    print '
                                    <div class="card-block">
    <h4 class="card-title theme-standard-card-title">'.$name.'</h4>
    <p class="card-text">';

                                      
  print '
  
    <strong>Status:</strong>'.$status.'<br>
    <strong>Date Introduced:</strong>'.$date_introduced.'<br>
    <strong>Latin Name:</strong>'.$latin.'
  
                                                     
  
      <table><td>
        <form action="inhab-edit.php" method="POST" width="5">
          <input value="edit_inhab" name="option" hidden>
          <input value='.$row['id'].' name="id" hidden>
          <button class="btn btn-success" type="submit">Edit</button>
        </form></td>
        <td>
    ';
    
    getmymodal($speciesid,$speciesid,$name);
    
                                                  
  print '</td></table>
</div>
                                            
                                        </div>
                                    </div>';
                                    // CARD END //////////////////
                                }; 
  // print '</table>';  
        print '</div>';
                                     $tab_build = '<div id="menu'.$key.'" class="tab-pane fade">';
                                     $classactive=' class="tab-pane fade"';     
        # code...
    };
    
?>
</div>
</div>
</div>
</body>
</html>


<!-- Button trigger modal -->

