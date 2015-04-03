<?php session_start(); 
if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
if (!isset($_SESSION['AccountType'])) {$_SESSION['AccountType'] = "NONE";}
if ($_SESSION['logedIn'] == false) {header('Location: login.php');}
if ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "customer") {header('Location: customerDash.php');}
elseif ($_SESSION['logedIn'] == true && $_SESSION['AccountType'] == "manager") {header('Location: managerDash.php');}
?>

<!DOCTYPE html>
    <head>
        <title>Employee Dash | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="employeeDash.php">Pending Orders</a></li>
                <li><a href="employeeReport.php">Report</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="myAccount.php">My Account</a></li>
                <li><a href="logoff.php">Logout</a></li>
            </ul>
        </div>
    </header>
        <nav>
            <ul>
                <li><i>Order's Pending</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Order Date</th><th>Order Time</th><th>Order Priority</th><th>Order Status</th><th>Select Order</th>
                        </tr>
                        <?php
                        	require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.

                            $question="SELECT * FROM `order` WHERE orderStatus = :status";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':status' => "Pending"));
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
                                echo "<td><form action=update_status.php method=\"POST\">"
                                   . "<input type=\"submit\" value=\"Prepare\" />"
                                   . "<input type=\"hidden\" name=\"prepare\" value=\"$idorder[$i]\" />"
                                   . "</form></td>";
                                echo '</tr>';
                            	$i++;
                            }

                        ?>
                        </table>
                </li> 

                <li><i>Order's you're preparing</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Details</th><th>Order Date</th><th>Order Time</th><th>Order Priority</th><th>Order Status</th><th>Select Order</th>
                        </tr>
                        <?php
                            $question="SELECT * FROM `order` WHERE idEmployee = :id AND orderStatus = 'Preparing'";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':id' => "$_SESSION[id]"));
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

                                    $question2="SELECT quantity,name FROM orderItem JOIN item WHERE orderItem.idorder = :id AND orderItem.idItem = item.iditem";
                                    $sth2 = $db->prepare($question2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                    $sth2->execute(array(':id' => $idorder[$i]));
                                    $fetch2 = $sth2->fetchAll();

                                    echo '<td><table border="0">';
                                    //echo '<tr><th>Name</th><th>Quantity</th></tr>';
                                    $x=1;
                                    foreach ($fetch2 as $key2) {
                                        $name[$x] = $key2['name'];
                                        $quantity[$x] = $key2['quantity'];
                                        echo '<tr><td>'.$name[$x].'</td><td> x </td><td>'.$quantity[$x].'</td></tr>';
                                        $x++;
                                    }
                                    echo '</table></td>';

                                echo '<td>'. $date[$i] .'</td>';
                                echo '<td>'. $time[$i] .'</td>';
                                echo '<td>'. $priority[$i] .'</td>';
                                echo '<td>'. $status[$i] .'</td>';
                                echo "<td><form action=update_status.php method=\"POST\">"
                                   . "<input type=\"submit\" value=\"Ready\" />"
                                   . "<input type=\"hidden\" name=\"ready\" value=\"$idorder[$i]\" />"
                                   . "</form></td>";
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