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

$missing = 0;
//set basic parameters.

for($i=0;$i<$max;$i++){
    $product_id = $_SESSION['basket'][$i]['product_id'];
    $quantity = $_SESSION['basket'][$i]['quantity'];

    //get details of the product to order (one by one)

    $question = 'SELECT Ingredients.idIngredients as id, availability, quantity FROM Ingredients JOIN itemIngredients WHERE itemIngredients.idItem = :id';
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
}

echo "<tr><td colspan='9'><center><form action=basket.php id='pay' method=POST hidden >
  <input type='hidden' value=" . $priority . " name='priority' />
    <input type=hidden name=orderOK value='ok' />
    <input type=submit name=order value= 'Pay Now' />
    </form></center></td></tr>";  

    ?>
    <script type="text/javascript">
      document.getElementById("pay").submit();
    </script>      