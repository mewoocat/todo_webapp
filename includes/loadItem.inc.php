<?php

session_start();

require 'dbh.inc.php';


$stmt_type = $_SESSION['sort-type'];
$today_date = date("Y-m-d");
if ($stmt_type == "all"){
  $sql = "SELECT * FROM listitems WHERE idUsers=?;";
}
else if ($stmt_type == "today"){
  $sql = "SELECT * FROM listitems WHERE idUsers=? AND date=?;";
}
else if ($stmt_type == "task"){
  $sql = "SELECT * FROM listitems WHERE idUsers=? AND type=?;";
}
else if ($stmt_type == "overdue"){
  $sql = "SELECT * FROM listitems WHERE idUsers=? AND date<? AND type!='task';";
}

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  echo "SQL statement failed";
}
else{
  if ($stmt_type == "all"){
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
  }
  else if ($stmt_type == "today"){
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['userId'], $today_date);
  }
  else if ($stmt_type == "task"){
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['userId'], $stmt_type);
  }
  else if ($stmt_type == "overdue"){
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['userId'], $today_date);
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  while($row = mysqli_fetch_assoc($result)){
    $year = substr($row['date'], 0, 4);
    $month_day = substr($row['date'], 5, 5);
    $reordered_date = $month_day.'-'.$year;
    $name = '\''.mysqli_real_escape_string($conn, $row['name']).'\'';
    echo '<div id="list-item-container">
            <div id="checkbox-container">
              <div class="checkbox" val="'.$row['listID'].'">
                <div class="checkbox-bg">
                  <div class="checkbox-a"></div>
                </div>
              </div>
            </div>
            <div id="list-item-content">
              <span class="list-item-content-name" onclick="open_overflow_content_window('.$name.')" >'.$row['name'].'</span>
              <div class="list-item-extra-content">
                <span class="list-item-content-type">'.strtoupper($row['type']).'</span>
                <span class="list-item-'.$row['type'].'">'.$reordered_date.'</span>
              </div>
            </div>
            <div class="edit-button-container">
              <div class="edit-button" val="'.$row['listID'].'"></div>
            </div>
          </div>';
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
