<div class="container">
    <?php
        include "nav.php";
        include "connection.php";

        // $saved = $_GET['recordadded'];
        // if ($saved == "1") { $saved = "<strong>Record Added</strong>";};
    
// $collect = array();
// $name_collect = array();

$now = date("H:m");
// $now = date("Y-m-d");
print $now;

print '<table class="table table-bordered relaytbl softbox">';
print '<th class="th-heading" colspan="2">
		<div style="float: left;">Chemical Readings</div>
		<div style="float: right;">
		<a href="chem.php" title="Back to chemical graphs">
		<span class="glyphicon glyphicon glyphicon-arrow-left" hidden="true"></span></a></th><tr></tr>';
print '<form action="submit.php" method="POST">';
print '<input name="option" value="chem_value_add" hidden>';
print '<tr><th>Date</th><th>Time</th></tr>';
print '<td><input class="form-control" required type="date" name = "date"></td>';
print '<td><input class="form-control" required type="TIME" value="'.$now.'" name="time"></tr>';
$stmt = $db->query("SELECT * FROM chem");
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$name = $row['shortname'];
$nname = str_replace(" ", "_", $name);
print '<tr><td>'.$name.'</td><td><input class="form-control" name="'.$nname.'" placeholder="Reading"></td></tr>';
                                    	
                                    };
print '<td colspan="2"><strong>Hint:</strong> If you have no reading simple skip field.<div style="float: right;"><button class="btn" type="submit">Submit Readings</button></div></td>';
print '</form>';
print "</table>";
    ?>
</div>

