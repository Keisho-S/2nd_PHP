<?php
  session_start();
  if (!isset($_SESSION['id'])) {
      header('Location: login.php');
      exit();
  }
  else{
  require './inc/DB.php';
  $id=""; 
  $image="";       
  $studentName="";         
  $gender="";          
  $birthday="";

  if ($_SERVER["REQUEST_METHOD"]=='GET') {
    if (!isset($_GET["id"])) {
        header('location:outputPage.php');
        exit;
    }
    $id = $_GET["id"];
    $sql = "select*from student where id=$id";
    $result = mysqli_query($conn2,$sql);
    $row = mysqli_fetch_assoc($result);
    while(!$row){
        header('location:outputPage.php');
        exit;
    }
    $image=$row["image"];
    $studentName=$row["studentName"];         
    $gender=$row["gender"];          
    $birthday=$row["birthday"];
  }
  else{
    $id=$_POST["id"];
    $studentName=$_POST["studentName"];         
    $gender=$_POST["gender"];          
    $birthday=$_POST["birthday"];

    if (isset($_POST['btnSubmit'])) {
      $tableResult=mysqli_query($conn2,$studentTable);

   if ($_FILES["image"]["error"] == 4) {
     echo"<script> alert('Image Does Not Exist');</script>";
   }
   else{
     $fileName = $_FILES["image"]["name"];
     $fileSize = $_FILES["image"]["size"];
     $tmpName = $_FILES["image"]["tmp_name"];

     $validImageExtension =['jpg', 'jpeg', 'png'];
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
    
       $sql="update student set image='$newImageName', studentName ='$studentName', gender='$gender', birthday='$birthday' where id='$id'";
       $result= mysqli_query($conn2,$sql);
       echo
       "
       <script> 
         alert('Successfully Added');
         document.location.href = 'outputPage.php';
         </script>
       ";
     }
   }
    }
 }
}


require './inc/head.php';
?>

  <body class="crud" onload="init()">
<?php
require './inc/nav.php';
?>
    <main>
      <div class="box">
        <span class="borderLine"></span>
        <form action="edit.php" method="POST" autocomplete="off" enctype='multipart/form-data'>
          <h1>Sword Art Online Survivor Info Edit Form</h1>
          <div class="inputBox box-edit">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
            <!-- <label for="id">ID</label><i></i> -->
          </div>
          <div class="inputBox box-edit">
            <input type="text" name="studentName" id="studentName" value="<?php echo $studentName; ?>" required />
            <label for="studentName">Student Name</label><i></i>
          </div>
          <div class="inputBox box-edit">
            <input type="text" name="gender" id="gender"  value="<?php echo $gender; ?>"required/>
            <label for="gender">Student Gender</label><i></i>
          </div>
          <div class="inputBox box-edit">
            <input type="date" name="birthday" id="birthday"  value="<?php echo $birthday; ?>"required/>
            <label for="birthday">Student Birthday</label><i></i>
          </div>
          <div class="links">
          <label for="image" class="indexaddimg">IMG ALT</label>
          <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png"visbility="hidden" />
            <button class="indexBtn"  type="submit" name="btnSubmit" value="update">
              UPDATE
            </button>
          </div>
        </form>
      </div>
      </main>
    <footer>
    <p><small>Author: Keisho Seiho</small></p>
    </footer>
  </body>
</html>