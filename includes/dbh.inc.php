<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "login_system_to-do";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn){
  die("Connection falied:  ".mysqli_connect_error());
}
