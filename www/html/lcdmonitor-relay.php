


<style type="text/css">
.onn {
	min-height: 10px;
	min-width: 10px;
	background-color: green;
	border-radius: 5px;
	color: yellow;
	padding: 5px;
	margin-bottom: 10px;
}

.offf {
	min-height: 10px;
	min-width: 10px;
	background-color: grey;
	/*color: yellow;*/
	border-radius: 5px;
	padding: 5px;
	margin-bottom: 10px;
}

body {
	margin-top: 50px;
	background-color: black;
}

table {
	/*background-color: red;*/
}

	table td input, table td, table th{
		/*padding: 3px !important;*/
	}
.btncustom { 
	min-width: 150px !important;
	min-height: 60px !important;
	background-color:  #262b30;
	/*border-style: 1px solid !important;*/
	color: white;
	border-radius: 5px;
	margin-bottom: 20px;

}

</style>

<!-- <div class="surround"> -->
<div align="center">
<table border="0" width="100px;">
	<!-- <tr><th colspan="2" style="color:white;"><h3>MANUAL RELAYS</h3></th></tr> -->

<?php
include "connection.php";
$count = 1;
print '<tr>';
$stmt = $db->query("SELECT * FROM relay_master where auto=0 ORDER BY name;");
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
				$buttonname =  $row['name'];
				$name = $row['name'];
				$state = $row['state'];
				if ($count > 3) {$tr='<tr>';$slashtr='</tr>';$count=0;} else { $tr='';$slashtr='';};
				$count++;

				if ($state == 1) {
				
				print '<td><div class="onn">POWER ON</div>
				<div class=""></div><button class="btn btncustom" type="button" value="'.$id.'" onclick="dosomething(this.value)">'.$buttonname.'</button></td>'.$slashtr.'';
					}
				else {
					
					print '<td><div class="offf">POWER OFF</div><button class="btn btncustom" type="button" value="'.$id.'" onclick="dosomething(this.value)">'.$buttonname.'</button></td>'.$slashtr.'';
				// if ($count > 6) {$count=1;};
				};
				// print '<td><button class="btn lcdobjectwidth" type="button" value="'.$id.'" onclick="dosomething(this.value)">'.$buttonname.'</button></td><tr>';

		};

?>

</table>
</div>
<!-- </div> -->

<script>
function dosomething(val){
    $.get("lcdmonitor-submit-relay.php?data="+val)
}
</script>
