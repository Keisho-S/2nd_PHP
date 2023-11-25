<?php
        if ($_SEVER['REQUEST_METHOD']=$_POST) {
          
          $id=$_POST['id'];          
          $studentName=$_POST['studentName'];         
          $gender=$_POST['gender'];          
          $birthday=$_POST['birthday'];
        }

        // Database connection
        $servername="localhost";
        $username="root";
        $password="";

        //(Will create sao_profile)
        $database="sao_profile";

        // Connect database
        $conn1=mysqli_connect($servername,$username,$password);
        
        // Die if connection failed
        if (!$conn1) {
          die("connection failed" .mysqli_connect_error($conn));
        }
        
        else{
          // Create database if not exists
          $createDatabase="CREATE DATABASE IF NOT EXISTS sao_profile";
          $create_db=mysqli_query($conn1, $createDatabase);
          $conn2=mysqli_connect($servername,$username,$password,$database);
          if (!$conn2) {
            die("connection failed" .mysqli_connect_error($conn2));
          }
          else{
          // If not exist, create table of students
          $studentTable="CREATE TABLE IF NOT EXISTS `student`(`id` INT NOT NULL PRIMARY KEY, `image` VARCHAR(255), `studentName` VARCHAR(45) NOT NULL, `gender` ENUM('male','female','other') NOT NULL, `birthday` DATE NOT NULL)";
          $tableResult=mysqli_query($conn2,$studentTable);
          // If press Submit botton, will insert the data to the student table          
          if (isset($_POST['btnSubmit'])) {
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
         }
        }
        
       ?>