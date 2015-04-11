<?php
session_start();

$file = $_POST['filename'];

$f = 'C:\Server-Xampp\htdocs\DBbackup\\' . $file;
if (!unlink($f)){
  	echo ("Error deleting $file");
  }
else{
    $_SESSION['message'] = "8";
    $_SESSION['filename'] = $file;
    header("Location: db_dash.php");
  }
?>