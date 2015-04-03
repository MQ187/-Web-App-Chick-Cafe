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
$th = 0;
$tm = 0;
$ts = 0;
$hours = "";
$minutes = "";
$seconds = "";
$etc = 0;
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
        $time = $key['preperationTime'];
        $t = str_split($time);
        //get the time

        $h = $t[0] + $t[1];
        $m = $t[3] + $t[4];
        $s = $t[6] + $t[7];
        //split it into h,m,s

        $h = intval($h);
        $m = intval($m);
        $s = intval($s);
        //turn them into integers so calculation can be applied.

        $th = $th + ($quantity * $h);
        $tm = $tm + ($quantity * $m);
        $ts = $ts + ($quantity * $s);
        //add up all the h's, minutes and seconds. multiplied by quantity.
        $total = $total + ($quantity * $key['price']);
        $x++;
    }
}

while ($ts > 60){
    $tm++;
    $ts = $ts - 60;
}
while ($tm > 60){
    $th++;
    $tm = $tm - 60;
}
//normalise (no more than 60sec/min)

if ($ts<10) {
    $seconds = "0" . $ts;
}
else{
    $seconds = strval($ts);
}
if ($tm<10) {
    $minutes = "0" . $tm;
}
else{
    $minutes = strval($tm);
}
if ($th > 99){
    $hours = "99";
}
elseif ($th < 10) {
    $hours = "0" . $th;
}
else{
    $hours = strval($th);
}
$etc = $hours . ":" . $minutes . ":" . $seconds;


var_dump($total);
echo "<br>";
var_dump($missing);
echo "<br>";
var_dump($max);
echo "<br>";
var_dump($priority);
echo "<br>";
var_dump($etc);

//we've checked that the item is available, now we can create the order.

$question="INSERT INTO `order` (`idCustomer`, `orderPriority`, `etc`) VALUES(:idCustomer,:orderPriority,:etc)";
$add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$add->execute(array(':idCustomer' => $_SESSION['id'], ':orderPriority' => $priority, ':etc' => $etc));
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

    /*




    $question = 'UPDATE Ingredients JOIN itemIngredients ON Ingredients.idIngredients = itemIngredients.idIngredients
                    SET Ingredients.availability = 786 WHERE itemIngredients.idItem = 1';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':availability' => $navailability));
    //update the stock
    */
}

//$_SESSION['basket'] = array();
//header("Location:customerDash.php");



?>

