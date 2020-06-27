 
  <link rel="stylesheet" type="text/css" href="css/lcd.css">
  <script src="js/jquery.js"></script>
<?php
        include "connection.php";
        // include "global.php";
?>
 
<!-- ******************* BACK CARD START *********************** -->

	      
      	<?php 
	    	$stmtv = $db->query("SELECT * FROM relay_master WHERE auto=0 ORDER BY name");
        while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
          $buttonname =  $row['name'];
    	   $id = $row['id'];
 print '<button style="width:210px; height:50px;" type="button" value="'.$id.'" onclick="dosomething(this.value)">'.$buttonname.'</button>';
          };
    	?>
      

     <div style="" class="scoreBoardrelay"></div>



<script>
function dosomething(val){
    $.get("lcdmonitor-submit-relay.php?data="+val)
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
    var load = $.get('lcdmonitor-relay.php');
    $(".scoreBoardrelay");
    load.error(function() {
      console.log( "Error" );
      // do something here if request failed
    });
    load.success(function( res ) {
      console.log( "Success" );
      $(".scoreBoardrelay").html(res);
    });
    load.done(function() {
      console.log( "Completed" );
      inRequestB = false;
    });
  }
</script>
<!-- ****** PULL STATE CONSTANTLY END ****** -->