fade.php


<div class="fade">
	Fader
</div>


 <script src="js/jquery.js"></script>

 <script>
$(document).ready(function () {
    $('div.fade').fadeIn(1500);
    // OR $('div.toshow').show(2200);
    // OR $('div.toshow').slideDown("slow");
});
</script>