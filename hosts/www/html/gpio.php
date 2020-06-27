

<div class="container">
<h1 class="headinds">GPio Duplicate Check</h1>

<p>Below are a listing of all the GPio's configured across the site.  It's important to not have duplicate GPIO's.  This can often lead to equipment not functioning as it should.  If you have any duplicates you would have seen a pop up warning you about this.  Naturally it doesnt hurt to have a good look and ensure that this is not the case.
</p>







<?php
include "connection.php";

global $allgpio;
$allgpio = array();
print '

<table class="table table-hover ">
<tbody>
<tr><td colspan="2"><div><h3 class="headinds">General GPio Assignments</h3></div></td></tr>
<tr><td><strong>Name</strong></td><td><strong>GPIO</strong></td></tr>

';


$stmtv = $db->query("SELECT gpio,switchgpio,failswitchgpio,resevoirgpio FROM ato_relay where id=1");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	$ato_gpio = $row['gpio'];array_push($allgpio, $ato_gpio);
            if ($ato_gpio == "0") {$ato_gpio="<strong>Disabled</strong>";};
    	$ato_switchgpio = $row['switchgpio'];array_push($allgpio, $ato_switchgpio);
            if ($ato_switchgpio == "0") {$ato_switchgpio="<strong>Disabled</strong>";};
    	$ato_failswitchgpio = $row['failswitchgpio'];array_push($allgpio, $ato_failswitchgpio);
            if ($ato_failswitchgpio == "0") {$ato_failswitchgpio="<strong>Disabled</strong>";};
        $ato_resevoirgpio = $row['resevoirgpio']; array_push($allgpio, $ato_resevoirgpio);
            if ($ato_resevoirgpio == "0") {$ato_resevoirgpio="<strong>Disabled</strong>";};

    };

$stmtv = $db->query("SELECT gpio, ledgpio FROM generic_devices where id=1");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	$feedbutton_gpio = $row['gpio'];array_push($allgpio, $feedbutton_gpio);
            if ($feedbutton_gpio == "0") {$feedbutton_gpio="<strong>Disabled</strong>";};
    	$feedbutton_ledgpio = $row['ledgpio'];array_push($allgpio, $feedbutton_ledgpio);
            if ($feedbutton_ledgpio == "0") {$feedbutton_ledgpio="<strong>Disabled</strong>";};
    };

    $stmtv = $db->query("SELECT gpio from generic_devices where id=2");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	$feedrelay_gpio = $row['gpio'];array_push($allgpio, $feedrelay_gpio);
            if ($feedrelay_gpio == "0") {$feedrelay_gpio="<strong>Disabled</strong>";};
    };

 $stmtv = $db->query("SELECT gpio from relay_wave where id=1");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	$wave_a_gpio = $row['gpio'];array_push($allgpio, $wave_a_gpio);
        if ($wave_a_gpio == "0") {$wave_a_gpio="<strong>Disabled</strong>";};

    };
    
     $stmtv = $db->query("SELECT gpio from relay_wave where id=2");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	$wave_b_gpio = $row['gpio'];array_push($allgpio, $wave_b_gpio);
            if ($wave_b_gpio == "0") {$wave_b_gpio="<strong>Disabled</strong>";};
    };

    
$collectname = array();
$collectgpio = array();

$stmtv = $db->query("SELECT name, gpio FROM relay_master");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	array_push($collectname, $row['name']);
        array_push($collectgpio, $row['gpio']);
        array_push($allgpio, $row['gpio']);
    };

$collectname_dose = array();
$collectgpio_dose = array();
$stmtv = $db->query("SELECT description, gpio FROM relay_dose;");
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
        array_push($collectname_dose, $row['description']);
        array_push($collectgpio_dose, $row['gpio']);
        array_push($allgpio, $row['gpio']);
    };

// print_r($allgpio);

// foreach ($allgpio as $key => $value) {
//     print $value;
//     # code...
// };

$count=0;
function validategpio($x,$y){
    if ($y==0) {;} else {
    if (count(array_keys($x, $y))>1) {return '<font style=";background-color: yellow; padding:2px;margin:2px;">Duplicate</style>';};
};
    };




$ato_gpio_answer = validategpio($allgpio,$ato_gpio);

$ato_switchgpio_answer = validategpio($allgpio,$ato_switchgpio);
$ato_failswitchgpio_answer = validategpio($allgpio,$ato_failswitchgpio);
$ato_resevoirgpio_answer = validategpio($allgpio,$ato_resevoirgpio);

$feedbutton_gpio_answer = validategpio($allgpio,$feedbutton_gpio);
$feedbutton_ledgpio_answer = validategpio($allgpio,$feedbutton_ledgpio);

$wave_a_gpio_answer = validategpio($allgpio,$wave_a_gpio);
$wave_b_gpio_answer = validategpio($allgpio,$wave_b_gpio);

$feedbutton_gpio_answer = validategpio($allgpio,$feedbutton_gpio);
$feedbutton_ledgpio_answer = validategpio($allgpio,$feedbutton_ledgpio);
$feedrelay_gpio_answer = validategpio($allgpio,$feedrelay_gpio);


print'
<tr><td>ATO GPio</td><td>'.$ato_gpio.$ato_gpio_answer.'</td></tr>
<tr><td>ATO Switch GPio</td><td>'.$ato_switchgpio.$ato_switchgpio_answer.'</td></tr>
<tr><td>ATO Fail Switch</td><td>'.$ato_failswitchgpio.$ato_failswitchgpio_answer.'</td></tr>
<tr><td>ATO Resevoir Fail Switch</td><td>'.$ato_resevoirgpio.$ato_resevoirgpio_answer.'</td></tr>

<!-- <tr><td>Feed Button</td><td>'.$feedbutton_gpio.$feedbutton_gpio_answer.'</td></tr>
<tr><td>Feed Button LED</td><td>'.$feedbutton_ledgpio.$feedbutton_ledgpio_answer.'</td></tr> -->

<tr><td>Wave A GPio</td><td>'.$wave_a_gpio.$wave_a_gpio_answer.'</td></tr>
<tr><td>Wave B GPio</td><td>'.$wave_b_gpio.$wave_b_gpio_answer.'</td></tr>

<tr><td>Feed Button GPio</td><td>'.$feedbutton_gpio.$feedbutton_gpio_answer.'</td></tr>
<tr><td>Feed Button LED GPio</td><td>'.$feedbutton_ledgpio.$feedbutton_ledgpio_answer.'</td></tr>
<tr><td>Feed Relay GPio</td><td>'.$feedrelay_gpio.$feedrelay_gpio_answer.'</td></tr>
<tr><td colspan="2"><div><h3 class="headinds">Relay GPio Assignments</h3></div></td></tr>
<tr><td><strong>Name</strong></td><td><strong>GPIO</strong></td></tr>
';





global $validateresult;
foreach ($collectgpio as $key => $value) {
	$name = ($collectname[$key]);
	$gpio = ($collectgpio[$key]);

if (count(array_keys($allgpio, $gpio)) > 1) 
{ $validateresult = '<font style=";background-color: yellow; padding:2px;margin:2px;">Duplicate</style>'; };
    
    if ($gpio == "0") {$gpio="<strong>Disabled</strong>";$validateresult="";};
	print '<tr><td>'.$name .'</td><td>'. $gpio.$validateresult.'</td></tr>';
    $validateresult = "";
	# code...
};
print '<tr><td colspan="2"><div><h3 class="headinds">Dose GPIO Assignments</h3></div></td></tr>';
print '<tr><td><strong>Name</strong></td><td><strong>GPIO</strong></td></tr>';

foreach ($collectgpio_dose as $key => $value) {
    $name = ($collectname_dose[$key]);
    $gpio = ($collectgpio_dose[$key]);

    if (count(array_keys($allgpio, $gpio)) > 1) 
    { $validateresult = '<font style=";background-color: yellow; padding:2px;margin:2px;">Duplicate</style>'; };
    
    if ($gpio == "0") {$gpio="<strong>Disabled</strong>";$validateresult="";};
    print '<tr><td>'.$name .'</td><td>'. $gpio.$validateresult.'</td></tr>';
    $validateresult = "";
    # code...
};




print'
</tbody>
</table>
';


?>
<br>

</div>

