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

<div id="card"> 
<!-- ******************** WHOLE CARD START ********************** -->
  <div class="front"> 
    	<div class="cardfront">
    	
      <table border="0" width="100%">
    		<td><div align="center"><h1>DigitalFish HUD</h1></div></td>
        <tr></tr>
    		<td><div align="center">Current Phase:&nbsp <?php $phase  = ucfirst($phase); print $phase; ?></div></td>
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
			    <div class="wrapper clear">
			        <!-- <div id="g1" class="gauge"></div> -->
			        <!-- <div id="g2" class="gauge"></div> -->
			        <!-- <div id="g3" class="gauge"></div> -->
		    	</div>
		    	<!-- *** GUAGES ***	 -->
    	</div>
  	</div> 
<!-- ******************* BACK CARD START *********************** -->
  <div class="back">
  	<div align="center" class="cardback">
	    <h1>Manual Relay Control</h1>
	  
      	<?php 
	    	$stmtv = $db->query("SELECT * FROM relay_master WHERE auto=0");
    

    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	$buttonname =  $row['name'];
    	$id = $row['id'];
      // print $id;
    	print '<button class="buttonstyle1" type="button" value="'.$id.'" onclick="dosomething(this.value)">'.$buttonname.'</button>';
    };
    	?>
      
<br><br>
<div style="" class="scoreBoardrelay" align="center"></div>

	    	 
		</div>
  	</div>   
    <!-- ******************* BACK CARD END *********************** -->

<!-- ******************** WHOLE CARD END ********************** -->
</div>


<br>
<div>
</div>
<button onclick="flipit()" class="buttonstyle2">FLIP</button>
</body>

<!-- **************************** Guages Script Start **************************** -->

    <script src="js/justgauge/raphael-2.1.4.min.js"></script>
    <script src="js/justgauge/justgage.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var g1, g2, g3;

        var g1 = new JustGage({
            id: "g1",
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

<!-- **************************** Guages Prep Start **************************** -->
<script type="text/javascript">
	$("#card").flip({
  trigger: 'manual'
});

</script>

<script>
function flipit() {
$("#card").flip('toggle');
}
</script>

<!-- **************************** Guages Prep END **************************** -->
<!-- <input type="button" value="5" onclick="dosomething(this.value)"> -->
<!-- <input type="button" value="6" onclick="dosomething(this.value)"> -->

<script>
function dosomething(val){
    $.get("lcdmonitor-template-submit.php?data="+val)
}
</script>


<!-- ****** PULL TEMPERATURE CONSTANTLY ****** -->
<script type="text/javascript">
  setInterval( refreshScoreBoard, 1000 );
  var inRequest = false;
  function refreshScoreBoard() {
    if ( inRequest ) {
      return false;
    }
    inRequest = true;
    var load = $.get('lcdmonitor-template-pulltemp.php');
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



<!-- ****** PULL STATE CONSTANTLY ****** -->
<script type="text/javascript">
  setInterval( refreshscoreBoardrelay, 500 );
  var inRequestB = false;
  function refreshscoreBoardrelay() {
    if ( inRequestB ) {
      return false;
    }
    inRequestB = true;
    var load = $.get('pullrelaystate.php');
    $(".scoreBoardrelay");
    load.error(function() {
      console.log( "Error" );
      // do something here if request failed
    });
    load.success(function( res ) {
      console.log( "Success" );
      $(".scoreBoardrelay").html('<table>'+res+'</table>');
    });
    load.done(function() {
      console.log( "Completed" );
      inRequestB = false;
    });
  }
</script>
<!-- ****** PULL STATE CONSTANTLY END ****** -->