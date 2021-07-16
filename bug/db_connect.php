<?php
	$servername = "localhost";
	$username = "root";
	$password = "Greenlanten@123";

	try 
	{
	  $conn = new PDO("mysql:host=$servername;dbname=bug_tracking", $username, $password);
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  // echo "Connected successfully";
	} 
	catch(PDOException $e) 
	{
	  echo "Connection failed: " . $e->getMessage();
	}
?>