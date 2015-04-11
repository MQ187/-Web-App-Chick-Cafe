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
        <title>Add Stock | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
            //include the manager nav
            require_once('nav/managerDash.php');
         ?>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php
        //form to add a new ingredient
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
        //check if the form attributes have been set
        if(isset($_POST['name'])&&isset($_POST['av'])&&isset($_POST['price'])){
            $name = $_POST['name'];
            $av = $_POST['av'];
            $price = $_POST['price'];

            //add the post attributes into the ingredients table
            $question = "INSERT INTO ingredients(name,availability,price) VALUES (:name, :av, :price)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':name' => $name, ':av' => $av, ':price' => $price));
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=stock.php">'; 
        }
    ?>


    </body>
</html>