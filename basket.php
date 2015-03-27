<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.

if (!isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
}//create the basket if it doesnt exist.

$max=count($_SESSION['basket']); //check how many items are in the basket.

?>
<html>
	<head>
		<title>Main | Chick Cafe</title>
		<link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
	</head>
	<body>
<table id="tfhover" class="tftable" border="1">
<tr>
<th>Title</th><th>Description</th><th>Price</th><th>Type</th><th>Add</th><th>Quantity</th><th>Remove</th><th>Total</th>
</tr>

<?php 
if ($max < 1){
	echo "There is nothing in your basket! wnat to order?";
	echo "<a href=index.php>Menu</a>";
}
else{
$total = 0;
for($i=0;$i<$max;$i++){

	$product_id = $_SESSION['basket'][$i]['product_id'];
	$quantity = $_SESSION['basket'][$i]['quantity'];

	$question="SELECT * FROM item WHERE iditem=:id";
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':id' => $product_id));
	$fetch = $sth->fetchAll();

	$i=1;
		foreach ($fetch as $key) {

			$id[$i] = $key['iditem'];
			$pname[$i] = $key['name'];
			$des[$i] = $key['description'];
			$price[$i] = $key['price'];
			$type[$i] = $key['type'];

			echo '<tr>';
			echo '<td>'. $pname[$i] .'</td>';
			echo '<td>'. $des[$i] .'</td>';
			echo '<td> &pound;'. $price[$i] .'</td>';
			echo '<td>'. $type[$i] .'</td>';
			echo "<td><form action=removeBasket.php method=POST>
			    <input type='hidden' value='". $product_id ."' name='product_id' />
			    <input type='hidden' value='basket.php' name='returnto' />
			    <input type=submit name=id value= '-1' />
			    </form></td>";
			echo '<td>' . $quantity . '</td>';
			echo "<td><form action=addBasket.php method=POST>
			    <input type='hidden' value='".$id[$i]."' name='product_id' />
			    <input type='hidden' value='basket.php' name='returnto' />
			    <input type=submit name=id value= '+1' />
			    </form></td>";
			$sum = $quantity * $price[$i];
			echo '<td> &pound;' . $sum . '</td>';
			$total = $total + $sum;
		}
	}
}
echo '<tr><td colspan="6"></td><td><b>Total:</b></td><td> &pound;' . $total . '</td></tr>';
echo "<tr><td colspan='9'><center><form action=new_order.php method=POST>
			    <input type='hidden' value='order.php' name='returnto'/>
			    <input type=submit name=order value= 'Confirm Order' />
			    </form></center></td></tr>"
?>
</table>
</body>
</html>