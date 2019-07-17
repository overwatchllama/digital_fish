
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/verticalTabs.css">
<script src="js/bootstrap.min.js>"></script>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<div class="container">
	<div class="tab">
	  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">London</button>
	  <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
	  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
	</div>

	<div id="London" class="tabcontent">
	  <h3>London</h3>
	  <p>London is the capital city of England.</p>
	</div>

	<div id="Paris" class="tabcontent">
	  <h3>Paris</h3>
	  <p>Paris is the capital of France.</p> 
	</div>

	<div id="Tokyo" class="tabcontent">
	  <h3>Tokyo</h3>
	  <p>Tokyo is the capital of Japan.</p>
	</div>
</div>


<script>
function openCity(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
     
</body>
</html> 
