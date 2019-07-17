<?php
 include "connection.php";
?>

<style type="">
    td {
    width: 10px;
    
  }
</style>

<div class="container">
<div align="right">
  <div><h1 class="headinds">TOTALS</h1></div>

<?php

$collect_inhab_category = array();
$stmt = $db->query('SELECT * FROM digitalfish.inhab_category;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      array_push($collect_inhab_category, $row['id']);
                                    };

foreach ($collect_inhab_category as $key => $value) {
  
  
$stmt = $db->query("SELECT * FROM inhab_category WHERE id='$value';");
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      $category = $row['category'];
                                      print '<div class="d-inline alert" style="font-size:18px;">'.$category.' : ';
                                    };
  
  $stmt = $db->query("SELECT COUNT(*) from inhab_species where inhab_category_id='$value';");
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      print $row['COUNT(*)'].'</div>';
                                    };
  # code...
};
print '</div>';



$collect_inhab_status = array();
$stmt = $db->query('SELECT * FROM digitalfish.inhab_status;');
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      array_push($collect_inhab_status, $row['id']);
                                    };

foreach ($collect_inhab_status as $key => $value) {

  $stmt = $db->query("SELECT * FROM digitalfish.inhab_status where id='$value';");
                                      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                      $status = $row['status'];
                                      };
$count=0;

    $stmt = $db->query("SELECT * FROM digitalfish.inhab_species where inhab_status_id='$value';");
    
    
    print '<div><h1 class="headinds">'.$status.'</h1></div>';
    print '<table class="table">';
    print'<th></th><th>Inhabitant</th><th>Category</th><th>Date Introduced</th><th>'.$status.' Since</th><tr></tr>';
                                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                          $count = $count+1;
                                          $id = $row['id'];
                                          $name = $row['name'];
                                          $description = $row['description'];
                                          $inhab_status_id = $row['inhab_status_id'];
                                          $inhab_category_id = $row['inhab_category_id'];
                                          $date_introduced = $row['date_introduced'];
                                          $date_introduced = strtotime($date_introduced);
                                          $dateset = $row['dateset'];
                                          $dateset = strtotime($dateset);
                                          $dateset = date("d-m-Y",$dateset);

                                          

    $stmt_a = $db->query("SELECT * FROM digitalfish.inhab_category where id='$inhab_category_id';");
                                        while($row_a = $stmt_a->fetch(PDO::FETCH_ASSOC)) {
                                          $inhab_category = $row_a['category'];
                                        };
                                          
 print '<td><form action="inhab-edit.php?returnurl=inhabreport" method="POST">
                                    <input value="edit_inhab" name="option" hidden>
                                    <input value='.$id.' name="id" hidden>
                                    <button class="btn" type="submit">EDIT</button>
                                    </form>'.'</td>';

                                          print '<td>'.$name.'</td><td>'.$inhab_category.'</td>';
print '<td>'.date("d-m-Y",$date_introduced).'</td><td>'.$dateset.'</td>';


                                    print '<tr></tr>';
                                          };
                            print 'Inhabitants In This Section('.$count.')';
    print '</table>';

}; //foreach

?>
</div>
</div>


