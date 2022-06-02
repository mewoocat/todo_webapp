<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="style.css">
<title>Title</title>
</head>

<body>

<div id="logo-box">
  <h1>TO-DO</h1>
</div>
<div id="login-box">
  <div id="login-box-2">
    <h1>SIGN UP</h1>
    <?php
      if(isset($_GET['error'])){
        if($_GET['error'] == "emptyfields"){
          echo '<p id="error-message">empty fields</p>';
        }
        else if($_GET['error'] == "invalidmailuid"){
          echo '<p id="error-message">invalid email and username</p>';
        }
        else if($_GET['error'] == "invalidmail"){
          echo '<p id="error-message">invalid email</p>';
        }
        else if($_GET['error'] == "longuid"){
          echo '<p id="error-message">username must be 20 characters or less</p>';
        }
        else if($_GET['error'] == "invaliduid"){
          echo '<p id="error-message">invalid username</p>';
        }
        else if($_GET['error'] == "passwordcheck"){
          echo '<p id="error-message">passwords do not match</p>';
        }
        else if($_GET['error'] == "usertaken"){
          echo '<p id="error-message">username taken</p>';
        }
      }
      else if(isset($_GET['success'])){
        if($_GET['success'] == "signupsuccess"){
          echo 'signup successful';
        }
      }
    ?>
    <form action="includes/signup.inc.php" method="post">
      <input type="text" name="uid" placeholder="Username"></input>
      <input type="text" name="mail" placeholder="Email"></input>
      <input type="password" name="pwd" placeholder="Password"></input>
      <input type="password" name="pwd-repeat" placeholder="Repeat Password"></input>
      <button type="submit" name="signup-submit">Signup</button>
    </form>
    <a id="signup-link" href="index.php">Already have an account?</a>
  </div>
</div>
</body>
</html>
