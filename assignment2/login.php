<?php
session_start();
  require './inc/head.php';
?>
<body class="login">
<?php
  require './inc/nav.php';
?>
<main>
<section class="header-login">
  <?php
    if (isset($_SESSION['id'])) {
    echo '
    <div class = "box">
    <span class="borderLine"></span>
    <form action="" method="post">
    <h1>Sword Art Online Administrator</h1>
    <div class="inputBox">
    
    </div>
    <div class="inputBox">
    <h2>SUCCESS</h2>
    </div> 
    <div class="inputBox">
    
    </div>
    <div class="links">
    <br><br>
    <button type="submit" ><a href="./inc/logout.php" class="header-signup">LOGOUT</a></button>
    </div>
    </form>                    
    </div>
    ';
    }       
    else {
    echo '
    <div class = "box">
    <span class="borderLine"></span>
    <form action="./inc/login_validate.php" method="post">
    <h1>Sword Art Online Administrator</h1>
    <div class="inputBox">
    <input type="hidden" name="id" id="id"/>
    </div>
    <div class="inputBox">
    <input type="text" name="username" id="username" placeholder="Username" required>
    <label for="username">Username</label><i></i>
    </div> 
    <div class="inputBox">
    <input type="password" name="password" id="password" placeholder="Password" required>
    <label for="password">Password</label><i></i>
    </div>
    <div class="loginpage">
    <br><br>
    <button type="submit" name="login_submit" value="login-submit">LOGIN</button>
    <br><br><br>
    <button type="submit"><a href="signup.php" class="header-signup">SIGNUP</a></button>
    </div>
    </form>                    
    </div>';
  } 
?>     
    </section>    
</main>
<?php
    require './inc/footer.php';
?>