<?php 
    session_start(); 
    include("db_config.php");

    $_SESSION['access'] = array("owner","manager");
    include('security.php');

    require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>

<!DOCTYPE html>
    <head>
        <title>Add Stock | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
            require_once('nav/managerDash.php');
         ?>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php

            echo '<form action="add_stock.php" method="POST">';
            echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" required="required"/></td></tr>';
            echo '<tr><td><p>Availability:</p></td><td><input type="text" name="av" required="required"/></td></tr>';
            echo '<tr><td><p>Price:</p></td><td><input type="text" name="price" required="required"/></td></tr>'; 

    ?>  
    <tr><td colspan=2 align="center"><p><input type="submit" value="Add"></p></td></tr>
    </table>
    </div>
    </form>
    
    <?php
        if(isset($_POST['name'])&&isset($_POST['av'])&&isset($_POST['price'])){
            $name = $_POST['name'];
            $av = $_POST['av'];
            $price = $_POST['price'];

            $question = "INSERT INTO ingredients(name,availability,price) VALUES (:name, :av, :price)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':name' => $name, ':av' => $av, ':price' => $price));
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=stock.php">'; 
        }
    ?>


    </body>
</html>