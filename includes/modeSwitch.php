<?php

session_start();
require 'dbh.inc.php';

$_SESSION['item-mode'] = $_POST['mode'];

if ($_SESSION['item-mode'] == "add"){

}

else if ($_SESSION['item-mode'] == "edit"){

  $_SESSION['editID'] = $_POST['itemID'];

  $sql = "SELECT * FROM listitems WHERE listID=?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL statement failed";
  }
  else {
    mysqli_stmt_bind_param($stmt, "i", $_POST['itemID']);
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
  $name = $result['name'];
  $date = $result['date'];
  $type = $result['type'];

  echo json_encode(array($name, $date, $type));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
