<!DOCTYPE html>
<html>
<head>
	<title>Digital Fish</title>
</head>
<body>
    <?php
        
        include "connection.php";
    ?>

<div align="center">
<div class="container">
    <div><h1 class="headinds">ATO STATISTICS</h1></div>
<form action="submit.php" method="POST">
    <input name="option" value="flushato" hidden>
    <div style="float: right; padding-right: 30px; padding-bottom: 5px;"><button class="btn btn-danger">Delete All ATO Data</button></div>
</form>
<br><br>

<?php

$stmt = $db->query("SELECT SUM(value) as dispense, SUM(value_1) as ml FROM event where event='ato';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$dispense = $row['dispense'];
$ml = $row['ml'];
};

$stmt = $db->query("SELECT COUNT(*) as alldays FROM (select DISTINCT dateset from event where event='ato') as totaldays;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$alldays = $row['alldays'];
};




?>

</div>
<br>
<div class="container">

<div><h1 class="subheadinds">ATO STATISTICS SUMMARY</h1></div>
<table class="table table-bordered relaytbl softbox" style="">
            
            <tr><th>Category</th><th>Totals</th><th>Indicators</th></tr>
            <tr><td>Total Actuations</td><td><?php print $dispense; ?></td><td>Counts</td></tr>
            <tr><td>Total Dispensed (Litres)</td><td><?php print $ml / 1000; ?></td><td>Litres</td></tr>
            <tr><td>Collected Data Over Days</td><td><?php print $alldays; ?></td><td>Days</td>

</table>
<div class="pad5"></div>

</div>
<br>
<div class="container">


<div><h1 class="subheadinds">ATO STATISTICS BY DAY</h1></div>
<table class="table table-bordered relaytbl softbox" style="">
            
            <tr><th>Date</th><th>Actuations</th><th>Litres</th></tr>

<?php

$stmt = $db->query("SELECT DATE_FORMAT(dateset, '%d-%m-%Y') AS day, COUNT(*) as total, SUM(value_1) as ml FROM event WHERE event='ato' GROUP BY DATE_FORMAT(dateset, '%d-%m-%Y') ORDER BY id DESC;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $formatdate = $row['day'];
        $formatdate = strtotime($formatdate);
        $formatdate= date("F j, Y",$formatdate);
print '<tr><td>';
print $formatdate.'</td><td>'. $row['total'] . '</td><td>'. $row['ml']/1000;
print '</td></tr>';
};

?>
</table>
<div class="pad5"></div>
</div>
</div>
</body>
</html>
