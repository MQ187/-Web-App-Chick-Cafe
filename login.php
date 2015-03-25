<?php session_start(); 
if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if (!isset($_SESSION['AccountType'])) {$_SESSION['AccountType'] = "NONE";}

  if(($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "customer")) {header('Location: myAccount.php');}
  elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "manager") {header('Location: managerAccount.php');}
  elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "employee") {header('Location: employeeAccount.php');}
  if (isset($_SESSION['message'])){
    if ($_SESSION['message'] == "1") { 
      print '<script type="text/javascript">alert("No such user was found, try again or register.");</script>';
      $_SESSION['message'] = "0";
    }
    elseif ($_SESSION['message'] == "2"){
      print '<script type="text/javascript">alert("You have entered the wrong password. Please try again.");</script>';
      $_SESSION['message'] = "0";
    }
    elseif ($_SESSION['message'] == "3"){
      print '<script type="text/javascript">alert("Error. Please try again.");</script>';
      $_SESSION['message'] = "0";
    }
  }
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <header>
        <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="br_menu.php">Breakfast</a></li>
                <li><a href="lu_menu.php">Lunch</a></li>
                <li><a href="di_menu.php">Dinner</a></li>
                <li><a href="dr_menu.php">Drinks</a></li>
                <li><a href="login.php">Login/Register</a></li>
            </ul>
        </div>
    </header>

    <body>
    <div class="flat-form">
        <div class="title"><a>Login</a></div>
        <div id="login" class="form-action">
            <p>Existing Customers you know what to do... New customer fill in the Register form on the right :D</p>
            <form action="login_proc.php" method="POST">
                <ul>
                    <li><input type="email" name="email" placeholder="Email" required="required" class="text"/></li>
                    <li><input type="password" name="password" placeholder="Password" required="required"/></li>
                    <li><input type="submit" value="Login" name="Login" class="button"/></li>
                </ul>
            </form>
        </div>
    </div>
    <div class="flat-form">
        <div class="title"><a>Register</a></div>
        <div id="register" class="form-action">
            <p>Sign up for our super awesome service. We'll give you a free cookie?</p>
            <form action="register_proc.php" method="POST">
                <ul>
                    <li><input type="text" name="name" placeholder="First Name" class="text" required="required"/></li>
                    <li><input type="text" name="surname" placeholder="Last Name" class="text" required="required"/></li>
                    <li><input type="email" name="email" placeholder="E-mail" class="text" required="required"/></li>
                    <li><input type="password" name="password" placeholder="Password" required="required"/></li>
                    <li><input type="password" name="password2" placeholder="Password Again" required="required"/></li>
                    <li><input type="phone" name="phone" placeholder="Phone Number" class="text" required="required"/></li>
                    <li><input type="submit" value="Register" name="Add Customer" class="button"/></li>
                </ul>
            </form>
        </div>
    </div>
    </body> 

    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>
</html>