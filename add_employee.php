<?php 
    session_start(); 
    include("db_config.php");
?>

<!DOCTYPE html>
    <head>
        <title>Add Employee | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="managerDash.php">Current Orders</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Employee Accounts</a></li>
                <li><a href="#">Refund</a></li>
                <li><a href="#">VIP</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="myAccount.php">My Account</a></li>
                 <li><a href="logoff.php">Logout</a></li>
            </ul>
        </div>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php

            echo '<form action="add_employee.php" method="POST">';
            echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" required="required"/></td></tr>';
            echo '<tr><td><p>Email:</p></td><td><input type="text" name="email" required="required"/></td></tr>';
            echo '<tr><td><p>Password:</p></td><td><input type="password" name="pass" required="required"/></td></tr>'; 
            echo '<tr><td><p>Password Again:</p></td><td><input type="password" name="pass2" required="required"/></td></tr>'; 

    ?>  
    <tr><td colspan=2 align="center"><p><input type="submit" value="Add"></p></td></tr>
    </table>
    </div>
    </form>
    
    <?php
        if(isset($_POST['name'])&&isset($_POST['pass'])&&isset($_POST['email'])){
            if ($_POST['pass']!=$_POST['pass2']){
                $_SESSION['message'] = "3"; //passwords don't match.
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=add_employee.php">';
                die();
            }

            $name = $_POST['name'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            $encrypt_password = sha1(md5($pass));

            $question="SELECT count(*) AS ct FROM employee WHERE email= :email";

            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':email' => $email));
            $count = $sth->fetchAll();

            if($count[0]['ct'] == 1){
                $_SESSION['message'] = "4";  //email already exists.
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=add_employee.php">';
                //checks if the user already exists in the database.
            }else{
                $question = "INSERT INTO employee(name,password,email,active) VALUES (:name, :pass, :email, :active)";
                $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $add->execute(array(':name' => $name, ':pass' => $encrypt_password, ':email' => $email, ':active' => true));
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_employees.php">'; 
            }
        }
    ?>

    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>