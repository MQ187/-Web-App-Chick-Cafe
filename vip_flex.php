<?php 
    session_start(); 
    include("db_config.php");
?>
<!DOCTYPE html>
<html>
    <head>
      <title>Flex VIP | Chick Cafe</title>
      <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
      <script type="text/javascript" src="vip.js"></script> 
    </head>

    <body>
        <header>
           <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
           <br>
           <?php require_once("nav/managerDash.php"); ?>
        </header>

        <nav><ul><li><i>Flexible Discount</i></li></ul>
        <form action="vip_flex.php" class="register" method="POST">

          <!--Table one with most content-->
          <table border="0" align="center">

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

            <tr><td><p>End Date:</p></td>
                <td><input type="text" name="endDate" placeholder="YYYY-MM-DD" required="required"></td>
                <?php echo '<input type="hidden" name="type" value='.$_POST['type'].'></td>'; ?>
            </tr>

          </table>

          <!--START OF THE TABLE FOR FLEX-->
          <p align="center"> 
            <input type="button" value="Add Threshold" onclick="addRow('dataTable')"> 
            <input type="button" value="Remove Threshold" onclick="deleteRow('dataTable')"> 
          </p>

          <table id="dataTable" style="margin: 0px auto;">
            <tr>
              
            <td><input type="checkbox" required="required" name="chk[]" checked="checked"></td>
            <td><label style="color:white;">Lower</label><br>
                <input type="text" required="required" name="lower[]">
            </td>
            <td><label style="color:white;" for="upper">Upper</label><br>
                <input type="text" required="required" class="small" name="upper[]">
            </td>
            <td><label style="color:white;" for="perc">Percentage</label><br>
                <input type="text" required="required" class="small" name="perc[]">
            </td>
                                
            </tr>
          </table>
          <!--END OF THE TABLE FOR FLEX-->
          
          <p align="center"><input type="submit" value="Add"></p>
                
        </form>
        </nav>
   </body>

   <?php
    if(isset($_POST['endDate']) && $_POST['type']==1){
        $membership = $_POST['memebershipselect'];
        $discountType = $_POST['type'];
        $strt = date('Y-m-d');
        $end = $_POST['endDate'];

        $UPPER=$_POST['upper'];
        $LOWER=$_POST['lower'];     
        $PERC=$_POST['perc']; 

        $question = "INSERT INTO discounts(vipMembership,discountType,startTime,endTime) VALUES (:vipMembership,:discountType,:startTime,:endTime)";
        $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $add->execute(array(':vipMembership'=>$membership,':discountType'=>$discountType,':startTime'=>$strt, ':endTime'=>$end));

        $id = $db->lastInsertId();

        foreach($LOWER as $a=>$b){
            $up = $UPPER[$a];
            $low = $LOWER[$a];
            $percen = $PERC[$a];

            $q2 = "INSERT INTO flexdiscount(idDiscount, uppr, lowr, value) VALUES ($id, $up, $low, $percen)";
            $add2 = $db->prepare($q2);
            $add2->execute();
        }

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

        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=vip.php">';       

    }
   ?>
</html>





