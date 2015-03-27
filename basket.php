<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.

if (!isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
	
	//temp
	$_SESSION['basket'][0]['product_id']=1;
	$_SESSION['basket'][0]['quantity']=2;
	//temp

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
<th>Title</th><th>Description</th><th>Price</th><th>Type</th><th>Add</th><th>Quantity</th><th>Remove</th>
</tr>

<?php 
if ($max < 1){
	echo "There is nothing in your basket! wnat to order?";
	echo "<a href=index.php>Menu</a>";
}
else{
for($i=0;$i<$max;$i++){

	$product_id = $_SESSION['basket'][$i]['product_id'];
	echo $_SESSION['basket'][$i]['quantity'];
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
			echo "<td><form action=addBasket.php method=POST>
			    <input type='hidden' value='".$id[$i]."' name='product_id' />
			    <input type='hidden' value='basket.php' name='returnto' />
			    <input type=submit name=id value= '+1' />
			    </form></td>";
			echo '<td>&pound;' . $quantity . '</td>';
			echo "<td><form action=removeBasket.php method=POST>
			    <input type='hidden' value='". $product_id ."' name='product_id' />
			    <input type='hidden' value='basket.php' name='returnto' />
			    <input type=submit name=id value= '-1' />
			    </form></td>";
		}
	}
}

?>
</table>
</body>
</html>