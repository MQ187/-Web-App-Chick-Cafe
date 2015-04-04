<?php
    //session_start();
    class report{

        function rReportPDF($s, $e){
            require("db_config.php");
            $html="";

            $html=$html.'<table id="tfhover" class="tftable" border="1">';
            $html=$html.'<tr><th>Refund ID</th><th>Customer ID</th><th>Manager ID</th><th>Customer Name</th><th>Amount Refunded</th><th>Refund Date/Time</th><th>Details</th></tr>';

            $_SESSION['reportType'] = "refund";
            $sd = $s;
            $se = $e;

            $question="SELECT * FROM refund WHERE date>='$sd' AND date<='$se'";
            $sth = $db->prepare($question);
            $execute = $sth->execute();
            $fetch = $sth->fetchAll();

            $i=1;
            foreach ($fetch as $key) {

                $question2="SELECT name FROM customer WHERE idCustomer=$key[idCustomer]";
                $sth1 = $db->prepare($question2);
                $execute1 = $sth1->execute();
                $fetch1 = $sth1->fetch();

                $customerName = $fetch1[0];
        
                $idRefund[$i] = $key['idRefund'];
                $idCustomer[$i] = $key['idCustomer'];
                $idManager[$i] = $key['idManager'];
                $amount[$i] = $key['ammount'];
                $dateTime[$i] = $key['date'];
                $details[$i] = $key['details'];

                $html=$html.'<tr>';
                $html=$html.'<td>'. $idRefund[$i] .'</td>';
                $html=$html.'<td>'. $idCustomer[$i] .'</td>';
                $html=$html.'<td>'. $idManager[$i] .'</td>';
                $html=$html.'<td>'. $customerName .'</td>';
                $html=$html.'<td>'. $amount[$i] .'</td>';
                $html=$html.'<td>'. $dateTime[$i] .'</td>';
                $html=$html.'<td>'. $details[$i] .'</td>';
                $html=$html.'</tr>';
                $i++;

            }         
            $html=$html.'</table>';
            return ($html);
        }

        function oReportPDF($s, $e){
            require("db_config.php");
            $html="";
            $html=$html.'<table id="tfhover" class="tftable" border="1">';
            $html=$html.'<tr><th>Customer ID</th><th>Customer Name</th><th>Customer Surname</th><th>Order ID</th><th>Order Date/Time</th><th>Order Priority</th><th>Order Status</th><th>Employee ID</th></tr>';

            $_SESSION['reportType'] = "order";
            $sd = $s;
            $se = $e;

            $question="SELECT * FROM `order` WHERE orderTimeS>='$sd' AND orderTimeS<='$se'";
            $sth = $db->prepare($question);
            $execute = $sth->execute();
            $fetch = $sth->fetchAll();

            $i=1;
            foreach ($fetch as $key) {

                $question2="SELECT name,surname FROM customer WHERE idCustomer=$key[idCustomer]";
                $sth1 = $db->prepare($question2);
                $execute1 = $sth1->execute();
                $fetch1 = $sth1->fetch();

                $customerName = $fetch1[0];
                $customerSuName = $fetch1[1];

                $idCustomer[$i] = $key['idCustomer'];
                $orderID[$i] = $key['idorder'];
                $dateTime[$i] = $key['orderTimeS'];
                $priority[$i] = $key['orderPriority'];
                $status[$i] = $key['orderStatus'];
                $employeeID[$i] = $key['idEmployee'];

                $html=$html.'<tr>';
                $html=$html.'<td>'. $idCustomer[$i] .'</td>';
                $html=$html.'<td>'. $customerName .'</td>';
                $html=$html.'<td>'. $customerSuName .'</td>';
                $html=$html.'<td>'. $orderID[$i] .'</td>';
                $html=$html.'<td>'. $dateTime[$i] .'</td>';
                $html=$html.'<td>'. $priority[$i] .'</td>';
                $html=$html.'<td>'. $status[$i] .'</td>';
                $html=$html.'<td>'. $employeeID[$i] .'</td>';
                $html=$html.'</tr>';
                $i++;
            }
            $html=$html.'</table>';
            return ($html);
        }

        function acReportPDF(){
            require("db_config.php");
            $html="";
            $html=$html.'<table id="tfhover" class="tftable" border="1">';
            $html=$html.'<tr><th>Customer ID</th><th>Customer Name</th><th>Customer Surname</th><th>Order ID</th><th>Order Date/Time</th><th>Order Priority</th><th>Order Status</th></tr>';

            $_SESSION['reportType'] = "activeCustomer";

            $question="SELECT idcustomer,name,surname FROM customer WHERE isLoggedIn='1'";
            $sth = $db->prepare($question);
            $execute1 = $sth->execute();
            $fetch1 = $sth->fetchAll();

            $i=1;
            foreach ($fetch1 as $key) {
                
                $idCustomer[$i] = $key['idcustomer'];
                $customerName[$i] = $key['name'];
                $customerSName[$i] = $key['surname'];
                $d = date('Y-m-d');

                $question="SELECT * FROM `order` WHERE idCustomer = '$idCustomer[$i]' AND orderStatus = 'Pending' AND orderDate = '$d'";
                $sth = $db->prepare($question);
                $execute = $sth->execute();
                $fetch = $sth->fetchAll();

                $html=$html.'<tr>';
                $html=$html.'<td>'. $idCustomer[$i] .'</td>';
                $html=$html.'<td>'. $customerName[$i] .'</td>';
                $html=$html.'<td>'. $customerSName[$i] .'</td>';

                if(count($fetch) <= 0){
                    $html=$html.'<td>n/a</td>';
                    $html=$html.'<td>n/a</td>';
                    $html=$html.'<td>n/a</td>';
                    $html=$html.'<td>n/a</td>';
                }else{
                    $x = 1;
                    foreach ($fetch as $key) {
                        $orderID[$i] = $key['idorder'];
                        $dateTime[$i] = $key['orderDate'];
                        $priority[$i] = $key['orderPriority'];
                        $status[$i] = $key['orderStatus'];
                    
                        $html=$html.'<td>'. $orderID[$i] .'</td>';
                        $html=$html.'<td>'. $dateTime[$i] .'</td>';
                        $html=$html.'<td>'. $priority[$i] .'</td>';
                        $html=$html.'<td>'. $status[$i] .'</td>';
                        $x++;
                    }
                }

                $html=$html.'</tr>';
                $i++;
            }
            $html=$html.'</table>';
            return ($html);
        }

        function csReportPDF($s, $e){
            require("db_config.php");
            $html="";
            $html=$html.'<table id="tfhover" class="tftable" border="1">';
            $html=$html.'<tr><th>Customer ID</th><th>Customer Name</th><th>Customer Surname</th><th>Amount Spent</th></tr>';

            $_SESSION['reportType'] = "customerSpending";
            $sd = $s;
            $se = $e;

            $question="SELECT idcustomer,name,surname FROM `customer`";/*orderDate>='$sd' AND orderDate<='$se'";*/
            $sth = $db->prepare($question);
            $execute = $sth->execute();
            $fetch = $sth->fetchAll();

            $i=1;
            foreach ($fetch as $key) {
                
                $customerID[$i] = $key['idcustomer'];
                $customerName[$i] = $key['name'];
                $customerSName[$i] = $key['surname'];

                $html=$html.'<tr>';
                $html=$html.'<td>'. $customerID[$i] .'</td>';
                $html=$html.'<td>'. $customerName[$i] .'</td>';
                $html=$html.'<td>'. $customerSName[$i] .'</td>';
                
                $question2="SELECT ammount FROM payment WHERE idCustomer=$key[idcustomer] AND date>='$sd' AND date<='$se'";
                $sth1 = $db->prepare($question2);
                $execute1 = $sth1->execute();
                $fetch1 = $sth1->fetchAll();

                if(count($fetch1)<=0){
                    $html=$html.'<td>No spendings</td>';
                }else{
                    $x = 1;
                    $total = 0;
                    foreach ($fetch1 as $key) {
                        $amount[$x] = $key['ammount'];
                        $total += $amount[$x];
                        $x++;
                    }

                    $html=$html.'<td> &pound;'. $total .'</td>';
                }

                $html=$html.'</tr>';
                $i++;
            }

            $html=$html.'</table>';
            return ($html);
        }

        function spReportPDF($s, $e){
            require("db_config.php");
            $html="";
            $html=$html.'<table id="tfhover" class="tftable" border="1">';
            $html=$html.'<tr><th>Employee ID</th><th>Employee Name</th><th>Breakfast Count</th><th>Lunch Count</th><th>Dinner Count</th><th>Breakfast Min</th><th>Breakfast Max</th><th>Lunch Min</th><th>Lunch Max</th><th>Dinner Min</th><th>Dinner Max</th></tr>';

            $_SESSION['reportType'] = "order";
            $sd = $s;
            $se = $e;

            $question="SELECT * FROM `order` WHERE orderTimeS>='$sd' AND orderTimeS<='$se'";
            $sth = $db->prepare($question);
            $execute = $sth->execute();
            $fetch = $sth->fetchAll();

            $i=1;
            foreach ($fetch as $key) {

                $question2="SELECT name,surname FROM customer WHERE idCustomer=$key[idCustomer]";
                $sth1 = $db->prepare($question2);
                $execute1 = $sth1->execute();
                $fetch1 = $sth1->fetch();

                $customerName = $fetch1[0];
                $customerSuName = $fetch1[1];

                $idCustomer[$i] = $key['idCustomer'];
                $orderID[$i] = $key['idorder'];
                $dateTime[$i] = $key['orderDate'];
                $priority[$i] = $key['orderPriority'];
                $status[$i] = $key['orderStatus'];
                $employeeID[$i] = $key['idEmployee'];

                $html=$html.'<tr>';
                $html=$html.'<td>'. $idCustomer[$i] .'</td>';
                $html=$html.'<td>'. $customerName .'</td>';
                $html=$html.'<td>'. $customerSuName .'</td>';
                $html=$html.'<td>'. $orderID[$i] .'</td>';
                $html=$html.'<td>'. $dateTime[$i] .'</td>';
                $html=$html.'<td>'. $priority[$i] .'</td>';
                $html=$html.'<td>'. $status[$i] .'</td>';
                $html=$html.'<td>'. $employeeID[$i] .'</td>';
                $html=$html.'</tr>';
                $i++;
            }
            $html=$html.'</table>';
            return ($html);
        }
    }
?>