<?php
include "connection.php";
if (isset($_GET['message'])){
$message = $_GET['message'];
};
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add LDD Light Channel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        	<form action="submit.php" method="POST">
    	<input name="option" value="addlddname" hidden>
        <h6 class="text-left">LDD Name<input class="form-control" name="name" required></h6>
        <h6 class="text-left">Channel No<input class="form-control" name="channel" required placeholder="Choose 0-15"></h6>
      </div>
	<?php
	$stmt = $db->query("SELECT channel from ledim GROUP by channel;");
	print '<div class="alert alert-warning" role="alert">Channels in use: ';
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { print $row['channel'].', '     ;};
	print '</div>';
	?>
      <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        		<button type="submit" class="btn btn-primary">Save changes</button>
    		</form>
      </div>
       </div>
  </div>
</div>


<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="deleteRelay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete A Relay</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
<form action="submit.php" method="POST">
	<input name="option" value="deleteldd" hidden>

<h6 class="text-left">Select LDD To Delete</h6></h6><select name="deleteid" class="form-control">
<?php
$stmt = $db->query("SELECT * FROM digitalfish.ledim_name;");
		
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
				$name = $row['name'];
				print '<option value='.$id.'>'.$name.'</option>';
			};

?>
</select>
<hr>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-danger">Delete Relay</buttton>
</form>
      </div>
    </div>
  </div>
</div>




<div class="container">
<h1 class="headinds">LDD PWM Lights</h1>

<p>
<div class="btn-group" role="group" aria-label="Basic example">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Add LDD</button>
	<button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#deleteRelay">Delete LDD</button>
</div>
</p>

<?php
$stmt = $db->query('SELECT * FROM digitalfish.ledim_name;');
    print '<table class="table">';
    print '<th>LDD Name</th><th></th>';
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$id = $row['id'];
$name = $row['name'];
print '<tr><td>'.$name.'</td><td><button type="button" class="btn btn-success" onclick="location.href=\'ldd-settings.php?id='.$id.'\'">Configure</button></td></tr>';
};
print '</table>';

?>


	
	<div class="card">
	  <div class="card-header">
	    Light Functions
	  </div>
	  <div class="card-body">
	  	<p class="card-text">
	    	<form action="submit.php" method="POST">
				<input name="option" value="resetlddnow" hidden>
				<button  class="btn btn-warning" type="submit">Reset Lights</button>
			</form>
	    </p>
	    
	  </div>

	 <div align="center"><?php if(isset($message)){ print $message;}; ?></div>
	</div>

<br>
</div>
