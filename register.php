<?php session_start(); 
if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "customer") {header('Location: myAccount.php');}
elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "manager") {header('Location: managerAccount.php');}
elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "employee") {header('Location: employeeAccount.php');}

if (isset($_SESSION['message'])){
if ($_SESSION['message'] == "3") { 
  print '<script type="text/javascript">alert("Your passwords did not match, please try again.");</script>';
  unset($_SESSION['message']);
}
else if ($_SESSION['message'] == "4") {
  print '<script type="text/javascript">alert("A user with such an email already exists. Maybe try logging in?");</script>';
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
    <form method="POST" action="register_proc.php">
      <tr><td><p>Name</p></td><td>:</td><td>
          <input type="text" name="name" size="20" maxlength="45" required="required" ></td></tr>
      <tr><td><p>Surname</p></td><td>:</td><td>
          <input type="text" name="surname" size="20" maxlength="45" required="required" ></td></tr>
      <tr><td><p>E-mail</p></td><td>:</td><td>
          <input type="email" name="email" size="20" maxlength="45" required="required" ></td></tr>
      <tr><td><p>Password</p></td><td>:</td><td>
          <input type="password" name="password" size="20" maxlength="8" required="required"></td></tr>
        <tr><td><p>Password</p></td><td>:</td><td>
        <input type="password" name="password2" size="20" maxlength="8" required="required"></td></tr>
        <tr><td><p>Phone Number</p></td><td>:</td><td>
          <input type="text" name="phone" size="20" maxlength="12" required="required" ></td></tr>
      <tr><td colspan=3 align="center"><p>
          <input type="submit" value="Register"></p></td></tr>
    </form>
  </table>

  <div align="center"><a href="login.php">Already have an account? Login now!</a></div>



</body>
<!-- All code on this page was written by Gaetan Mougel-->