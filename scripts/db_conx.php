<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$database = 'digitallyjukebox';
	
	$conx = mysqli_connect($host, $user, $pass, $database);

	if(mysqli_connect_errno()) die("Database connecton failed: " . mysqli_connect_error()." ".mysqli_connect_errno());
	mysqli_query($conx, "SET NAMES 'utf8'");
	mysqli_query($conx, "SET CHARACTER SET 'utf8'");
?>