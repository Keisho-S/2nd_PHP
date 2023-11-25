<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
else {
    require './inc/DB.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM student WHERE id = $id";
        mysqli_query($conn2,$sql);
        // $conn2->query($sql);
    }
    // header('location:index.php');
    header('location:outputPage.php');
    exit;
}
?>    