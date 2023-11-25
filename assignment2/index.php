<?php
	//check for authentication before we show any data
	session_start();
	if (!isset($_SESSION['id'])) {
		header('Location: login.php');
		exit();
	}
	else {
		require './inc/head.php';
    require './inc/nav.php';
?>
<body class="in">

    <main>
    <div class="box">
      <span class="borderLine"></span>
      <form action="index.php" method="post" autocomplete="off" enctype='multipart/form-data'>
        <h1>Sword Art Online Survivor Info</h1>
        <div class="inputBox">
          <input type="number" name="id" id="id" required />
          <label for="id">Student ID</label><i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="studentName" id="studentName" required />
          <label for="studentName">Student Name</label><i></i>
        </div>
        <div class="inputBox">
          <input type="text" name="gender" id="gender" required/>
          <label for="gender">Student Gender</label><i></i>
        </div>
        <div class="inputBox">
          <input type="date" name="birthday" id="birthday" required/>
          <label for="birthady">Student Birthday</label><i></i>
        </div>
        <div class="links">          
          <label for="image" class="indexaddimg">ADD IMG</label>
          <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" visbility="hidden" value="" />
          <button class="indexBtn" type="submit" name="btnSubmit" value="submit">
            SUBMIT
          </button>
        </div>
      </form>
    </div> 
    </main>
  <?php
    require './inc/DB.php';
     // Insert data to the student table
     $id = isset($_POST['id'] ) ? $_POST['id'] : '';
     $studentName = isset($_POST['studentName'] ) ? $_POST['studentName'] : ' ';
     $gender = isset($_POST['gender'] ) ? $_POST['gender'] : ' ';
     $birthday = isset($_POST['birthday'] ) ? $_POST['birthday'] : ' ';   
   

     // If press Submit botton, will insert the data to the student table
     
     if (isset($_POST['btnSubmit'])) {
       $tableResult=mysqli_query($conn2,$studentTable);

        // $name = $_POST["name"];
    if ($_FILES["image"]["error"] == 4) {
      echo"<script> alert('Image Does Not Exist');</script>";
    }
    else{
      $fileName = $_FILES["image"]["name"];
      $fileSize = $_FILES["image"]["size"];
      $tmpName = $_FILES["image"]["tmp_name"];

      $validImageExtension =['jpg', 'jepg', 'png'];
      $imageExtension = explode('.', $fileName);
      $imageExtension = strtolower(end($imageExtension));
      if (!in_array($imageExtension, $validImageExtension)) {
        echo
        "
        <script> 
          alert('Invalid Image Extension');
          </script>
        ";
      }
      else if ($fileSize > 1000000) {
        echo
        "
        <script> 
          alert('Image Size Is Too Large');
          </script>
        ";
      }
      else {
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;

        move_uploaded_file($tmpName, 'temp_img/' . $newImageName);
        $insertData= "INSERT INTO `student`(`id`,`image`,`studentName`,`gender`,`birthday`) VALUE('$id','$newImageName', '$studentName','$gender','$birthday')";
        // Use try-catch to catch the exception such as primary key overlaps 
        try {
          mysqli_query($conn2,$insertData);
          //If the exception is thrown, this text will not be shown
          echo
         "
         <script> 
           alert('Successfully Added');
           document.location.href = 'outputPage.php';
           </script>
         ";
        }
        
        //catch exception
        catch(Exception $e) {
          echo "<p class='echo'>Message: </p>" ."<p class='echo'>". $e->getMessage()."</p>";
         }
      }
    }
     }
	}
  require './inc/footer.php';
?>

