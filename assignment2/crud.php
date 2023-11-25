<?php
  require './inc/DB.php';
  require './inc/head.php';
?>

  <body class="crud" onload="init()">
  
<?php
  require './inc/nav.php';
?>
    <main>
      <section class="table">
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
          <tbody>
          <?php 
          session_start();
          if (!isset($_SESSION['id'])) {
            header('Location: login.php');
            exit();
          }
          else{
            $query= "SELECT * FROM student";
            $result=mysqli_query($conn2,$query);
            if(!$result){
              die("Invalid query");
            }
            
            while ($row=$result->fetch_assoc()) {            
              echo "
              <tr>                  
                <td>$row[id]</td>
                
                <td>$row[studentName]</td>
                <td><img src='temp_img/$row[image]' width = 100 height =100 title = '$row[image]'></td>
                <td>$row[gender]</td>
                <td>$row[birthday]</td>
                <td>        
                   <a class='btn btn-success' href='edit.php?id=$row[id]'> <img style='width:16px;height:16px' src='img/edit.png'/></a>
                   <a class='btn btn-danger' href='delete.php?id=$row[id]'> <img style='width:20px;height:20px' src='img/del.png'/></a>
                </td>      
               </tr>";
            }
            
          }        
         
        ?>
          </tbody>
          <tfoot></tfoot>
        </table>
      </section>
      <canvas id="cvs">
        Please change the brower which supports canvas.
      </canvas>
      <script type="text/javascript" src="crud.js"></script>
    </main>
<?php
    require './inc/footer.php';
?>