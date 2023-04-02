<?php 
	$db_username = "root";
	$db_password = "";
	$db_host = "localhost";
	$db_name = "diemdanh";
	$db_connect = new mysqli($db_host, $db_username, $db_password, $db_name);

	// Check connection
	if ($db_connect->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

?>