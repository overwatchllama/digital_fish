<!DOCTYPE html>
<html>
<head>
	<title></title>
 <link href="https://fonts.googleapis.com/css?family=Julius+Sans+One" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/lcd.css">
  
    
	<!-- <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> -->
  <script src="js/jquery.js"></script>
	<script src="js/flip.js"></script>
        
<?php
        include "connection.php";
        include "global.php";
?>

</head>
<datafetch>
</datafetch>

<body>

<!-- <div id="card">  -->
<!-- ******************** WHOLE CARD START ********************** -->
 
    	<div class="cardfront">
    	
      <table border="0" width="100%">
    		<td><div align="center"><h1>DigitalFish HUD</h1></div></td>
        <tr></tr>
    		<td><div align="center">Current Phase:&nbsp <?php $phase  = ucfirst($phase); print $phase; 
            print '<br>';
            if ($phase == "Sunrise") {print $sunrise;}; 
            if ($phase == "Morning") {print $morning;}; 
            if ($phase == "Daytime") {print $daytime;}; 
            if ($phase == "Sunset") {print $sunset;}; 
            if ($phase == "Night") {print $night;}; 
            if ($phase == "Nolight") {print $nolight;}; 
            

            ?></div></td>
    		<tr></tr>
    		<td colspan="2">
        <div style="font-size: 2em;" class="scoreBoard" align="center"></div>
    		    <!-- <div class="cardminiheader"></div> -->
			    <!-- <div class="cardmini">25 C</div> -->
			    <!-- <div class="cardminiheader"></div> -->
			    <!-- <div class="cardmini">25 C</div> -->
			</td>
		</table>
		
			    <!-- *** GUAGES ***	 -->
			    <!-- <div class="wrapper clear"> -->
			        <!-- <div id="g1" class="gauge"></div> -->
			        <!-- <div id="g2" class="gauge"></div> -->
			        <!-- <div id="g3" class="gauge"></div> -->
		    	<!-- </div> -->
		    	<!-- *** GUAGES ***	 -->
    	</div>
 	
<!-- ******************** WHOLE CARD END ********************** -->
<!-- </div> -->


<br>
<div>
</div>
<a href="lcdmonitor-relays.php"><button class="buttonstyle2">MANUAL RELAYS</button></a>
</body>

<!-- **************************** Guages Script Start **************************** -->

    <script src="js/justgauge/raphael-2.1.4.min.js"></script>
    <script src="js/justgauge/justgage.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var g1, g2, g3;

        var g1 = new JustGage({
            id: "g1",
            value: (100),
            min: 0,
            max: 100,
            title: "Very long title",
            titleFontColor: "white",
            valueFontColor: "white",
            relativeGaugeSize: true,
            pointer: true,
            donut: false
        });

        var g2 = new JustGage({
            id: "g2",
            value: getRandomInt(0, 100),
            min: 0,
            max: 100,
            title: "Very long title",
            titleFontColor: "white",
            valueFontColor: "white",
            relativeGaugeSize: true,
            pointer: true,            
            donut: false
        });

        // var g3 = new JustGage({
        //     id: "g3",
        //     value: getRandomInt(0, 100),
        //     min: 0,
        //     max: 100,
        //     title: "Very long title",
        //     titleFontColor: "white",
        //     valueFontColor: "white",
        //     label: "label",
        //     relativeGaugeSize: true,
        //     pointer: true,
        //     donut: false
        // });
    });
    </script>

<!-- **************************** Guages Script End **************************** -->








</html>

<!-- <script>
function dosomething(val){
    $.get("lcdmonitor-template-submit.php?data="+val)
}
</script> -->


<!-- ****** PULL TEMPERATURE CONSTANTLY ****** -->
<script type="text/javascript">
  setInterval( refreshScoreBoard, 1000 );
  var inRequest = false;
  function refreshScoreBoard() {
    if ( inRequest ) {
      return false;
    }
    inRequest = true;
    var load = $.get('lcdmonitor-pulltemp.php');
    $(".scoreBoard");
    load.error(function() {
      console.log( "Error" );
      // do something here if request failed
    });
    load.success(function( res ) {
      console.log( "Success" );
      $(".scoreBoard").html('<table>'+res+'</table>');
    });
    load.done(function() {
      console.log( "Completed" );
      inRequest = false;
    });
  }
</script>
<!-- ****** PULL TEMPERATURE CONSTANTLY END ****** -->

