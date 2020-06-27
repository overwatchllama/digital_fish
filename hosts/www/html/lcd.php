<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/lcd.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fa/css/fontawesome-all.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/raphael-2.1.4.min.js"></script>
    <!-- <script src="js/justgage.js"></script> -->

<style type="text/css">
.bottombackground {
  background-color: #590800;
}

.topbackground {
  background-color: #122f63;
}


.topbottomfont {
  color: #fff;
  font-size: 1.0em;
}
    .guage {
        width:170px; height:170px;
        display: inline-table;
        /*padding-bottom: -50px;*/
        margin-top: -10px;
    }

    body {
    	margin-top: 10px !important;
      background-color: black;

     }

    .row {
      margin-right: 10px !important;
      margin-left: 10px !important;
    }

    .card {
      margin: 5px;
      color: #fff;
    }

    .lcdborder {
      margin-top: 10px;
      /*border-color: white;*/
      border-style: solid; 
      border-color: white;
      border-radius: 20px;
      margin-right: 10px;
      margin-left: 10px;
      min-height: 460px;
      /*padding-left: 10px;*/
      /*border-color: white;*/
      box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #304701 0 -1px 9px, #89FF00 0 2px 50px;
    }
        
    table {
      /*margin-top: -20px;*/
      }
</style>

<?php
include "connection.php";
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


  $stmt = $db->query("SELECT state FROM digitalfish.codes WHERE code='thermtype';");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $thermtype = $row['state'];
  };

?>
<!-- TOP -->
<div align="center" class=" fixed-top topbackground"><div id="phase" class="topbottomfont"></div></div>
<div style="padding: 20px;"></div>
<!-- TOP -->

<div class="row" style="margin-bottom: 5px;">
  <div class="col-sm-12"> <!-- ROW1 -->
    <div id="gettherm"></div>
  </div>
</div>

<div class="row" >
  <div class="col-sm-12">
    <div id="getfilters"></div>
    </div>
  </div>
</div>



<style type="text/css">

</style>

<!-- <div class="row" style="position: absolute; bottom:20%;"> -->
  <!-- <div class="col-sm-12"> -->
<!-- <div style="position: absolute; bottom:20%;"> -->
<div style="position:absolute;min-width: 100%;bottom: 17%;">
<?php
 $waterchangepercent='<div id="getwaterchange" ></div>';
 print $waterchangepercent;
?>
</div>
  <!-- </div> -->
  
<style type="text/css">
 

.fullwidth {
width:200px;
margin-left:0;
margin-right:0;
padding-left:0;
padding-right:0;
display:block;
text-align:center; /*This will result in centering the link text, which is probably what you want -brianjohnsondesign.com*/
}

</style>    
  

<!-- </div> -->

<!-- <div style="background-color: black; width: 100%; margin-top: 5px;padding: 5px; border-radius: 5px;"><a href="lcd2.php"><button class="btn">MANUAL RELAYS</button></a></div> -->

<div class="row" style="position: absolute; bottom:40;">
     <button class="btn btn-default" onclick="window.location='lcd2.php';">Manual Relays</button>
</div>

<!-- BOTTOM -->
  <div style="padding: 20px;"></div>
  <div align="center" class="fixed-bottom bottombackground"><div class="topbottomfont" id="getpiinfo"></div></div>
<!-- BOTTOM -->


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
           
            success: function() {                
                $('#phase').show();
            }
        });
        var $phase = $("#phase");
        $phase.load("getphase.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('getphase.php');
            delete $phase;

        }, 30000);
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
           
            success: function() {                
                $('#getpiinfo').show();
            }
        });
        var $phaseb = $("#getpiinfo");
        $phaseb.load("getpiinfo.php");
        var refreshId = setInterval(function()
        {            
            $phaseb.load('getpiinfo.php');
            delete $phaseb;
        }, 30000);
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
            success: function() {                
                $('#getfilters').show();
            }
        });
        var $phasec = $("#getfilters");
        $phasec.load("getfilters.php");
        var refreshId = setInterval(function()
        {            
            $phasec.load('getfilters.php');
            delete $phasec;
        }, 30000);
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


 

<style type="text/css">
.progress {
            height: 30px !important;
            width: 100px;
            /*font-size: 0.8em !important;*/
            background-color: #555555;
        }
</style>

 