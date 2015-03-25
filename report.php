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

            $question="SELECT * FROM `order` WHERE orderDate>='$sd' AND orderDate<='$se'";
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