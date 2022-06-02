<?php
session_start();
require 'dbh.inc.php';

$id = $_POST['itemId'];

echo $id;

$sql = "DELETE FROM listitems WHERE listID=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  header("Location: main.php?error=failedtodelete");
  exit();
}
else{
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  exit();
}
