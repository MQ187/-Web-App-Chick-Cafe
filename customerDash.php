<?php
session_start();
$_SESSION['access'] = "customer";
include('security.php');

require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>

<!DOCTYPE html>
    <head>
        <title>Customer Dash | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body>
    <?php require_once("basketNotification.php"); ?>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
        
         <?php
         require_once("nav/customerDash.php"); //display the customer nav
         ?>

    </header>
        <nav>
            <ul>
                <li><i>Order History</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Order Details</th><th>Order Date</th><th>Order Priority</th><th>Order Status</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            session_start();

                            $time = $myDate = date("Y-m-d h:i:s", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );

                            //show all customer orders made in the last month
                            $question="SELECT * FROM `order` WHERE idCustomer= :id AND orderTimeS BETWEEN '".$time."' AND NOW() ORDER BY idOrder DESC;";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':id' => $_SESSION['id']));
                            $fetch = $sth->fetchAll();

                            $i=1;
                            foreach($fetch as $key){
                                $idorder[$i] = $key['idorder'];
                                $times[$i] = $key['orderTimeS'];
                                $priority[$i] = $key['orderPriority'];
                                $status[$i] = $key['orderStatus'];
                                echo '<tr>';
                                echo '<td>'. $idorder[$i] .'</td>';

                                    //get the quantity and name for each item in the order
                                    $question2="SELECT quantity,name FROM orderItem JOIN item WHERE orderItem.idorder = :id AND orderItem.idItem = item.iditem";
                                    $sth2 = $db->prepare($question2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                    $sth2->execute(array(':id' => $idorder[$i]));
                                    $fetch2 = $sth2->fetchAll();

                                    echo '<td><table border="0">';
                                    $x=1;
                                    foreach ($fetch2 as $key2) {
                                        $name[$x] = $key2['name'];
                                        $quantity[$x] = $key2['quantity'];
                                        echo '<tr><td>'.$name[$x].'</td><td> x </td><td>'.$quantity[$x].'</td></tr>';
                                        $x++;
                                    }
                                    echo '</table></td>';

                                echo '<td>'. $times[$i] .'</td>';
                                echo '<td>'. $priority[$i] .'</td>';
                                echo '<td>'. $status[$i] .'</td>';
                                echo '</tr>';
                                $i++;
                            }
                            if (count($fetch) == 0){
                                echo '<tr><td>No orders to display</td><td></td><td></td><td></td><td></td></tr>';
                            }
                        ?>
                        </table>
                        <!--button to view older orders-->
                        <a href="customerRecords.php" style="text-decoration:none;color:white;"><center><h4>View Older</h4></center></a>
                </li>  
            </ul>
        </nav>
    </body>
</html>