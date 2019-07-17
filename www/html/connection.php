<?php

$db = new PDO('mysql:host=127.0.0.1;dbname=digitalfish;charset=utf8mb4', 'digitalfish', 'digitalfish1$');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?> 

