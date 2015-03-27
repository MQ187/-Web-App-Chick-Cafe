<?php session_start(); 
	require_once("db_config.php");
    // Connect to the Database and Select the tts database.

	
	$product_id = $_POST['itemid'];
	$missing = 0;

	$question = 'SELECT availability FROM itemIngredients LEFT JOIN Ingredients WHERE itemIngredients.idItem = :id';
	$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':id' => $product_id));
	$fetch = $sth->fetchAll();

    $i=1;
    foreach ($fetch as $key) {
    	$availability[$i] = $key['availability'];
    	if ($availability[$i]<1){
    		$missing++;
    	}
    	$i++;
    }

    if ($missing > 0){
    	$_SESSION['message'] = "6"; //Product Unavailable.
		header('Location: '. $_POST['returnto']);
		die();
    }
    //checks if the ingredients needed for each one of these products exists. if even one is missing, error! message 6 sent back.

    if(!isset($_SESSION['basket'])){
    $_SESSION['basket'] = array();
	}
 
	if(check if it exists already)){ //array_key_exists($product_id, $_SESSION['basket']
		/*
		1: array_walk ( $_SESSION['basket'], function (&$key) { $key["transaction_date"] = date('d/m/Y',$key["transaction_date"]); } );

		2: foreach($_SESSION['basket'] as &$value) {
		$newValue = $value['quantity'] + 1
  		$value['quantity'] = $newValue;
		*/
		}
	}// check if the item is in the array, if it is: add 1
	else{
	    $existing_basket = $_SESSION['basket'];
		$new_item = array("id" => $product_id, "quantity" => 1);

		$_SESSION['basket'] = array_merge($existing_basket, $new_item);
	}//otherwise, create it.

	header('Location: '. $_POST['returnto']);
	
?>

Array
(
    [0] => Array
        (
            [transaction_user_id] => 359691e27b23f8ef3f8e1c50315cd506
            [transaction_no] => 19500912050218
            [transaction_total_amount] => 589.00
            [transaction_date] => 1335932419
            [transaction_status] => cancelled
        )

    [1] => Array
        (
            [transaction_user_id] => 9def02e6337b888d6dbe5617a172c18d
            [transaction_no] => 36010512050819
            [transaction_total_amount] => 79.00
            [transaction_date] => 1336476696
            [transaction_status] => cancelled
        )