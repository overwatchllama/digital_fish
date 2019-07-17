<head>
<script src="js/raphael-2.1.4.min.js"></script>
<script src="js/justgage.js"></script>
<link rel="stylesheet" type="text/css" href="css/lcd.css">
<style type="text/css">
  .guage {
    width:200px; height:200px;
    display: inline-table;
    padding-bottom: -50px;
    margin-top: -20px;
    
  }
table {
  /*margin-top: -30px;*/
}
.row {
  margin-right: 5px;
  margin-left: 5px;
}
</style>

<!-- <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script> -->
<!-- <div class="container"> -->
<div align="center" style="position:absolute;top:0px; width: 100%;">
  <div align="center" class="topbackground" style="margin-top: 60px;"><div id="phase"></div></div>
<?php
include "connection.php";


$stmt = $db->query("SELECT state FROM digitalfish.codes WHERE code='thermtype';");
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $thermtype = $row['state'];
};

?>
<br>
<div class="row" style="margin-bottom: 5px;">
  <div class="col-sm-12"> <!-- ROW1 -->
    <div id="gettherm"></div>
  </div>
</div>
<br>

<div class="row" style="margin-left:-9px !important;">
  <div class="col-sm-12">
    <div align="center" class="fixed-bottom bottombackground"><div id="getpiinfo" style="margin-right:-14px !important;"></div>
    </div>
  </div>
</div>
<br>

<div class="row" style="margin-left:-9px !important;">
  <div class="col-sm-12">
    <div id="getfilters" style="margin-right:-14px !important;">
    </div>
  </div>
</div>
<br><br>

<?php

function barhealth($health_percent) {
        $health_percent_realvalue = intval($health_percent);
        $health_percent = intval($health_percent);
        if ($health_percent >= 100) {$health_percent = 100;};
        if ($health_percent >= 0  ) $rankhealth = '<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%">&nbsp'.$health_percent.'%</div></div>';
        if ($health_percent >= 20 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
        if ($health_percent >= 50 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-info" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
        if ($health_percent >= 61 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-warning" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent.'%</div></div>';
        if ($health_percent >= 80 ) $rankhealth = '<div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width:'.$health_percent.'%">'.$health_percent_realvalue.'%</div></div>';
        return $rankhealth;
  };


 $waterchangepercent='<div id="getwaterchange" ></div>';
 print $waterchangepercent;
?>





  <script type="text/javascript">
  (function($)
  {
   $(document).ready(function()
  {
    $.ajaxSetup(
       {
           cache: false,
           
            success: function() {                
                $('#phase').show();
            }
        });
        var $phase = $("#gettherm");
        $phase.load("gettherm.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('gettherm.php');
            delete $phase;

        }, 2000);
        delete refreshId;

    });
  })(jQuery);
</script>

 <script type="text/javascript">
  (function($)
  {
   $(document).ready(function()
  {
    $.ajaxSetup(
       {
           cache: false,
           beforeSend: function() {
                $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#content').show();
            },
            success: function() {                
                $('#getpiinfo').show();
            }
        });
        var $phase = $("#getpiinfo");
        $phase.load("getpiinfo.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('getpiinfo.php');
        }, 5000);
    });
  })(jQuery);
</script>



<script type="text/javascript">
  (function($)
  {
   $(document).ready(function()
  {
    $.ajaxSetup(
       {
           cache: false,
           beforeSend: function() {
                $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                $('#content').show();
            },
            success: function() {                
                $('#getfilters').show();
            }
        });
        var $phase = $("#getfilters");
        $phase.load("getfilters.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('getfilters.php');
        }, 5000);
    });
  })(jQuery);
</script>



  <script type="text/javascript">
  (function($)
  {
   $(document).ready(function()
  {
    $.ajaxSetup(
       {
           cache: false,
           beforeSend: function() {
                // $('#content').hide();
                $('#loading').show();
            },
            complete: function() {
                $('#loading').hide();
                // $('#content').show();
            },
            success: function() {                
                $('#phase').show();
            }
        });
        var $phase = $("#phase");
        $phase.load("getphase.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('getphase.php');
        }, 2000);
    });
  })(jQuery);
</script>


<script type="text/javascript">
  (function($)
  {
   $(document).ready(function()
  {
    $.ajaxSetup(
       {
           cache: false,          
            success: function() {                
                $('#getwaterchange').show();
            }
        });
        var $phasec = $("#getwaterchange");
        $phasec.load("getwaterchange.php");
        var refreshId = setInterval(function()
        {            
            $phasec.load('getwaterchange.php');
            delete $phasec;
        }, 30000);
        delete refreshId;
    });
  })(jQuery);
</script>


<br>
<div style="color:white;">NOTE: Pi 7inch LCD status screen can be found on http://x.x.x.x/lcd.php</div>


