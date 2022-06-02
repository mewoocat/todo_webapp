<?php

session_start();

require 'dbh.inc.php';

$idUsers = $_SESSION['userId'];
$name = $_POST['name'];
$date = $_POST['date'];
$type = $_POST['type'];
$itemID = $_SESSION['editID'];

if ($_SESSION['item-mode'] == "add"){
  $sql = "INSERT INTO listitems (idUsers, name, date, type) Values (?, ?, ?, ?)";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    //exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "ssss", $idUsers, $name, $date, $type);
    mysqli_stmt_execute($stmt);
    //exit();
  }
}
else if ($_SESSION['item-mode'] == "edit"){
  $sql = "UPDATE listitems SET name=?, date=?, type=? WHERE listID=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    //exit();
  }
  else{
    mysqli_stmt_bind_param($stmt, "ssss", $name, $date, $type, $itemID);
    mysqli_stmt_execute($stmt);
    //exit();
  }
}



mysqli_close($conn);
