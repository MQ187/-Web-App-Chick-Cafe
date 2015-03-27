<?php session_start(); 
require_once("db_config.php");
// Connect to the Database and Select the tts database.

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}//create the basket if it doesnt exist.

$max=count($_SESSION['basket']); //check how many items are in the basket.

$total = 0;
for($i=0;$i<$max;$i++){
    $product_id = $_SESSION['basket'][$i]['product_id'];
    $quantity = $_SESSION['basket'][$i]['quantity'];

    //gets a product to order (one by one)

    $missing = 0;

    $question = 'SELECT availability FROM itemIngredients LEFT JOIN Ingredients WHERE itemIngredients.idItem = :id';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':id' => $product_id));
    $fetch = $sth->fetchAll();

    $x=1;
    foreach ($fetch as $key) {
        $availability[$x] = $key['availability'];
        if ($availability[$x]<$quantity){
            $missing++;
        }
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

?>