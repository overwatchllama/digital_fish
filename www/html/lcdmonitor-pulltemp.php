
<style type="text/css">
	td {
		padding-left: 10px;
	}
      .fontsize {
            font-size: 4em;
            padding-top: 40px;
      }
</style>

<?php

include "connection.php";

 $stmt = $db->query("SELECT * FROM codes where code='thermtype';");
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    global $thermtype;
                                    $thermtype = $row['state'];
                                  
                                    };

print '<div class="fontsize" align="center"><table width="" border="0">';
$stmt = $db->query("SELECT * FROM thermconfig;");
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$temperature = $row['current_therm'];
if ($thermtype == 0) {$temperature = $temperature * 9 /5 + 32;};
// if ($thermtype == 1) {$temperature = $temperature ;};

print'<tr><td width="">';
print $row['sensorname'];
print'</td><td align="left">';
print '<strong>'.$temperature. "</strong><br>";
print'</td></tr>';
     
                               };
print '</table></div>';

                               ?>

