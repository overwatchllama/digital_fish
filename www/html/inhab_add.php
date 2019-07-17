
    <?php
        include "nav.php";
        include "connection.php";
    ?>

<?php
$date = date('Y-m-d');
?>

<body>
<div class="container">
    <div><h1 class="headinds">ADD SPECIES</h1></div>
<div class="btn-group" role="group" aria-label="Basic example">            
    <button class="btn" type="submit" onclick="location.href='index.php?page=inhabitants'">Cancel</button>
    <button class="btn btn-success" type="submit" form="form1">Save Changes</button>
</div>
<div class="pad5"></div>
<div align="center">
<div class="card pad10">

    <div align="left">
    <!-- Place this in the body of the page content -->
        <form enctype="multipart/form-data" id="form1" action="submit.php" method="post">

<label>Species Name</label>
            <input class="form-control" name = "article-title" style="width:300px;" required>
            <label>Latin Name</label><input class="form-control" name = "latin" style="width:300px;" >
<label>Date Introduced (Y/m/d)</label><input class="form-control" type="date" name = "date_introduced" style="width:300px;" value="<?php print $date;?>" >
<br>
<?php
print '<label>Category</label><br>';
$stmt = $db->query('SELECT * FROM inhab_category;');
                                    print '<select class="form-control" name="category">';
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    print '
                                    
                                    <option value='.$row['id'].'>'.$row['category'].'</option>
                                    ';                                    };
                                    print '</select>';
print '<label>Status</label><br>';
$stmt = $db->query('SELECT * FROM inhab_status;');
                                    print '<select class="form-control" name="status">';
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    print '
                                    
                                    <option value='.$row['id'].'>'.$row['status'].'</option>
                                    ';                                    };
                                    print '</select>';                                    

?>


        <input name="option" value="addspecies" hidden>
        

        <label>Image (600x250 recommended)<br></label>
        <input class="form-control" name="uploaded" type="file"><Br>
        <label>Description</label><Br>
            <textarea class="form-control" name="article" style="min-height:300px;min-width: 100%;" required=""></textarea><br>

            <table><td>
            </div></td>
        </form>
        <div style="display:inline-block;">
        <td width="10px"></td>
        <td></div></td></table>
    </div>

</div>
</div>
</div>

</body>
