<?php session_start(); 
require_once("db_config.php");
// Connect to the Database and Select the tts database.

date_default_timezone_set('UTC');
// set the default timezone to use.

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
    header("Location:basket.php");
    die();
}//create the basket if it doesnt exist. (only to avoid failed errors.)

$max=count($_SESSION['basket']); //check how many items are in the basket.
if (isset($_POST['priority'])){
    $priority = 1;    
}
else{
    $priority = 0;
}
$total = 0;
//$etc = 0;
$missing = 0;
//set basic parameters.

for($i=0;$i<$max;$i++){
    $product_id = $_SESSION['basket'][$i]['product_id'];
    $quantity = $_SESSION['basket'][$i]['quantity'];

    //get details of the product to order (one by one)

    $question = 'SELECT availability FROM Ingredients JOIN itemIngredients WHERE itemIngredients.idItem = :id';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':id' => $product_id));
    $fetch = $sth->fetchAll();

    $x=1;
    foreach ($fetch as $key) {
        $availability[$x] = $key['availability'];
        if ($availability[$x]<$quantity){
            $missing++;
            break(2);
        }
        $x++;
    }
    //checks if the stock is sufficient to place an order

    if ($missing > 0){
        $_SESSION['message'] = "6"; //Product Unavailable.
        echo "<form action=removeBasket.php method=POST id='DELETE'>
                <input type='hidden' value='". $product_id ."' name='product_id' />
                <input type='hidden' value='basket.php' name='returnto' />
                <input type='hidden' value='". $availability[$x] ."' name='quantity'/>
                <input type=submit name=DELETE '/>
                </form>";
        ?>
        <script type="text/javascript">
            document.getElementById("DELETE").submit();
        //document.getElementById("DELETE").submit(); // automatically submits the form above.
        </script>
        <?php
        die();
    }
    //if not, go back to the basket, remove and declare one as missing stock.

    $question = 'SELECT preperationTime,price FROM Item WHERE iditem = :id';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':id' => $product_id));
    $fetch = $sth->fetchAll();

    $x=1;
    foreach ($fetch as $key) {
        $timeItems = $quantity * $key['preperationTime'] ;
        $etc = $etc + $timeItems;
        $total = $key['price'];
        $x++;
    }



}
var_dump($etc);
echo "<br>";
var_dump($total);
echo "<br>";
var_dump($missing);
echo "<br>";
var_dump($max);
echo "<br>";
var_dump($priority);

//we've checked that the item is available, now we can create the order.
/*

INSERT INTO order(idCustomer,orderDate,orderTime,orderPriority,orderStatus,etc) VALUES(2,CURDATE(),CURTIME(),0,"PENDING",MAKETIME(00,03,30))

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
*/
//$_SESSION['basket'] = array();
//header("Location:customerDash.php");



?>

