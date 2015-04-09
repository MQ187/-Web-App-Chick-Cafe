<?php 
    session_start(); //start the session
    include("db_config.php"); //include the database configuration

    $_SESSION['access'] = array("owner","manager");
    include('security.php');
    //only give access to manager and/or owner

    require_once("messages.php");
    //adds the check for all possible errors as well as the warnings.
?>

<!DOCTYPE html>
    <head>
        <!--set the title and include the css file-->
        <title>Add Employee | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
            require_once('nav/managerDash.php'); //include the manager nav
         ?>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php
        //html form to add a new customer
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
        //check it the name and password is set in the form
        if(isset($_POST['name'])&&isset($_POST['pass'])&&isset($_POST['email'])){
            if ($_POST['pass']!=$_POST['pass2']){   //check if the passwords match
                $_SESSION['message'] = "3"; //passwords don't match.
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=add_employee.php">';
                die();
            }

            //get and store values from the post variables
            $name = $_POST['name'];
            $pass = $_POST['pass'];
            $email = $_POST['email'];

            //encrypt the password with sha1 and md5
            $encrypt_password = sha1(md5($pass));

            //check if the employees email exists in the employee employee table
            $question="SELECT count(*) AS ct FROM employee WHERE email= :email";
            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':email' => $email));
            $count = $sth->fetchAll();

            if($count[0]['ct'] == 1){
                $_SESSION['message'] = "4";  //email already exists.
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=add_employee.php">';
                //checks if the user already exists in the database.
            }else{
                //if it doesnt exist insert the new employee details into the table
                $question = "INSERT INTO employee(name,password,email,active) VALUES (:name, :pass, :email, :active)";
                $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $add->execute(array(':name' => $name, ':pass' => $encrypt_password, ':email' => $email, ':active' => true));
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage_employees.php">'; 
            }
        }
    ?>


    </body>
</html>