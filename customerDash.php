<!DOCTYPE html>
    <head>
        <title>Customer Dash | Chick Cafe</title>
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
            <li><a href="customerDash.php">My Orders</a></li>
            <li><a href="#">Notifications</a></li>
            <li><a href="myAccount.php">My Account</a></li>
            <li><a href="logoff.php">Logout</a></li>
        </ul>
        </div>
    </header>
        <nav>
            <ul>
                <li><i>Order History</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Order Date</th><th>Order Time</th><th>Order Priority</th><th>Order Status</th>
                        </tr>
                        <?php 
                            require_once("db_config.php");
                            session_start();
                            
                            $question="SELECT * FROM `order` WHERE idCustomer= :id";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':id' => $_SESSION['id']));
                            $fetch = $sth->fetchAll();

                            $i=1;
                            foreach($fetch as $key){
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