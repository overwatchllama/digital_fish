
<?php 
	include "connection.php";
  include "globals.php";
?>

<!-- <div class="container"> -->
  <!-- <div class="card"> -->
<div class="container" >
  <div id="phase"></div>
</div>
      


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
        $phase.load("phase-metrics.php");
        var refreshId = setInterval(function()
        {            
            $phase.load('phase-metrics.php');
        }, 200000);
    });
  })(jQuery);
</script>
<!-- </div> -->
<!-- </div> -->

