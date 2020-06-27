
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/lcd.css">
<!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="css/fa/css/fontawesome-all.min.css"> -->
<script src="js/jquery.js"></script>
<!-- <script src="js/raphael-2.1.4.min.js"></script> -->
<!-- <script src="js/justgage.js"></script> -->
<style type="text/css">

.row {
  margin-right: 10px !important;
  margin-left: 10px !important;
}

.card {
  margin: 5px;
}

.topbackground {
  background-color: #122f63;
  color: white;
}


    
  }
table {
  margin-top: 100px;
}

</style>

<!-- <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script> -->
<!-- <div class="container"> -->
<body>

    <?php
    include "connection.php";


?>

<div align="center" class=" fixed-top topbackground">Manual Relays</div>

<div id="getlcdrelay"></div>



<div style="position:absolute;min-width: 100%;bottom: 35px;"><div style="margin-left: 10px;"><button class="btn btn-default" onclick="window.location='lcd.php';">Dashboard</button></div></div>
</body>
<div align="center" class="fixed-bottom bottombackground"><div class="topbottomfont" id="getpiinfo"></div></div>
<script>
function dosomething(val){
    $.get("lcdmonitor-submit-relay.php?data="+val)
}
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
                $('#getlcdrelay').show();
            }
        });
        var $phase = $("#getlcdrelay");
        $phase.load("lcdmonitor-relay.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('lcdmonitor-relay.php');
        }, 1000);
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




 