<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
?>

<!DOCTYPE html>
    <head>
        <title>Update Item | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="managerDash.php">Current Orders</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Employee Accounts</a></li>
                <li><a href="#">Refund</a></li>
                <li><a href="#">VIP</a></li>
                <li><a href="stock.php">Stock</a></li>
                <li><a href="myAccount.php">My Account</a></li>
                 <li><a href="logoff.php">Logout</a></li>
            </ul>
        </div>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php
        if(isset($_POST['itemid'])){
        $question = "SELECT * FROM item WHERE iditem = '$_POST[itemid]'";
        $sth = $db->prepare($question);
        $execute = $sth->execute();
        $fetch = $sth->fetchAll();
        
        $i=1;
        foreach($fetch as $key){
            echo '<form action="update_item.php" method="POST">';
            echo '<tr><td><p>Menu:</p></td>
                    <td><select name="menuselect">
                        <option value="1">1. Breakfast</option>
                        <option value="2">2. Lunch</option>
                        <option value="3">3. Dinner</option>
                        <option value="4">4. Drink</option>
                        <option value="5">5. Breakfast Drink</option>
                        <option value="6">6. Lunch Drink</option>
                        <option value="7">7. Dinner Drink</option>
                    </select></td></td>';
            echo '<tr><td><p>Type:</p></td>
                    <td><select name="type">
                        <option value="Meal">1. Meal</option>
                        <option value="Starter">2. Starter</option>
                        <option value="Dessert">3. Dessert</option>
                        <option value="Cold Drink">4. Cold Drink</option>
                        <option value="Hot Drink">5. Hot Drink</option>
                    </select></td></td>';
            echo '<tr><td><p>Name:</p></td><td><input type="text" value='.$key['name'].' name="name" required="required"/></td></tr>';
            echo '<tr><td><p>Description:</p></td><td><input type="text" value='.$key['description'].' name="des" required="required"/></td></tr>';
            echo '<tr><td><p>Price:</p></td><td><input type="text" name="price" value='.$key['price'].' required="required"/></td></tr>'; 
            echo '<tr><td><p>Preperation Time:</p></td><td><input type="text" value='.$key['preperationTime'].' name="prepTime" placeholder="HH:MM:SS" required="required"/></td></tr>';
            if ($key['dailySpecial'] == true){
                $checked = "checked";
            }
            else{
                $checked = "";
            }
            
            echo '<tr><td><p>Daily Special:</p></td><td><input type="checkbox" name="isSpecial" value="true" '.$checked.'/></td></tr>';
            echo '<input type=hidden name=itemiden value='.$_POST['itemid'].' />';
            $i++;
        }

        echo '<tr><td colspan=2 align="center"><p>
                  <input type="submit" value="Update"></p></td></tr>
             </table>
            </div>
            </form>';
        }	
        else{
            $id = $_POST['itemiden'];
            $menuid = $_POST['menuselect'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $des = $_POST['des'];
            $price = $_POST['price'];
            $prepTime = $_POST['prepTime'];
            if (!isset($_POST['isSpecial'])){
                $dailySpecial = false;
            }
            else{
            $dailySpecial = true;
            }

            $question="UPDATE `item` SET idMenu='$menuid', type='$type', name='$name', description='$des', price='$price', preperationTime='$prepTime', dailySpecial='$dailySpecial' WHERE iditem = '$id'"; 
            $sth = $db->prepare($question);
            $sth->execute();
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=items.php">';
        }
    ?>
  
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>