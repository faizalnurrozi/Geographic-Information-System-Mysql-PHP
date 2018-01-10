<?php
ini_set('max_execution_time', 300);
$host 	= "localhost";
$user	= "root";
$pass	= "";
$db		= "dbspatial";

$db = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8mb4', $user, $pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

date_default_timezone_set("Asia/Jakarta");
?>