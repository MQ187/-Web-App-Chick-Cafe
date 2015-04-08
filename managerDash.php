<?php
session_start(); 

$_SESSION['access'] = array("owner","manager");
include('security.php');

require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
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
            require_once("nav/managerDash.php");
        ?>

    </header>
    <body>
        <nav>
            <ul>
                <li><i>Current Order's</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Order ID</th><th>Details</th><th>Order Date/Time</th><th>Order Priority</th><th>Order Status</th>
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
                                $dateTime[$i] = $key['orderTimeS'];
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

                                echo '<td>'. $dateTime[$i] .'</td>';
                                echo '<td>'. $priority[$i] .'</td>';
                                echo '<td>'. $status[$i] .'</td>';
                                echo '</tr>';
                                $i++;
                            }
                            if (count($fetch) == 0){
                                echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td>';
                            }

                        ?>
                        </table>
                </li>
            </ul>
        </nav>
    </body>
</html>