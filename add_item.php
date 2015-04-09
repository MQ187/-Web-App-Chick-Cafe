<?php 
    session_start(); //start the session
    include("db_config.php"); //include the database configuration
    
    $_SESSION['access'] = array("owner","manager");
    include('security.php');
    //only give access to manager and/or owner

    require_once("messages.php");
    //adds the check for all possible errors as well as the warnings.
?>

<!DOCTYPE html>
    <head>
        <!--set the title and include the css file-->
        <title>Add Item | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <br>
         <?php
            //include the manager nav
            require_once('nav/managerDash.php');
         ?>
    </header>
    
    <div id='account'>
    <table border="0" align="center">

    <?php
        //form to add an item
        echo '<form action="add_item.php" method="POST">';
        echo '<tr><td><p>Menu:</p></td> 
                <td><select name="menuselect">
                    <option value="1">1. Breakfast</option>
                    <option value="2">2. Lunch</option>
                    <option value="3">3. Dinner</option>
                    <option value="4">4. Drink</option>
                    <option value="5">5. Breakfast Cold Drink</option>
                    <option value="8">6. Breakfast Hot Drink</option>
                    <option value="6">7. Lunch Cold Drink</option>
                    <option value="9">8. Lunch Hot Drink</option>
                    <option value="7">9. Dinner Cold Drink</option>
                    <option value="10">10. Dinner Cold Drink</option>
                </select></td></td>';
        echo '<tr><td><p>Type:</p></td>
                <td><select name="type">
                    <option value="Meal">1. Meal</option>
                    <option value="Starter">2. Starter</option>
                    <option value="Dessert">3. Dessert</option>
                    <option value="Cold Drink">4. Cold Drink</option>
                    <option value="Hot Drink">5. Hot Drink</option>
                </select></td></td>';
        echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" required="required"/></td></tr>';
        echo '<tr><td><p>Description:</p></td><td><input type="text" name="des" required="required"/></td></tr>';

        //get the ingredient name and id to list for selection
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
        echo '<tr><td><p>Daily Special:</p></td><td><input type="checkbox" name="isSpecial" value="Yes" /></td></tr>';
    ?>  
    <tr><td colspan=2 align="center"><p><input type="submit" value="Add"></p></td></tr>
    </table>
    </div>
    </form>
    
    <?php
        //check if special checkbox is enabled
        if(isset($_POST['isSpecial']) && $_POST['isSpecial'] == 'Yes'){
            $menuid = $_POST['menuselect'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $des = $_POST['des'];
            $price = $_POST['price'];
            $prepTime = $_POST['prepTime'];

            //store it as a special item if it is a daily special
            $question = "INSERT INTO item(idMenu,type,name,description,price,preperationTime,dailySpecial) VALUES (:idmenu,:type,:name,:des,:price,:prepTime,:special)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':idmenu'=>$menuid,':type'=>$type,':name'=>$name,':des'=>$des,':price'=>$price,':prepTime'=>$prepTime,':special'=>'1'));
            
            $id = $db->lastInsertId(); //get the id of the last item stored into the db
            
            //insert the selected ingredients into the itemingredients table
            if(isset($_POST['ing'])){
                foreach($_POST['ing'] as $ingred){
                    $q = "INSERT INTO itemingredients(idItem, idIngredients) VALUES ($id, $ingred)";
                    $sth = $db->prepare($q);
                    $sth->execute();
                }
            }

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=items.php">'; 

        }else{
            //otherwise store it as a non special item
            if(isset($_POST['name'])){
            $menuid = $_POST['menuselect'];
            $type = $_POST['type'];
            $name = $_POST['name'];
            $des = $_POST['des'];
            $price = $_POST['price'];
            $prepTime = $_POST['prepTime'];

            //store it as a special item if it is a daily special
            $question = "INSERT INTO item(idMenu,type,name,description,price,preperationTime,dailySpecial) VALUES (:idmenu,:type,:name,:des,:price,:prepTime,:special)";
            $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $add->execute(array(':idmenu'=>$menuid,':type'=>$type,':name'=>$name,':des'=>$des,':price'=>$price,':prepTime'=>$prepTime,':special'=>'0'));

            $id = $db->lastInsertId(); //get the id of the last item stored into the db
            
            //insert the selected ingredients into the itemingredients table
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


    </body>
</html>