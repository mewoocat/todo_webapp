<?php

$maxTheme = 1;

session_start();

require 'dbh.inc.php';

$_SESSION['themeNum']++;

if ($_SESSION['themeNum'] > $maxTheme){
  $_SESSION['themeNum'] = 0;
}

echo $_SESSION['themeNum'];

$sql = "UPDATE users SET theme=? WHERE idUsers=?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)){
  header("Location: ../main.php?error=sql");
  exit();
}
else{
  mysqli_stmt_bind_param($stmt, "ss", $_SESSION['themeNum'], $_SESSION['userId']);
  mysqli_stmt_execute($stmt);
  exit();
}
