<?php 
session_start(); 
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
         <?php
         require_once("nav/menus.php");
         ?>
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
</html>