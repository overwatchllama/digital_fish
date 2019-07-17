<!DOCTYPE html>
<html>
<head>
    <title>
        DigitalFish
    </title>
    <?php
        include "nav.php";
        include "connection.php";
        include "global.php";



    ?>

</head>
<body>
<div class="container">	
<div align="center">
<div class="maxcontent_width">
<?php
$savedstatus = $_GET['savedstatus'];
if ($savedstatus == 1) {$savedstatus = "Saved";} else {$savedstatus ="";};

$stmt = $db->query('SELECT * FROM digitalfish.generic_devices WHERE device="feedrelay";');
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$relay_gpio = $row['gpio'];
		$relay_polarity = $row['polarity'];
		$pulse = $row['pulse'];
		$pulsetime = $row['pulsetime'];

		};

$stmt = $db->query('SELECT * FROM digitalfish.generic_devices WHERE device="feed";');
   while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$feedbutton_gpio = $row['gpio'];
		$feedbutton_ledgpio = $row['ledgpio'];
		};


print '
<table class="table table-bordered relaytbl softbox" style="width: 300px;">
            <th class="th-heading" colspan="2">Feeder Settings</th><tr></tr>
<form action="commit.php" method="POST">
<input name="option" value="feedsettings"  hidden>
	
	<tr><td>Feed Button Gpio(<strong>Required</strong>)<input class="form-control" type="number" name="feedbuttongpio" value="'.$feedbutton_gpio.'" ></td></tr>
	
	<tr><td>Feed LED GPio (<strong>Required</strong>) <input class="form-control" type="number" name="feedbuttongpioled" value="'.$feedbutton_ledgpio.'" ></td></tr>
	
	<tr><td>Feed Relay Gpio<input class="form-control" type="number" name="feedrealygpio" value="'.$relay_gpio.'"></td></tr>

	<tr><td>Polarity(0 or 1)<input class="form-control" type="number" name="polarity" value="'.$relay_polarity.'"></td></tr>
	<tr><td>Pulse Relay Amount<input class="form-control" type="number" name="pulse" value="'.$pulse.'"></td></tr>
	<tr><td>Pulse Relay Duration (seconds)<input class="form-control" type="number" name="pulsetime" value="'.$pulsetime.'"></td></tr>
	

	<tr><td span="2">Some relay boards are in the on state by default, you can use this setting to reverse that action. If you wish to DISABLE any of the GPio options enter 0.</td></tr>
	
	<tr><td><button class="btn" type="submit"> Save</button> '.$savedstatus.'

</form>

';

$compiled_url = $url.$port.'/?username='.$username.'&password='.$password;
?>
<div style="float: right;"> <?php help(4); ?></div></td></tr>
</table>
</div>
</div>
</div>
</body>
</html>



