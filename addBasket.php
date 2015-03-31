<?php session_start(); 
	require_once("db_config.php");
    // Connect to the Database and Select the tts database.

	$product_id = $_POST['product_id'];
    $quantity = 1;
	$missing = 0;

	$question = 'SELECT availability FROM Ingredients JOIN itemIngredients WHERE itemIngredients.idItem = :id';
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

    if(!is_array($_SESSION['basket'])){
        $_SESSION['basket']=array();
    }

    $max=count($_SESSION['basket']);
    $flag=0;
    for($i=0;$i<$max;$i++){
        if($product_id == $_SESSION['basket'][$i]['product_id']){
            $flag=1;
            $x = $i;
            break;
        }
    }
    //checks if the product already exists in the basket array.
    if ($flag==0){ 
        $_SESSION['basket'][$max]['product_id']=$product_id;
        $_SESSION['basket'][$max]['quantity']=$quantity;
    }   
    //checks if the basket exists at all, if not it creates one. populate with the new data in either case.
    elseif ($flag==1){
        $old_quantity = $_SESSION['basket'][$x]['quantity'];
        $new_quantity = $old_quantity + 1;
        $_SESSION['basket'][$x]['quantity'] = $new_quantity;
    }
    //gets the current value in the basket, adds one and replaces it in the session.

header('Location: '. $_POST['returnto']);
	
?>
