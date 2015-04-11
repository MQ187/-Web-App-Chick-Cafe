<?php 
    session_start(); 
    include("db_config.php");
    //security checks to allow only manager access
    $_SESSION['access'] = array("manager","owner");
    include('security.php');

    require_once("messages.php");
    //adds the check for all possible errors as well as the warnings.
?>

<!DOCTYPE html>
    <head>
        <!--VIP page, select fixed,flex or view vip memebers-->
        <title>VIP | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
            require_once("nav/managerDash.php");
        ?>
    </header>
    
    <nav><ul><li><i>VIP</i></li></ul>
    <table border="0" align="center" style="padding-bottom:30px;" >
        <tr>
        <!--flexible discount form as a button with value 1-->
        <form action="vip_flex.php" method="POST">
            <td><p>
                <input type="submit" class="vip_button" value="Flexible Discount">
                <input type="hidden" name="type" value="1">
            </p></td>
        </form>
        <!--fixed discount form as a button with value 0-->
        <form action="vip_fixed.php" method="POST">
            <td><p>
                <input type="submit" class="vip_button" value="Fixed Discount">
                <input type="hidden" name="type" value="0">
            </p></td>
        </form>
        <!--vip customer page-->
        <form action="vip_customers.php">
            <td><p>
            <input type="submit" class="vip_button" value="VIP Customers">
            </p></td>
        </form>

        </tr>      
    </nav>

    </body>
</html>