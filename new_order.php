<?php session_start(); 
	require_once("db_config.php");
    // Connect to the Database and Select the tts database.

	
	$product_id = $_POST['product_id'];
    $quantity = 1;
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

    
?>