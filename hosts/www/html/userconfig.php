<?php
include "connection.php";


$stmt = $db->query('SELECT * FROM users where id=1;');
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$username = $row['email'];
$password = $row['password'];
};

print "Hello";


?>
<form action="submit.php" method="POST">
	<input name="option" value="adminaccount" hidden>

<div class="container">

	<div class="card text-dark bg-light mb-3" style="min-width: 18rem; margin:5px;">
			<div class="card-header text-white bg-dark">Admin Account</div>
				<div class="card-body">
					<p class="card-text">
				    	<table>
							<tr>
								<td>Username</td>
								<td><input class="form-control" type="" name="username" value="<?php print $username;?>"></td><td></td>
							</tr>
				    		<tr>
				    			<td>Password</td>
				    			<td><input class="form-control" type="" name="password" value="<?php print $password;?>"></td><td></td>
				    		</tr>
				    	</table>
					</p>
				</div>
<hr>
	<div align="right"><button type="submit" class="btn btn-success" style="margin-right:10px;width:100px;">Save</button></div>
	<br>
	</div>


<br>
</div>
</form>