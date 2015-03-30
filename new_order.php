<?php session_start(); 
require_once("db_config.php");
// Connect to the Database and Select the tts database.

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}//create the basket if it doesnt exist.

$max=count($_SESSION['basket']); //check how many items are in the basket.
if (isset($_POST['priority'])){
    $priority = 1;    
}
else{
    $priority = 0;
}
$total = 0;
$etc = 0;

for($i=0;$i<$max;$i++){
    $product_id = $_SESSION['basket'][$i]['product_id'];
    $quantity = $_SESSION['basket'][$i]['quantity'];

    //gets a product to order (one by one)

    $missing = 0;

    $question = 'SELECT availability,preperationTime FROM itemIngredients LEFT JOIN Ingredients WHERE itemIngredients.idItem = :id';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':id' => $product_id));
    $fetch = $sth->fetchAll();

    $x=1;
    foreach ($fetch as $key) {
        $availability[$x] = $key['availability'];
        if ($availability[$x]<$quantity){
            $missing++;
        }
        $timeItems = $quantity * $key['preperationTime'] ;
        $etc = $etc + $timeItems;
        $x++;
    }
    //checks if the stock is sufficient to place an order

    if ($missing > 0){
        $_SESSION['message'] = "6"; //Product Unavailable.
        echo "<form action=removeBasket.php method=POST>
                <input type='hidden' value='". $product_id ."' name='product_id' />
                <input type='hidden' value='basket.php' name='returnto' />
                <input type='hidden' value='". $availability[$i] ."' name='quantity'/>
                <input type=submit name=DELETE/>
                </form>";
        ?>
        <script type="text/javascript">
        document.getElementById("DELETE").submit(); // automatically submits the form above.
        </script>
        <?php
        die();
    }
    //if not, go back to the basket, remove and declare one as missing stock.  
}
//we've checked that the item is available, now we can create the order.

date_default_timezone_set('UTC');
// set the default timezone to use.

$question="INSERT INTO order(idCustomer,orderDate,orderTime,orderPriority,orderStatus,etc) VALUES(:idCustomer,:orderDate,:orderTime,:orderPriority,:orderStatus,:etc)";
$add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$add->execute(array(':idCustomer' => $_SESSION['id'], ':orderDate' => CURDATE(), ':orderTime' => CURTIME(), ':orderPriority' => $priority, ':orderStatus' => "Pending", ':etc' => $etc));
//this will create a new order.

for($i=0;$i<$max;$i++){
    $product_id = $_SESSION['basket'][$i]['product_id'];
    $quantity = $_SESSION['basket'][$i]['quantity'];
    $question="INSERT INTO orderItem(idOrder,idItem,quantity) VALUES(:idOrder,:idItem,:quantity)";
    $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $add->execute(array(':idOrder' => $idOrder, ':idItem' => $product_id, ':quantity' => $quantity));
    //create an orderitem for each item in the basket one by one

    $navailability = $availability[$i] - $quantity;
    //get the current stock of each item & change it.

    $question = 'UPDATE availability SET availability=:navailability LEFT JOIN Ingredients WHERE itemIngredients.idItem = :id';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':availability' => $navailability));
    //update the stock
}

header("Location:customerDash.php");


?>