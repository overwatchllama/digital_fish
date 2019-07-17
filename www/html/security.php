<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/fa/css/fontawesome-all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <title>J5</title>
  </head>
<style>
body {
  background-color: #282828 !important;

}

</style>

  <?php

  
  include "connection.php";
 $usernamechallenge='.';
 $passwordchallenge='.';

    session_start();
 $username = $password = $userError = $passError = '';
    if(isset($_POST['sub'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
    if (isset($username)) {
      $stmtv = $db->query("SELECT * FROM users where email='$username'");
    
    while($row = $stmtv->fetch(PDO::FETCH_ASSOC)) {
    	global $userid;
      global $email;
    	$userid=$row['id'];
    	$email=$row['email'];
    	$_SESSION['email']=$email;
    	$_SESSION['userid']=$userid;
    	$usernamechallenge = $row['email'];
    	$passwordchallenge = $row['password'];
    };

};


   if (isset($username)) {
      if($username === $usernamechallenge && $password === $passwordchallenge){
    	    $_SESSION['login'] = true; 
    			header('LOCATION:index.php'); //go to location after successful login.
    			die();
      }

      if($username !== $usernamechallenge){$userError = '<strong>Invalid Username</strong>';}
      if($password !== $passwordchallenge){$passError = '<strong>Invalid Password</strong>';}
    }
};
    ?>

    <!DOCTYPE html>
    <!-- <html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'> -->
	       <head>
	         <meta http-equiv='content-type' content='text/html;charset=utf-8' />
	         <title>Login</title>
	       </head>

	    <body>
       
	    <!-- <div class="container"> -->
<div class="row">
    <div class="col-sm-12">
       <div align="center">
         <img src="images/jayindaweeds.png" width="300">
       </div>
    </div>
</div>

<div class="row">	    
    <div class="col-sm-12">
      <div align="center"> 
       <div class="card" style="width: 300px;">
			   <div class="card-header"><h5>DigitalFish</h5></div>
  			   <div class="card-body" align="left">    		    				      
              <form name='login' action='' method='post'>
			        <p>Username<br><input class="form-contol" type='text' value='' id='username' name='username' style="border-radius: 5px;border: solid 1px #cdcdcd;padding: 5px; width: 100%;"/>
			        <div class='error'><?php echo $userError;?></div></p>
			        <p>Password<Br><input class="form-contol" type='password' value='' id='password' name='password'  style="border-radius: 5px;border: solid 1px #cdcdcd;padding: 5px; width: 100%;" />
			        <div class='error'><?php echo $passError;?></div></p>
			        <br>
			        <input class="btn btn-primary" type='submit' value='Login' name='sub' / style="width: 100px;"><a href="register.php"></a>
			      </form>	  		 
           </div>
	  	</div>
	  </div>
</div>    
</div></div></div></div></div>

<!-- </div> -->
	    </body>
    </html>


