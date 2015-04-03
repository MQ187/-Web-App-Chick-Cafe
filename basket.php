<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.

if (!isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
}//create the basket if it doesnt exist.

$max=count($_SESSION['basket']); //check how many items are in the basket.
?>
<!DOCTYPE html>
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="br_menu.php">Breakfast</a></li>
                <li><a href="lu_menu.php">Lunch</a></li>
                <li><a href="di_menu.php">Dinner</a></li>
                <li><a href="dr_menu.php">Drinks</a></li>
                <?php
                session_start();
                if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
                if (!isset($_SESSION['userType'])) {$_SESSION['userType'] = "NONE";}
                $userType = $_SESSION['userType'];
                if ($_SESSION['logedIn'] == false){
                    ?> 
                    <li><a href="login.php">Login/Register</a></li> 
                    <?php
                }
                else{

                    Switch($userType){
                        case 'customer':
                        ?> 
                        <li><a href="customerDash.php">Dashboard</a></li>
                        <?php
                        break;
                        case 'employee':
                        ?>
                        <li><a href="employeeDash.php">Dashboard</a></li>
                        <?php
                        break;
                        case 'manager':
                        ?>
                        <li><a href="managerDash.php">Dashboard</a></li>
                        <?php
                        break;
                    }
                    ?>
                    <li><a href="logoff.php">Logout</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </header>
    <body>
    	<nav>
            <ul><li><i>My basket</i>
		<?php 
if ($max < 1){
	echo "<center><h1>There is nothing in your basket! want to order?</h1><br><a href=index.php>Menu</a></center>";
}
else{
	?>
<table id="tfhover" class="tftable" border="1">
<tr>
<th>Title</th><th>Description</th><th>Price</th><th>Type</th><th>Remove</th><th>Quantity</th><th>Add</th><th>Total</th>
</tr>

<?php
$total = 0;
for($i=0;$i<$max;$i++){

	$product_id = $_SESSION['basket'][$i]['product_id'];
	$quantity = $_SESSION['basket'][$i]['quantity'];

	$question="SELECT * FROM item WHERE iditem=:id";
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':id' => $product_id));
	$fetch = $sth->fetchAll();

	$x=0;
	foreach ($fetch as $key) {

		$id[$x] = $key['iditem'];
		$pname[$x] = $key['name'];
		$des[$x] = $key['description'];
		$price[$x] = $key['price'];
		$type[$x] = $key['type'];

		echo '<tr>';
		echo '<td>'. $pname[$x] .'</td>';
		echo '<td>'. $des[$x] .'</td>';
		echo '<td> &pound;'. $price[$x] .'</td>';
		echo '<td>'. $type[$x] .'</td>';
		echo "<td><div class='add'><form action=removeBasket.php method=POST>
		    <input type='hidden' value=". $product_id ." name='product_id' />
		    <input type='hidden' value='basket.php' name='returnto' />
            <input type='image' name='submit' src='images/del.png' width=30 />
		    </form></div></td>";
            //<input type=submit name=id value= '-1' />
		echo '<td>' . $quantity . '</td>';
		echo "<td><div class='add'><form action=addBasket.php method=POST>
		    <input type='hidden' value=".$id[$x]." name='product_id' />
		    <input type='hidden' value='basket.php' name='returnto' />
            <input type='image' name='submit' src='images/add.png' width=30 />
		    </form></div></td>";
            //<input type=submit name=id value= '+1' />
		$sum = $quantity * $price[$x];
		echo '<td> &pound;' . $sum . '</td>';
		$total = $total + $sum;
		$x++;
	}
	}

echo '<tr><td colspan="6"></td><td><b>Total:</b></td><td> &pound;' . $total . '</td></tr>';
echo "<tr><td colspan='9'><center><form action=new_order.php method=POST>
				<input type='checkbox' value='Priority' name='priority'/>Priority (+x% fee)
			    <input type='hidden' value='order.php' name='returnto'/>
			    <input type=submit name=order value= 'Confirm Order' />
			    </form></center></td></tr>";
echo '</table>';
}
?>
</li>
</ul>
</nav>
    </body>
    
    <footer>
        <strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
    </footer>

    </body>
</html>