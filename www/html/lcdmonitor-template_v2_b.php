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


<!-- ******************** WHOLE CARD START ********************** -->
  
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
<!-- </div> -->


<br>
<div>
</div>
<a href="lcdmonitor-template_v2.php"><button class="buttonstyle2">HOME</button></a>
</body>





</html>


<script>
function dosomething(val){
    $.get("lcdmonitor-template-submit.php?data="+val)
}
</script>


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