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

        <div class="nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="managerDash.php">Current Orders</a></li>
            <li><a href="reportDash.php">Reports</a></li>
            <li><a href="#">Employee Accounts</a></li>
            <li><a href="refund.php">Refund</a></li>
            <li><a href="#">VIP</a></li>
            <li><a href="stock.php">Stock</a></li>
            <li><a href="myAccount.php">My Account</a></li>
            <li><a href="logoff.php">Logout</a></li>
        </ul>
        </div>
    </header>
    <body>
        <nav>
            <ul>
                <li><i>Current Order's</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Order Date</th><th>Order Time</th><th>Order Priority</th><th>Order Status</th>
                        </tr>
                        <?php
                            require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.

                            $question="SELECT * FROM `order` WHERE orderStatus = :status OR orderStatus = :status2";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':status' => "Pending", ':status2' => "Preparing"));
                            $fetch = $sth->fetchAll();


                            $i=1;
                            foreach ($fetch as $key) {
                                $idorder[$i] = $key['idorder'];
                                $date[$i] = $key['orderDate'];
                                $time[$i] = $key['orderTime'];
                                $priority[$i] = $key['orderPriority'];
                                $status[$i] = $key['orderStatus'];
                                echo '<tr>';
                                echo '<td>'. $idorder[$i] .'</td>';
                                echo '<td>'. $date[$i] .'</td>';
                                echo '<td>'. $time[$i] .'</td>';
                                echo '<td>'. $priority[$i] .'</td>';
                                echo '<td>'. $status[$i] .'</td>';
                                echo '</tr>';
                                $i++;
                            }

                        ?>
                        </table>
                </li>
            </ul>
        </nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>