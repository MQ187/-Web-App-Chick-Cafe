<?php 
    session_start(); 
    include("db_config.php");
?>

<!DOCTYPE html>
    <head>
        <title>Update Stock | Chick Cafe</title>
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
        if(isset($_POST['stockid'])){
        $question = "SELECT * FROM ingredients WHERE idIngredients = '$_POST[stockid]'";
        $sth = $db->prepare($question);
        $execute = $sth->execute();
        $fetch = $sth->fetchAll();
        
        $i=1;
        foreach($fetch as $key){
            echo '<form action="update_stock.php" method="POST">';
            echo '<tr><td><p>Name:</p></td><td><input type="text" name="name" size="20" maxlength="45" value=' . $key['name'].'></td></tr>';
            echo '<tr><td><p>Availability:</p></td><td><input type="text" name="availability" size="20" maxlength="45" value=' . $key['availability'].'></td></tr>';
            echo '<tr><td><p>Price:</p></td><td><input type="text" name="price" size="20" maxlength="45" value=' . $key['price'].'></td></tr>'; 
            echo '<input type=hidden name=stockiden value='.$_POST['stockid'].' />';
            $i++;
        }
        }	
    ?>
        
    <tr><td colspan=2 align="center"><p>
          <input type="submit" value="Update"></p></td></tr>
    </table>
    </div>
    </form>
    <?php
        if(isset($_POST['name'])){
        $id = $_POST['stockiden'];
        $name = $_POST['name'];
        $av = $_POST['availability'];
        $price = $_POST['price'];

        $question="UPDATE `ingredients` SET name='$name', availability='$av', price='$price' WHERE idIngredients = '$id'"; 
        $sth = $db->prepare($question);
        $sth->execute();
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=stock.php">'; 
        }
    ?>
    </body>
</html>