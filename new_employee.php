<?php session_start(); 
if ($_SESSION['logedIn'] == false || $_SESSION['userType'] != "Manager") {
    //header("Location: login.php");
  }

if (isset($_SESSION['message'])){
if ($_SESSION['message'] == "3") { 
  print '<script type="text/javascript">alert("Your passwords did not match, please try again.");</script>';
  unset($_SESSION['message']);
}
else if ($_SESSION['message'] == "4") {
  print '<script type="text/javascript">alert("A user with such an email already exists.");</script>';
  unset($_SESSION['message']);
}
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <link rel="icon" type="image/x-ico" href="favicon.ico" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  </head>
<body>
  <table border="0" align="center">
    <form method="POST" action="create_employee.php">
      <tr><td><p>Name</p></td><td>:</td><td>
          <input type="text" name="name" size="20" maxlength="45" required="required" ></td></tr>
      <tr><td><p>E-mail</p></td><td>:</td><td>
          <input type="text" name="email" size="20" maxlength="45" required="required" ></td></tr>
      <tr><td><p>Password</p></td><td>:</td><td>
          <input type="password" name="password" size="20" maxlength="8" required="required"></td></tr>
        <tr><td><p>Password</p></td><td>:</td><td>
        <input type="password" name="password2" size="20" maxlength="8" required="required"></td></tr>
      <tr><td colspan=3 align="center"><p>
          <input type="submit" value="Add Employee"></p></td></tr>
    </form>
  </table>

</body>
<!-- All code on this page was written by Gaetan Mougel-->