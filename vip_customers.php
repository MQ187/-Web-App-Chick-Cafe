<?php session_start(); 
    include("db_config.php");
    $_SESSION['access'] = array("owner","manager","employee");
    include('security.php');
    require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
    
$userType = $_SESSION['userType'];
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
    <head>
        <title>VIP Customers | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
        <link rel="icon" type="image/x-ico" href="favicon.ico" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php require_once("nav/managerDash.php");  ?>
    </header>
        <nav>
            <ul>
                <li><i>VIP Customers</i>
                        <table id="tfhover" class="tftable" border="1">
                        <tr><form action="vip_customers.php" method="POST">
                        	<input style="float:right;"type="submit" value="Search" />
                            <input style="float:right;"type="text" name="search_name"/>
                            </form>
                       	</tr>
                        <tr>
                        <th>Customer ID</th><th>Customer Name</th><th>Customer Surname</th><th>VIP Status</th><th>Discount Plan</th>
                        </tr>
                        <?php
                        	if(!empty($_REQUEST['search_name'])){

                        		$sname = mysql_real_escape_string($_REQUEST['search_name']);

	                             // Connect to the Database and Select the ccdb database.
                                 $question="SELECT idCustomer,name,surname FROM `customer` WHERE name LIKE '%".$sname."%'";
                                 $sth = $db->prepare($question);
                                 $execute = $sth->execute();
                                 $fetch = $sth->fetchAll();

                                 $i=1;
                                 foreach ($fetch as $key) {
                                    $idcustomer[$i] = $key['idCustomer'];
                                    $name[$i] = $key['name'];
                                    $surname[$i] = $key['surname'];

                                    $q = "SELECT idDiscounts FROM customerdiscount WHERE idcustomer = '$idcustomer[$i]'";
                                    $sth = $db->prepare($q);
                                    $sth->execute();
                                    $fetch = $sth->fetchColumn();

                                    $f = $fetch[0];

                                    $q2 = "SELECT vipMembership,discountType FROM `discounts` WHERE idDiscounts = '$f'";
                                    $sth2 = $db->prepare($q2);
                                    $sth2->execute();
                                    $fetch2 = $sth2->fetch(); 

                                    $status = "";
                                    switch($fetch2[0]){
                                        case 1:
                                            $status = "Silver";
                                            break;
                                        case 2:
                                            $status = "Gold";
                                            break;
                                        case 3:
                                            $status = "Platinum";
                                            break;
                                    }

                                    $plan = "";
                                    switch($fetch2[1]){
                                        case 0:
                                            $plan = "Fixed";
                                            break;
                                        case 1:
                                            $plan = "Flexible";
                                            break;
                                    }

                                    echo '<tr>';
                                    echo '<td>'. $idcustomer[$i] .'</td>';
                                    echo '<td>'. $name[$i] .'</td>';
                                    echo '<td>'. $surname[$i] .'</td>';
                                    echo '<td>'. $status .'</td>';
                                    echo '<td>'. $plan .'</td>';
                                    echo '</tr>';
                                    $i++;
                                   }
                                    if (count($fetch) == 0){
                                        echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td>';
                                    }

                        	}else{
	                            // Connect to the Database and Select the ccdb database.
	                             $question="SELECT idCustomer,name,surname FROM `customer` ORDER BY idCustomer";
	                             $sth = $db->prepare($question);
	                             $execute = $sth->execute();
	                             $fetch = $sth->fetchAll();

	                             $i=1;
	                             foreach ($fetch as $key) {
                                    $idcustomer[$i] = $key['idCustomer'];
                                    $name[$i] = $key['name'];
                                    $surname[$i] = $key['surname'];

                                    $q = "SELECT idDiscounts FROM customerdiscount WHERE idcustomer = '$idcustomer[$i]'";
                                    $sth = $db->prepare($q);
                                    $sth->execute();
                                    $fetch = $sth->fetchColumn();

                                    $f = $fetch[0];

                                    $q2 = "SELECT vipMembership,discountType FROM `discounts` WHERE idDiscounts = '$f'";
                                    $sth2 = $db->prepare($q2);
                                    $sth2->execute();
                                    $fetch2 = $sth2->fetch(); 

                                    $status = "";
                                    switch($fetch2[0]){
                                        case 1:
                                            $status = "Silver";
                                            break;
                                        case 2:
                                            $status = "Gold";
                                            break;
                                        case 3:
                                            $status = "Platinum";
                                            break;
                                    }

                                    $plan = "";
                                    switch($fetch2[1]){
                                        case 0:
                                            $plan = "Fixed";
                                            break;
                                        case 1:
                                            $plan = "Flexible";
                                            break;
                                    }

                                    echo '<tr>';
                                    echo '<td>'. $idcustomer[$i] .'</td>';
                                    echo '<td>'. $name[$i] .'</td>';
                                    echo '<td>'. $surname[$i] .'</td>';
                                    echo '<td>'. $status .'</td>';
                                    echo '<td>'. $plan .'</td>';
                                    echo '</tr>';
	                                $i++;
	                               }
                                    if (count($fetch) == 0){
                                        echo '<td>Nothing to display</td><td></td><td></td><td></td><td></td>';
                                    }
                        	}
                        ?>
                        </table>
                </li>  
            </ul>
        </nav>
    </body>
</html>