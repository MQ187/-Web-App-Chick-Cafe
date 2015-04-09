<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
require_once("basketNotification.php");
//adds the notification for a basket and shows the user's vip status.
$_SESSION['access'] = "customer";
include('security.php');

if (!isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
}//create the basket if it doesnt exist.

$max = count($_SESSION['basket']); //check how many items are in the basket.
?>
<!DOCTYPE html>
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <?php
         require_once("nav/menus.php"); //include the manager nav
         ?>

    </header>
    <body>
    	<nav>
            <ul><li><i>My basket</i>
		<?php 
if ($max < 1){
	echo "<center><h1>Your basket is empty, please refer to one of the menus above.</h1></center>"; //tell customer the basket is empty
	die();
}
else{
	?>
<table id="tfhover" class="tftable" border="1">
<tr>
<th>Title</th><th>Description</th><th>Price</th><th>Type</th><th>Remove</th><th>Quantity</th><th>Add</th><th>Total</th>
</tr>

<?php

$total = 0;
for($i=0 ; $i < $max ; $i++){

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
		echo '<td>' . $quantity . '</td>';
		echo "<td><div class='add'><form action=addBasket.php method=POST>
		    <input type='hidden' value=".$id[$x]." name='product_id' />
		    <input type='hidden' value='basket.php' name='returnto' />
            <input type='image' name='submit' src='images/add.png' width=30 />
		    </form></div></td>";
		$sum = $quantity * $price[$x];
		echo '<td> &pound;' . $sum . '</td>';
		$total = $total + $sum;
		$x++;
	}
}
//Gets each item from the basket, gets the relevant details for each and displays them along with a + and - button to edit quantities.


if ($_SESSION['vipT'] == "0"){
  $type = 'Fixed';
  $discountRate = intval($_SESSION['vipD']);
}
//get fixed discount value
elseif ($_SESSION['vipT'] == "1"){
  $type = "Flex";

  $y=0;
  foreach ($_SESSION['vipFlex'] as $key) {
    if( $total > intval($_SESSION['vipFlex'][$y]['lo']) && $total < intval($_SESSION['vipFlex'][$y]['up'])){
      $discountRate = intval($_SESSION['vipFlex'][$y]['v']);
      break;
    }
    else{
      $y++;
    }
  }
}
//get flex Discount value.
$d = $total * ($discountRate / 100);
$total = $total - $d;
//Discount the price.

echo '<tr><td colspan="4"></td><td colspan="2">Discount = '.$discountRate.'%</td><td><b>Total:</b></td><td> &pound;' . $total . '</td></tr>';
if (isset($_POST['orderOK'])){
    $priority = $_POST['priority'];
    if ($priority == true) { $total = $total * 1.05; }
    
    echo "<tr><td colspan='9'><center><form action=pay.php id='pay' method=POST hidden>
          <input type='checkbox' value=". $priority ." name='priority'/>
          <input type='text' value=".$total." name='total' />
          <input type=hidden name=orderOK value='ok' />
          <input type=hidden name='discounted' value=" .$d. " />
          <input type=submit name=order value= 'Pay Now' />
          </form></center></td></tr>";  

          ?>
          <script type="text/javascript">
            document.getElementById("pay").submit();
          </script>
          <?php
}
else{

  $t = intval(date( "H" ,time()));
  
  if ($t < 12){
    //breakfast
    $cmeal = 1;
  }
  elseif ($t < 18){
    //Lunch
    $cmeal = 2;
  }
  else{
    //Dinner
    $cmeal = 3;
  }

if (isset($_SESSION['menu'])){
  switch ($_SESSION['menu']) {
    case '2':
    case '6':
    case '9':
      //Lunch
      $meal = "Lunch";
      $INTmeal = 2;
      $aTime = '12:00';
      break;

    case '3':
    case '7':
    case '10':
      //Dinner
      $meal = "Dinner";
      $INTmeal = 3;
      $aTime = '18:00';
      break;
  }
}



  echo "<tr><td colspan='9'><center><form action=order_check.php id='check' method=POST>
        <input type='checkbox' value='Priority' name='priority' />Priority (+5% fee)

        <input type=submit name=order value= 'Pay Now' ";

        if (isset($_SESSION['menu'])){
          if ($cmeal < $INTmeal){
            echo "onclick=\"javascript:return confirm('You are about to order ahead for ";
            echo $meal;
            echo ", this order will not be available until ";
            echo $aTime;
            echo ". Are you sure you wish to order?')\""; 
          }
        }
        //asks for confirmation to create an "advance order" from user.

  echo " />
        </form></center></td></tr>";  
}

echo '</table>';
}
?>
</li>
</ul>
</nav>
    </body>
</html>