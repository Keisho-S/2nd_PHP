<?php
	// Database connection
	$servername="localhost";
	$username="root";
	$password="";

	//(Will create sao_profile)
	$database="sao_adminDB";

	// Connect database
	$conn1=mysqli_connect($servername,$username,$password);
	
	// Die if connection failed
	if (!$conn1) {
	  die("connection failed" .mysqli_connect_error($conn1));
	}
	
	else{
	  // Create database if not exists
	  $createDatabase="CREATE DATABASE IF NOT EXISTS sao_adminDB";
	  $create_db=mysqli_query($conn1, $createDatabase);
	  $conn2 =mysqli_connect($servername,$username,$password,$database);
	  if (!$conn2) {
		die("connection failed" .mysqli_connect_error($conn2));
	  }
	  else{
		// If not exist, create table of SAO_administrator
/***password length should be long enough! variable name should be unique! or error in other pages*/
		$SAO_administrator="CREATE TABLE IF NOT EXISTS `SAO_administrator`(`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT, `username` VARCHAR(45) NOT NULL , `email` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL)";
		$tableResult=mysqli_query($conn2,$SAO_administrator);
	  }
	}
    if (isset($_POST['signup_submit']) || isset($_POST['login_submit'])) {
        
		try{
            $conn = new PDO('mysql:host=localhost;dbname=sao_adminDB','root','');
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
	}
?>
