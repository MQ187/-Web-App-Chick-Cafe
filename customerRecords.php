<?php
$_SESSION['access'] = "customer";
include('security.php');
?>
<!DOCTYPE html>
    <head>
        <title>Customer Records | Chick Cafe</title>
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
         require_once("nav/customerDash.php");
         ?>

    </header>
        <nav>
            <ul>
                <li><i>Order Records - 2 years</i>
                    <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Order Details</th><th>Order Date</th><th>Order Priority</th><th>Order Status</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            session_start();

                            $timee = $myDate = date("Y-m-d h:i:s", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) );
                            $times = $myDate = date("Y-m-d h:i:s", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-2 years" ) );


                            $question="SELECT * FROM `order` WHERE idCustomer= :id AND orderTimeS BETWEEN '".$times."' AND '".$timee."' ORDER BY idOrder DESC;";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':id' => $_SESSION['id']));
                            $fetch = $sth->fetchAll();

                            $i=1;
                            foreach($fetch as $key){
                                $idorder[$i] = $key['idorder'];
                                $time[$i] = $key['orderTimeS'];
                                $priority[$i] = $key['orderPriority'];
                                $status[$i] = $key['orderStatus'];
                                echo '<tr>';
                                echo '<td>'. $idorder[$i] .'</td>';

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

                                echo '<td>'. $time[$i] .'</td>';
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
                           <a href="customerDash.php" style="text-decoration:none;color:white;"><center><h4>Back to current orders</h4></center></a>

                </li>  
            </ul>
        </nav>
    </body>
</html>