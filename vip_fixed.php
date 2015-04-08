<?php 
    session_start(); 
    include("db_config.php");
    $_SESSION['access'] = array("manager","owner");
    include('security.php');

    require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Fixed VIP | Chick Cafe</title>
      <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
        <header>
           <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
           <br>
           <?php require_once("nav/managerDash.php"); ?>
        </header>

        <nav><ul><li><i>Fixed Discount</i></li></ul>
        <!--Table one with most content-->
        <table border="0" align="center">
        <form action="vip_fixed.php" method="POST">

            <tr><td><p>Membership Type:</p></td>
                <td><select name="memebershipselect">
                      <option value="1">1. Silver</option>
                      <option value="2">2. Gold</option>
                      <option value="3">3. Platinum</option>
                    </select>
                </td>
            </tr> 

            <?php 
                $question = "SELECT idCustomer,name FROM `customer`";
                $sth = $db->prepare($question);
                $execute = $sth->execute();
                $fetch1 = $sth->fetchAll();
            ?>
            <tr><td><p>Select Customers:</p></td>
                <td><select name="ing[]" multiple="multiple">
                  <?php  foreach($fetch1 as $key2){
                        echo '<option value='.$key2['idCustomer'].'>'. $key2['idCustomer'] .' '.$key2['name'].'</option>';
                    }?>
                    </select>
                </td>
            </tr>

            <tr><td><p>Discount Percentage:</p></td>
              <td><input type="text" name="fixedPerc" placeholder="%" required="required">
            </tr>

            <tr><td><p>End Date:</p></td>
                <td><input type="text" name="endDate" placeholder="YYYY-MM-DD" ></td>
                <?php echo '<input type="hidden" name="type" value='.$_POST['type'].'></td>'; ?>
            </tr>
      
           <tr><td><p align="center"><input type="submit" value="Add"></p></td></tr>  
        </form>
        </table> 
        </nav>
   </body>

   <?php
    if(isset($_POST['fixedPerc']) && $_POST['type']==0){
            $membership = $_POST['memebershipselect'];
            $discountType = $_POST['type'];
            $perc = $_POST['fixedPerc'];
            $strt = date('Y-m-d');

            if ($perc == "0"){
                unset($_POST['endDate']);
            }

            if (isset($_POST['endDate'])){

                $end = $_POST['endDate'];

                $question = "INSERT INTO discounts(vipMembership,discountType,discountValue,startTime,endTime) VALUES (:vipMembership,:discountType,:discountValue,:startTime,:endTime)";
                $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $add->execute(array(':vipMembership'=>$membership,':discountType'=>$discountType,':discountValue'=>$perc,':startTime'=>$strt, ':endTime'=>$end));

                $id = $db->lastInsertId();
            
                if(isset($_POST['ing'])){
                    foreach($_POST['ing'] as $cusID){
                        $q2 = "DELETE FROM customerdiscount WHERE idcustomer = '$cusID'";
                        $sth2 = $db->prepare($q2);
                        $execute = $sth2->execute();

                        $q = "INSERT INTO customerdiscount(idcustomer, idDiscounts) VALUES ($cusID, $id)";
                        $sth = $db->prepare($q);
                        $sth->execute();
                    }
                }
            }
            else {
                $question = "INSERT INTO discounts(vipMembership,discountType,discountValue,startTime) VALUES (:vipMembership,:discountType,:discountValue,:startTime)";
                $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $add->execute(array(':vipMembership'=>$membership,':discountType'=>$discountType,':discountValue'=>$perc,':startTime'=>$strt));

                $id = $db->lastInsertId();
            
                if(isset($_POST['ing'])){
                    foreach($_POST['ing'] as $cusID){
                        $q2 = "DELETE FROM customerdiscount WHERE idcustomer = '$cusID'";
                        $sth2 = $db->prepare($q2);
                        $execute = $sth2->execute();

                        $q = "INSERT INTO customerdiscount(idcustomer, idDiscounts) VALUES ($cusID, $id)";
                        $sth = $db->prepare($q);
                        $sth->execute();
                    }
                }
            }
            
            
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=vip.php">'; 
        }
   ?>
</html>





