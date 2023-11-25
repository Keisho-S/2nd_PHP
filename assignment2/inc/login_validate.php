<?php
//store the user inputs in variables and hash the password
$user = $_POST['username'];
$hashedPwd  = hash('sha512', $_POST['password'],);

//connect to db
require 'sao_adminDB.php';

//set up and run the query
$sql = "SELECT id FROM sao_administrator WHERE username = '$user' AND password = '$hashedPwd'";
$result = $conn->query($sql);
//store the number of results in a variable
$count = $result -> rowCount();
//check if any matches found
if ($count == 1){
	echo 'Logged in Successfully.';
	foreach  ($result as $row){
		//access the existing session created automatically by the server
		session_start();
		//take the user's id from the database and store it in a session variable
		$_SESSION['id'] = $row['id'];
		//redirect the user
		header('Location: ../login.php');
	}
}
else {
	echo 'Invalid Login';
	// echo $count;
	// echo $hashedPwd;
}
$conn = null;
?>
