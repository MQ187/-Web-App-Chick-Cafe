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
$idPayment = $_POST['idPayment'];
$th = 0;
$tm = 0;
$ts = 0;
$hours = "";
$minutes = "";
$seconds = "";
$etc = 0;
$missing = 0;
//set basic parameters.


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

if ($priority == 1) { $total = $total * 1.05; }

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

$question="INSERT INTO `order` (`idCustomer`, `orderPriority`, `etc`) VALUES(:idCustomer,:orderPriority,:etc)";
$add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$add->execute(array(':idCustomer' => $_SESSION['id'], ':orderPriority' => $priority, ':etc' => $etc));
//this will create a new order.
$idorder = mysql_insert_id();

for($i=0;$i<$max;$i++){
    $product_id = $_SESSION['basket'][$i]['product_id'];
    $quantity = $_SESSION['basket'][$i]['quantity'];

    $question="INSERT INTO orderItem(idOrder,idItem,quantity) VALUES(:idOrder,:idItem,:quantity)";
    $add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $add->execute(array(':idOrder' => $idOrder, ':idItem' => $product_id, ':quantity' => $quantity));
    //create an orderitem for each item in the basket one by one

    foreach ($fetch as $key) {
        $idIngredient = $key['idIngredient'];
        $availability = $key['availability'];
        $q = $key['quantity'];

        $availability = $availability - ($quantity * $q);

        $question3 = 'UPDATE Ingredients SET availability = :availability WHERE idIngredients = :id';
        $sth3 = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth3->execute(array(':availability' => $availability, ':id' => $idIngredients));
        //update the stock

        $x++;
    }
    //get the current stock of each item & change it.
}

$question3 = 'UPDATE payment SET idorder = :idorder WHERE idPayment = :idPayment';
        $sth3 = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth3->execute(array(':idorder' => $idorder, ':idPayment' => $idPayment));
        //add the order id to the payment previously created.





$_SESSION['basket'] = array();
header("Location:customerDash.php");



?>

