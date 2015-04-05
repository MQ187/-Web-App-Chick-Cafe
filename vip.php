<?php 
    session_start(); 
    include("db_config.php");
?>

<!DOCTYPE html>
    <head>
        <title>VIP | Chick Cafe</title>
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
    
    <div id='account'>
    <table border="0" align="center">

    <?php
            echo '<form action="vip.php" method="POST">';
            echo '<tr><td><p>Discount Type:</p></td>
                    <td><select name="type">
                        <option value="0">1. Fixed</option>
                        <option value="1">2. Flexible</option>
                    </select></td></td>';
            echo '<td colspan=2 align="center"><p><input type="submit" value="Go"></p></td>';
            echo '</form>';

            if(isset($_POST['type']) && $_POST['type'] == 0){
                echo '<form action="vip.php" method="POST">';

                echo '<tr><td><p>Membership Type:</p></td>
                        <td><select name="memebershipselect">
                            <option value="1">1. Silver</option>
                            <option value="2">2. Gold</option>
                            <option value="3">3. Platinum</option>
                        </select></td></td>';

                $question = "SELECT idCustomer,name FROM `customer`";
                $sth = $db->prepare($question);
                $execute = $sth->execute();
                $fetch1 = $sth->fetchAll();

                echo '<tr><td><p>Select Customers:</p></td>';
                echo '<td><select name="ing[]" multiple="multiple">';
                    foreach($fetch1 as $key2){
                        echo '<option value='.$key2['idCustomer'].'>'. $key2['idCustomer'] .' '.$key2['name'].'</option>';
                    }
                echo '</select></td></tr>';

                echo '<tr><td><p>Discount Percentage:</p></td>
                        <td><input type="text" name="fixedPerc" placeholder="%" required="required">
                        <input type="hidden" name="type" value="$_POST[type]"></td>
                      </tr>';

                echo '<tr><td><p>End Date:</p></td>
                        <td><input type="text" name="endDate" placeholder="YYYY-MM-DD" required="required"></td>
                      </tr>';    
                echo '<tr><td colspan=2 align="center"><p><input type="submit" value="Add"></p></td></tr></form>';
            }elseif(isset($_POST['type']) && $_POST['type'] == 1) {
                /*echo '<form action="vip.php" method="POST">';
            <input type="hidden" name="type" value="$_POST[type]">
                echo '<tr><td><p>Membership Type:</p></td>
                        <td><select name="memebershipselect">
                            <option value="1">1. Silver</option>
                            <option value="2">2. Gold</option>
                            <option value="3">3. Platinum</option>
                        </select></td></td>';

                $question = "SELECT idCustomer,name FROM `customer`";
                $sth = $db->prepare($question);
                $execute = $sth->execute();
                $fetch1 = $sth->fetchAll();

                echo '<tr><td><p>Select Customers:</p></td>';
                echo '<td><select name="ing[]" multiple="multiple">';
                    foreach($fetch1 as $key2){
                        echo '<option value='.$key2['idCustomer'].'>'. $key2['idCustomer'] .' '.$key2['name'].'</option>';
                    }
                echo '</select></td></tr>';

                echo '<tr><td><p>Discount Percentage:</p></td>
                        <td><input type="text" name="fixedPerc" placeholder="%"></td>
                      </tr>';

                echo '<tr><td><p>Start Date:</p></td>
                        <td><input type="text" name="startDate" placeholder="YYYY-MM-DD"></td>
                      </tr>';

                echo '<tr><td><p>End Date:</p></td>
                        <td><input type="text" name="endDate" placeholder="YYYY-MM-DD"></td>
                      </tr>'; */
            }else{
                echo "<tr><td><p style='color:white;'>Please select a discount type.<p></td></tr>";
            }
            
    ?>  
    </table>
    </div>
    
    <?php
        if(isset($_POST['memebershipselect'])){
            $membership = $_POST['memebershipselect'];
            $discountType = $_POST['type'];
            $perc = $_POST['fixedPerc'];
            $strt = date('Y-m-d');
            $end = $_POST['endDate'];

            $question = "INSERT INTO discounts(vipMembership,discountType,discountValue,startTime,endTime) VALUES (:vipMembership,:discountType,:discountValue,:startTime,:endTime)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':vipMembership'=>$membership,':discountType'=>$discountType,':discountValue'=>$perc,':startTime'=>$strt, ':endTime'=>$end));

            $id = $db->lastInsertId();
            
            if(isset($_POST['ing'])){
                foreach($_POST['ing'] as $cusID){
                    $q = "INSERT INTO customerdiscount(idcustomer, idDiscounts) VALUES ($cusID, $id)";
                    $sth = $db->prepare($q);
                    $sth->execute();
                }
            }
            
            //echo '<META HTTP-EQUIV="Refresh" Content="0; URL=vip.php">'; 
        }
    ?>

    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>