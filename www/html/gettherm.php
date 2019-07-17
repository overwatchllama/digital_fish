

<style>
@-webkit-keyframes blinker {
  from {
    opacity: 1;
  }
  to {
    opacity: 0;
  }
}
.blink {
	color: lightgreen;
  text-decoration: blink;
  -webkit-animation-name: blinker;
  -webkit-animation-duration: 0.6s;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: ease-in-out;
  -webkit-animation-direction: alternate;
}


.therm {
	color: white;
	font-size: 2.5em;
	text-align: center;
}
.thermlabel{
	color:white;
}
.cardextra {
	background-color: #262b30 !important;
	/*width: 100%;*/
}
.card {	
	background-color: #262b30;
	 /*box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 2px 1px, inset #304701 0 -1px 2px, #ffffff 0 2px 30px;*/
}


</style>
<?php

include "connection.php";

$stmt = $db->query("SELECT state FROM digitalfish.codes WHERE code='thermtype';");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $thermtype = $row['state'];
};

 $labelarray = array();
    $thermarray = array();
      $stmtv = $db->query("SELECT * FROM thermconfig;");
        while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
          $label = $row['sensorname'];    array_push($labelarray, $label);
          $therm = $row['current_therm'];           
            if ($thermtype==0) {$therm=$therm*9/5+32; $therm=round($therm);};

          array_push($thermarray, $therm);
      };
    $collection = implode(',', $labelarray);
 ?>


	<div align="center">
 <?php
    foreach ($labelarray as $key => $value) {
    	print '    	
    	<div style="display: inline-table;">
    		<div class="card cardextra" style="width:150px;">
  				<div class="card-body">
    				<span class="blink">&#9673;&nbsp</span><span class="card-title thermlabel">'.$value.'</span>
    	    			<p class="card-text therm">'.$thermarray[$key].'&#730</p>
 				 </div>
			</div>
		</div>
		
    	'; };
?>
</div>
