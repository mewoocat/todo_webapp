<?php

session_start();

$_SESSION['sort-type'] = $_POST['sort-type'];

header("Location: ../main.php");
