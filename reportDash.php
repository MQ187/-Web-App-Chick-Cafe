<?php/*
session_start(); 
if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if (!isset($_SESSION['AccountType'])) {$_SESSION['AccountType'] = "NONE";}
if ($_SESSION['loggedIn'] == false) {header('Location: login.php');}
if ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "customer") {header('Location: customerDash.php');}
elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "employee") {header('Location: employeeDash.php');}
*/
?>

<!DOCTYPE html>
    <head>
        <title>Customer Dash | Chick Cafe</title>
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
    <body>
        <nav>
            <ul id="rDash">
                <li><i>Report</i></li>
                    <table style="padding-top:50px;">
                        <tr><td><li><a href="#">Customer Spending</a></li></td>
                        <td><li><a href="refundReport.php">Refund</a></li></td>
                        <td><li><a href="#">Staff Performance</a></li></td></tr>
                        <tr><td><li><a href="orderReport.php">Order</a></li></td>
                        <td><li><a href="activeCustomerReport.php">Active Users</a></li></td> 
                        <td><li><a href="#">Generate All</a></li></td></tr>
                    </table>
            </ul>
        </nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>