<?php 
    session_start(); 
    include("db_config.php");
?>

<!DOCTYPE html>
    <head>
        <title>Add Item | Chick Cafe</title>
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

            echo '<form action="add_item.php" method="POST">';
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
                        <option value="Hot Drink">4. Hot Drink</option>
                    </select></td></td>';
            echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" required="required"/></td></tr>';
            echo '<tr><td><p>Description:</p></td><td><input type="text" name="des" required="required"/></td></tr>';

            $question = "SELECT idIngredients,name FROM `ingredients`";
            $sth = $db->prepare($question);
            $execute = $sth->execute();
            $fetch1 = $sth->fetchAll();

            echo '<tr><td><p>Ingredients:</p></td>';
            echo '<td><select name="ing[]" multiple="multiple">';
                foreach($fetch1 as $key2){
                    echo '<option value='.$key2['idIngredients'].'>'.$key2['name'].'</option>';
                }
            echo '</select></td></tr>';

            echo '<tr><td><p>Price:</p></td><td><input type="text" name="price" required="required"/></td></tr>'; 
            echo '<tr><td><p>Preperation Time:</p></td><td><input type="text" name="prepTime" placeholder="HH:MM:SS" required="required"/></td></tr>';
            echo '<tr><td><p>Daily Special:</p></td><td><input type="checkbox" name="isSpecial" value="Yes" required="required"/></td></tr>';
    ?>  
    <tr><td colspan=2 align="center"><p><input type="submit" value="Add"></p></td></tr>
    </table>
    </div>
    </form>
    
    <?php
        if(isset($_POST['isSpecial']) && $_POST['isSpecial'] == 'Yes'){
            $menuid = $_POST['menuselect'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $des = $_POST['des'];
            $price = $_POST['price'];
            $prepTime = $_POST['prepTime'];

            $question = "INSERT INTO item(idMenu,type,name,description,price,preperationTime,dailySpecial) VALUES (:idmenu,:type,:name,:des,:price,:prepTime,:special)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':idmenu'=>$menuid,':type'=>$type,':name'=>$name,':des'=>$des,':price'=>$price,':prepTime'=>$prepTime,':special'=>'1'));
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=items.php">'; 

        }else{
            if(isset($_POST['name'])){
            $menuid = $_POST['menuselect'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $des = $_POST['des'];
            $price = $_POST['price'];
            $prepTime = $_POST['prepTime'];

            $question = "INSERT INTO item(idMenu,type,name,description,price,preperationTime,dailySpecial) VALUES (:idmenu,:type,:name,:des,:price,:prepTime,:special)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':idmenu'=>$menuid,':type'=>$type,':name'=>$name,':des'=>$des,':price'=>$price,':prepTime'=>$prepTime,':special'=>'0'));

            $id = $db->lastInsertId();
            
            if(isset($_POST['ing'])){
                foreach($_POST['ing'] as $ingred){
                    $q = "INSERT INTO itemingredients(idItem, idIngredients) VALUES ($id, $ingred)";
                    $sth = $db->prepare($q);
                    $sth->execute();
                }
            }
            
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=items.php">'; 
            }
        }
    ?>

    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>