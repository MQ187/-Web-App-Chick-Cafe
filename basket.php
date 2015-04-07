<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
require_once("basketNotification.php");
//adds the notification for a basket and shows the user's vip status.

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
         require_once("nav/menus.php");
         ?>

    </header>
    <body>
    	<nav>
            <ul><li><i>My basket</i>
		<?php 
if ($max < 1){
	echo "<center><h1>Your basket is empty, please refer to one of the menus above.</h1></center>";
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
if (isset($_POST['orderOK'])){
    $priority = $_POST['priority'];
    if ($priority == true) { $total = $total * 1.05; }
    
    echo "<tr><td colspan='9'><center><form action=pay.php id='pay' method=POST hidden>
          <input type='checkbox' value=". $priority ." name='priority'/>
          <input type='text' value=".$total." name='total' />
          <input type=hidden name=orderOK value='ok' />
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

  switch ($_SESSION['menu']) {
    case '2':
    case '6':
    case '9':
      //Lunch
      $meal = "Lunch";
      $INTmean = 2;
      $aTime = '12:00';
      break;

    case '3':
    case '7':
    case '10':
      //Dinner
      $meal = "Dinner";
      $INTmean = 3;
      $aTime = '18:00';
      break;
  }


  echo "<tr><td colspan='9'><center><form action=order_check.php id='check' method=POST>
        <input type='checkbox' value='Priority' name='priority' />Priority (+5% fee)

        <input type=submit name=order value= 'Pay Now' ";

        if ($cmeal < $INTmeal){
          echo "onClick='return confirm(\'You are about to order ahead for ".$meal.", this order will not be available 
                until ".$aTime.". Are you sure you wish to order? '.esc_attr($this->event_name).'?\')'" 
        }

  echo "/>
        </form></center></td></tr>";  
}

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