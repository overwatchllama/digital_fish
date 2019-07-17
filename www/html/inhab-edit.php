
<?php
 include "nav.php";
 include "connection.php";
?>

<body>
<style type="text/css">
    img {
  display: block;
  /*max-width:230px;*/
  /*max-height:95px;*/
  max-width: 100%;
  height: auto;
}

.file { padding: 10px !important;
}
</style>


<?php
$returnurl="";
if (isset($_GET['returnurl'])) {
$returnurl = $_GET['returnurl'];
};
?>

<div class="container">    
    <div align="left">
        <div><h1 class="headinds">EDIT SPECIES</h1></div>
    <div class="btn-group" role="group" aria-label="Basic example">            
            <button class="btn" type="submit" onclick="location.href='index.php?page=inhabitants'">Cancel</button>
            <button class="btn btn-danger" type="submit" form="form2">Delete</button>
            <button class="btn btn-success" type="submit" form="form1">Save Changes</button>
        </div>
    </div>

<div class="pad5"></div>


<div class="card pad10">


<?php

       
        // $returnurl = $_GET['return'];
        
        $id = $_POST['id'];
        
        $stmt = $db->query("SELECT * FROM digitalfish.inhab_species where id=$id;");
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $date_introduced = $row['date_introduced'];
        $name = $row['name'];
        $latin = $row['latin'];
        $image = $row['image'];
        $description = $row['description'];
        $inhab_status_id = $row['inhab_status_id'];
        $inhab_category_id = $row['inhab_category_id'];
        // print $inhab_status_id;
        print '
    

        
            <div><img src="species/'.$image.'"></div>
        ';
        print '
       
        ';
        $date_introduced = strtotime($date_introduced);
        $date_introduced = date('Y:m:d', $date_introduced);
        $date_introduced =  str_replace(":", "-", $date_introduced);
        
        print '
            <div align="left">
                <form enctype="multipart/form-data" id="form1" action="submit.php" method="POST">
                    <br>
                        <label>Update Image</label>
                            <input value="'.$returnurl.'" name="returnurl" hidden>
                            <input class="form-control file" name="uploaded" type="file" style="width:300px;">
                    <br>
                        <label>Name </label>
                            <input class="form-control" name="name" value="'.$name.'">
       
                        <label>Latin</label>
                            <input class="form-control" name="latin" value="'.$latin.'">
                    <br>
                        <label>Date Introduced</label>
                            <input class="form-control" type="date" name="date_introduced" value="'.$date_introduced.'">
                    <br>
                        <label>Description</label>
                            <input name="option" value="commit-inhab" hidden>
                            <input name="image" value ="'.$image.'" hidden>
                            <input name="inhab_id" value='.$id.' hidden>
                            <textarea class="form-control" name="description" style="min-height:200px;min-width: 100%;">'.$description.'</textarea>';

        $stmt = $db->query('SELECT * FROM inhab_category;');
                                            print '<label>Category</label><select class="form-control" name="category">';
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                                                    if ($row['id'] == $inhab_category_id) {$selected = ' selected="selected" ';} 
                                                    else {$selected = '';};

                                            print '<option '.$selected.' value='.$row['id'].'>'.$row['category'].'</option>
                                            ';};
                                            print '</select>';
                                            
        $stmt = $db->query('SELECT * FROM inhab_status;');
                                            print '<label>Status</label><select class="form-control" name="status">';
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            
                                            if ($row['id'] == $inhab_status_id) {$selected = ' selected="selected" ';} 
                                                    else {$selected = '';};
                                            
                                            print '<option '.$selected.' value='.$row['id'].'>'.$row['status'].'</option>
                                            ';
                                        };
                                            print '</select>';




                                            };


      
        print '</form>';

              print '<td width="80px" ></td><td width="80px"  style="padding-top:15px;">
                                            <form id="form2" action="submit.php" method="POST">
                                            <input value="delete_inhab" name="option" hidden>
                                            <input value='.$id.' name="id" hidden>
                                            <input value='.$image.' name="image" hidden>
                                            
                                            </form></td>';
                                          

                                           

        print ''; // Div Class Card
        

?>
</div>


</body>