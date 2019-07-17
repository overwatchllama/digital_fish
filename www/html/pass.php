<?php
session_start();
if (isset($_SESSION['login'])){'';} else {$_SESSION=0;};
$login = $_SESSION['login'];
if ($login <>'1') {
	print '<meta http-equiv="refresh" content="0;URL=\'security.php\'" />';
	die();
};
?>
