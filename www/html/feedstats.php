<!DOCTYPE html>
<html>
<head>
	<title>DigitalFish</title>
</head>
<body>
    <?php
        include "nav.php";
        include "connection.php";
    ?>

<div align="center">
<div class="maxcontent_width">
<form action="commit.php" method="POST">
    <input name="option" value="flushfeed" hidden>
    <div style="float: right; padding-right: 30px; padding-bottom: 5px;"><button class="btn btn-danger">Flush Feed Data</button></div>
</form>
<br><br>

<?php

$stmt = $db->query("SELECT COUNT(category) as feeds FROM alert where category='feed';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$feeds = $row['feeds'];
// print $feeds;/
// $ml = $row['ml'];
};

$stmt = $db->query("SELECT COUNT(*) as alldays FROM (select DISTINCT dateset_timeset from alert where category='feed') as totaldays;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$alldays = $row['alldays'];
};




?>


<table class="table table-bordered relaytbl softbox" style="">
            <th class="th-heading" colspan="3">Feed Statistics Overall</th><tr></tr>
            <tr><th>Category</th><th>Totals</th><th>Indicators</th></tr>
            <tr><td>Total Actuations</td><td><?php print $feeds; ?></td><td>Counts</td></tr>
            <tr><td>Collected Data Over Days</td><td><?php print $alldays; ?></td><td>Days</td></tr>




</table>


<table class="table table-bordered relaytbl softbox" style="">
            <th class="th-heading" colspan="3">Feed Statistics By Day</th><tr></tr>
            <tr><th>Date</th><th>Actuations</th></tr>

<?php

$stmt = $db->query("SELECT DATE_FORMAT(dateset_timeset, '%d-%m-%Y') AS day, COUNT(*) as total FROM alert WHERE category='feed' GROUP BY DATE_FORMAT(dateset_timeset, '%d-%m-%Y') ORDER BY id DESC;");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
print '<tr><td>';
print $row['day'] .'</td><td>'. $row['total'] . '</td>';
print '</td></tr>';
};

?>
</table>

</div>
</div>
</body>
</html>