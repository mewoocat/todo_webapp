<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css">
<title>Title</title>
</head>

<body>

<div id="logo-box">
  <img src="media/logo_words.png">
</div>
<div id="login-box">
  <div id="login-box-2">
    <?php
      if(isset($_SESSION['userId'])){
        header ("Location: main.php");
        exit();
      }
      else{
        echo '<h1>LOGIN</h1>
              <form action="includes/login.inc.php" method="post">
              <input type="text" name="mailuid" placeholder="Username/Email..."></input>
              <input type="password" name="pwd" placeholder="Password"></input>
              <button id="login-button" type="submit" name="login-submit">LOGIN</button>
              </form>
              <a id="signup-link" href="signup.php">Signup</a>';
      }
     ?>
  </div>
</div>

<div id="extra">
  <?php
    if(isset($_SESSION['userId'])){
      echo '<p>You are logged in!</p>';
    }
    else{
      echo '<p>You are logged out!</p>';
    }
   ?>
</div>
</body>
</html>
