<?php
// Connection to Server

//###############################
// $dbname = 	"jayfish"; #---->Create this table in your Mysql server and the respective test will run.
//$tbl_stat = "status";
//$server = 	"192.168.1.241";
//$user = 	"jayfish";
//$password = "JayFish1$";
//###############################

//$con=mysqli_connect($server,$user,$password,$dbname);
	//if (mysqli_connect_errno())
	//	{
  	//		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	//	} else {echo "Database Connected";}


$db = new PDO('mysql:host=192.168.0.22;dbname=jayfish;charset=utf8mb4', 'jayfish', 'JayFish1$');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


// try {
//     //connect as appropriate as above
//     $db->query('SELECT * FROM jayfish.relay WHERE gpio > 0;');
// } catch(PDOException $ex) {
//     echo "An Error occured!"; //user friendly message
//     some_logging_function($ex->getMessage());
// };


?> 
