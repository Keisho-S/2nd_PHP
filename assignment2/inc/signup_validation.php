<?php
// require 'header.php';

// $name=$email=$password=$pwdrepeat="";

$nameErr=$emailErr=$passwordErr=$pwdrepeatErr="";


require 'sao_adminDB.php';
// variables
$name = isset($_POST['username'] ) ? $_POST['username'] : '';
$email = isset($_POST['email'] ) ? $_POST['email'] : '';
$password = isset($_POST['password'] ) ? $_POST['password'] : '';
$pwdrepeat=isset($_POST['pwdrepeat'] ) ? $_POST['pwdrepeat'] : '';
// validate inputs
$ok = true;

if ($_SERVER['REQUEST_METHOD'] = 'POST') {

    if (empty($_POST["username"])) {
        $nameErr="Please enter a valid name";
        $ok = false;
    }
    else{
        $name=test_input($_POST["username"]);
        if (!preg_match("/^[0-9a-zA-z]+$/",$name)) {
            $nameErr="ONLY ALPHABETS AND NUMBERS ALLOWED";
            $ok = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr="Please enter a valid email";
        $ok = false;
    }
    else{
        $email=test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr="THE EMAIL ADDRESS IS INCOTTECT";
            $ok = false;
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr="Please enter a valid password";
        $ok = false;
    }
    else{
        $password=test_input($_POST["password"]);
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{4,8}$/', $password)) {
            $passwordErr="NUMBER, LETTER, SPECIAL LETTER REQUIRD";
            $ok = false;
        }
    }
    if (empty($_POST["pwdrepeat"])) {
        $pwdrepeatErr="Please enter a valid password";
        $ok = false;
    }
    else{
        $pwdrepeat=test_input($_POST["pwdrepeat"]);
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{4,8}$/', $pwdrepeat)) {
            $pwdrepeatErr="ENTER A VALID PASSWORD!";
            $ok = false;
        }
        if ($password !== $pwdrepeat){
            $pwdrepeatErr="PASSWORD NOT MATCH";
            $ok = false;
        }
    }
    
   
}
function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

// decide if we are saving or not
if ($ok){
    $password = hash('sha512', $password);
    // set up the sql
    $sql = "INSERT INTO SAO_administrator (username, email, password) VALUES ('$name', '$email', '$password');";
    $conn->exec($sql);
    //disconnect
    $conn = null;
    header('location: ./signup_login.php');
}
require 'footer.php';
 ?>