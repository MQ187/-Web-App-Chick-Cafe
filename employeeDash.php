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
         <?php
         require_once("nav/employeeDash.php");
         ?>
    </header>
        <nav>
            <ul>
                <li><i>Order's Pending</i> 
                    <form action="employeeDash.php" method="POST">
                        <select name='isPri' onchange='this.form.submit()'>
                            <option>Sort By...</option>
                            <option value="1">Priority</option>
                            <option value="2">Time</option>
                        </select>
                        <noscript><input type="submit" value="Submit"></noscript>
                    </form>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Customer</th><th>Order ID</th><th>Details</th><th>Order Date/Time</th><th>Order Priority</th><th>Order Status</th><th>Select Order</th>
                        </tr>
                        <?php
                            session_start();
                        	require_once("db_config.php");
                            // Connect to the Database and Select the ccdb database.
                            if (!isset($_POST['isPri'])){$_POST['isPri'] = "0";}
                            if($_POST['isPri']=='1'){
                                $question="SELECT * FROM `order` WHERE orderStatus = :status ORDER BY orderPriority DESC;";
                                $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $sth->execute(array(':status' => "Pending"));
                                $fetch = $sth->fetchAll();


                                $i=1;
                                foreach ($fetch as $key) {
                                    $idorder[$i] = $key['idorder'];
                                    $idcustomer[$i] = $key['idCustomer'];
                                    $dateTime[$i] = $key['orderTimeS'];
                                    $priority[$i] = $key['orderPriority'];
                                    $status[$i] = $key['orderStatus'];
                                    echo '<tr>';
                                    echo '<td><table border="0">';
                                        $y=0;
                                        $question3="SELECT * FROM `customer` WHERE idCustomer = :id";
                                        $sth3 = $db->prepare($question3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                        $sth3->execute(array(':id' => $idcustomer[$i]));
                                        $fetch3 = $sth3->fetchAll();
                                        foreach ($fetch3 as $key3) {
                                            $name[$y] = $key3['name'];
                                            $surname[$y] = $key3['surname'];
                                            echo '<tr><td>ID: '. $idcustomer[$i] .'</td></tr>';
                                            echo '<tr><td>Name: '. $name[$y] .'</td></tr>';
                                            echo '<tr><td>Surname: '. $surname[$y] .'</td></tr>';
                                        $y++;
                                        }
                                        echo '</table></td>';
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
                                    echo '<td><form action=update_status.php method="POST">'
                                       . '<input type="hidden" name="prepare" value='.$idorder[$i].' />'
                                       . '<input type="submit" value="Prepare" />'
                                       . '</form></td>';
                                    echo '</tr>';
                                    $i++;
                                }
                                if (count($fetch) == 0){
                                    echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td>';
                                }
                            }else{
                                $question="SELECT * FROM `order` WHERE orderStatus = :status ORDER BY orderStatus ASC";
                                $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                $sth->execute(array(':status' => "Pending"));
                                $fetch = $sth->fetchAll();


                                $i=1;
                                foreach ($fetch as $key) {
                                	$idorder[$i] = $key['idorder'];
                                    $idcustomer[$i] = $key['idCustomer'];
                                    $dateTime[$i] = $key['orderTimeS'];
                                    $priority[$i] = $key['orderPriority'];
                                    $status[$i] = $key['orderStatus'];
                                	echo '<tr>';
                                    echo '<td><table border="0">';
                                        $y=0;
                                        $question3="SELECT * FROM `customer` WHERE idCustomer = :id";
                                        $sth3 = $db->prepare($question3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                        $sth3->execute(array(':id' => $idcustomer[$i]));
                                        $fetch3 = $sth3->fetchAll();
                                        foreach ($fetch3 as $key3) {
                                            $name[$y] = $key3['name'];
                                            $surname[$y] = $key3['surname'];
                                            echo '<tr><td>ID: '. $idcustomer[$i] .'</td></tr>';
                                            echo '<tr><td>Name: '. $name[$y] .'</td></tr>';
                                            echo '<tr><td>Surname: '. $surname[$y] .'</td></tr>';
                                        $y++;
                                        }
                                        echo '</table></td>';
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
                                    echo "<td><form action=update_status.php method=\"POST\">"
                                       . "<input type=\"submit\" value=\"Prepare\" />"
                                       . "<input type=\"hidden\" name=\"prepare\" value=\"$idorder[$i]\" />"
                                       . "</form></td>";
                                    echo '</tr>';
                                	$i++;
                                }
                                if (count($fetch) == 0){
                                  echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td>';
                                }
                            }
                        ?>
                        </table>
                </li> 

                <li><i>Order's you're preparing</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr>
                        <th>Customer</th><th>Order ID</th><th>Details</th><th>Order Date/Time</th><th>Order Priority</th><th>Order Status</th><th>Select Order</th>
                        </tr>
                        <?php
                            $question="SELECT * FROM `order` WHERE idEmployee = :id AND orderStatus = 'Preparing'";
                            $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                            $sth->execute(array(':id' => "$_SESSION[id]"));
                            $fetch = $sth->fetchAll();


                            $i=1;
                            foreach ($fetch as $key) {
                                $idorder[$i] = $key['idorder'];
                                $idcustomer[$i] = $key['idCustomer'];
                                $dateTime[$i] = $key['orderTimeS'];
                                $priority[$i] = $key['orderPriority'];
                                $status[$i] = $key['orderStatus'];
                                
                                echo '<tr>';
                                echo '<td><table border="0">';
                                        $y=0;
                                        $question3="SELECT * FROM `customer` WHERE idCustomer = :id";
                                        $sth3 = $db->prepare($question3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                        $sth3->execute(array(':id' => $idcustomer[$i]));
                                        $fetch3 = $sth3->fetchAll();
                                        foreach ($fetch3 as $key3) {
                                            $name[$y] = $key3['name'];
                                            $surname[$y] = $key3['surname'];
                                            echo '<tr><td>ID: '. $idcustomer[$i] .'</td></tr>';
                                            echo '<tr><td>Name: '. $name[$y] .'</td></tr>';
                                            echo '<tr><td>Surname: '. $surname[$y] .'</td></tr>';
                                        $y++;
                                        }
                                        echo '</table></td>';
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
                                echo "<td><form action=update_status.php method=\"POST\">"
                                   . "<input type=\"submit\" value=\"Ready\" />"
                                   . "<input type=\"hidden\" name=\"ready\" value=\"$idorder[$i]\" />"
                                   . "</form></td>";
                                echo '</tr>';
                                $i++;
                            }
                            if (count($fetch) == 0){
                              echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td><td></td><td></td>';
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