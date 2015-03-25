<?php session_start(); 
if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if (!isset($_SESSION['AccountType'])) {$_SESSION['AccountType'] = "NONE";}
if ($_SESSION['loggedIn'] == false) {header('Location: login.php');}
if ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "customer") {header('Location: myAccount.php');}
elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "employee") {header('Location: employeeAccount.php');}
?>