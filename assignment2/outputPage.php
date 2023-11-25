<?php 
 session_start();
 if (!isset($_SESSION['id'])) {
     header('Location: login.php');
     exit();
 }
 else{
  require './inc/DB.php';

  //SQL QUERY
  $query="SELECT id, image, studentName, gender, birthday FROM`student`;";

  //Fetching data from database
  $output=mysqli_query($conn2,$query);

  if (mysqli_num_rows($output)>0) {
               
  }
  else {
    echo "<p class='echo'> 0 results </p>";
              
  }
        
  $conn2->close();
  require './inc/head.php';

echo ' <body class="out">';
 

  require './inc/nav.php';
echo '
    <main>
    <h1 class="outfix">SAO Survivor List</h1>    
    <table>
        <thead>
            <tr>              
                <th>ID</th>
                <th>Image</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Birthday</th>
            </tr>
        </thead>
        <tbody>';
         
          while ($row=$output->fetch_assoc()) {            
          echo'
            <tr>                  
              <td>'.$row['id'].'</td>
              <td><img src="temp_img/' .$row["image"]. '" width = 100 height =100 title = ' .$row["image"].'></td>
              <td>'.$row['studentName'].'</td>
              <td>'.$row['gender'].'</td>
              <td>'.$row['birthday'].'</td>  
             </tr>';
          }
 }
          ?>
           
        </tbody>
    </table>
   
    </main>
    <footer>
      <p>Author: Keisho Seiho</p>
    </footer>
  </body>
</html>
