<?php
  require './inc/head.php';
 
  echo '<body class="signup">';
 
  require './inc/nav.php';
 
  require './inc/signup_validation.php';
?>
<section class="header-signup">

<div class = "box">  
<span class="borderLine"></span>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<h1>Administrator Signup</h1>
<p><span class="error">* requireed field</span></p>
 
<div class="inputBox">
<input type="text" name="username" id="username" placeholder="only alphabets and numbers allowed" value="<?php echo $name; ?>" required>
<label for="username">Username<span class="error">* <?php echo $nameErr; ?></span></label><i></i>
</div> 
<div class="inputBox">

<input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
<label for="email">Email<span class="error">* <?php echo $emailErr; ?></span></label><i></i>
</div>

<div class="inputBox">
<input type="password" name="password" id="password" placeholder="4-8 characters, numner, letter, special letter requird" required>
<label for="password">Password<span class="error">* <?php echo $passwordErr; ?></span></label><i></i>
</div>
<div class="inputBox">
<input type="password" name="pwdrepeat" id="pwdrepeat" required>
<label for="pwdrepeat">Repeat password<span class="error">* <?php echo $pwdrepeatErr; ?></span></label><i></i>
</div>
<button type="submit" name="signup_submit" value="login-submit">SUBMIT</button>
</form>

</section>

<?php
    require './inc/footer.php';
?>