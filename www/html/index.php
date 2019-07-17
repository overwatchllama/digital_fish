<?php
  include "nav.php";
  include "connection.php";
?>

<body>


<div class="contentpages"  style="display:none;">

<?php
if (isset($_GET['page'])) {

	if ($_GET['page']=="dashboard") {include "dashboard.php";};
    if ($_GET['page']=="phases") {include "phases.php";};
    if ($_GET['page']=="rssfeed") {include "rssfeed.php";};
    if ($_GET['page']=="filtration") {include "filtration.php";};
    if ($_GET['page']=="relays") {include "relayeditcard.php";};
    if ($_GET['page']=="relaystable") {include "relayedit-table.php";};
    if ($_GET['page']=="inhabitants") {include "inhabitants.php";};
    if ($_GET['page']=="inhabitants-edit") {include "inhab-edit.php";};
    if ($_GET['page']=="inhabitantsreport") {include "inhabitants_report.php";};  
    if ($_GET['page']=="evolution") {include "evolution.php";};
    if ($_GET['page']=="dosing") {include "relaymaster_dose.php";};
    if ($_GET['page']=="atostats") {include "atostats.php";};
    if ($_GET['page']=="atoconfig") {include "ato.php";};
    if ($_GET['page']=="home") {include "home.php";};
    if ($_GET['page']=="phaseconfig") {include "phase_sched_edit.php";};
    if ($_GET['page']=="thermgraphs") {include "thermgraphs.php";};
    if ($_GET['page']=="lddlights") {include "ldd.php";};
    if ($_GET['page']=="lddlightsgrid") {include "ldd-settings-grid.php";};
    if ($_GET['page']=="gpio") {include "gpio.php";};
    if ($_GET['page']=="services") {include "services.php";};
    if ($_GET['page']=="chemedit") {include "chem_edit.php";};
    if ($_GET['page']=="chemtable") {include "chem.php";};
    if ($_GET['page']=="thermedit") {include "thermedit.php";};
    if ($_GET['page']=="dash") {include "myguage.php";};
    if ($_GET['page']=="waterchange") {include "waterchange.php";};
    if ($_GET['page']=="wavemaker") {include "wavemaker.php";};
    if ($_GET['page']=="userconfig") {include "userconfig.php";};
    if ($_GET['page']=="chemread") {include "chem-read.php";};

} else {include "home.php";};

?>

</div>
  </body>
</html>

<script>
$(document).ready(function () {
    $('div.contentpages').fadeIn(200);
    // OR $('div.toshow').show(2200);
    // OR $('div.toshow').slideDown("slow");
});
</script>