<?php session_start(); 
	require_once("db_config.php");
    // Connect to the Database and Select the tts database.

    //check if the basket hasnt been set
    if (!isset($_SESSION['basket'])){
        $_SESSION['basket'] = array();
      }

	$product_id = $_POST['product_id'];
    $quantity = 1;
	$missing = 0;

    //get availability for items from ingredients tbl
	$question = 'SELECT availability FROM Ingredients JOIN itemIngredients WHERE itemIngredients.idItem = :id';
	$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':id' => $product_id));
	$fetch = $sth->fetchAll();

    $i=0;
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
    //checks if the basket exists at all, if not it creates one. populate with the new data in either case.

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

    $question = 'SELECT idMenu FROM item WHERE idItem = :id';
    $sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':id' => $product_id));
    $fetch1 = $sth->fetchAll();

    foreach ($fetch1 as $key1) {
        
        $idMenu = $key1['idMenu'];
        if (!isset($_SESSION['menu']) && $idMenu == 4){} 
        //if no menu assigned and menu = drinks, dont give a value to the menu variable in session.
        
        elseif (!isset($_SESSION['menu'])){
            $_SESSION['menu'] = $idMenu;
        }
        //if no menu assigned and menu not equal to drinks, give it  value.
        elseif ($idMenu != $_SESSION['menu'] && $idMenu != 4){
            $_SESSION['message'] = "9"; //Product Unavailable.
            header('Location: '. $_POST['returnto']);
            die();
        }
        //if menu assigned != to session variable & current menu not drinks, then return an error 

    }


    if ($flag==0){ 
        $_SESSION['basket'][$max]['product_id'] = $product_id;
        $_SESSION['basket'][$max]['quantity'] = $quantity;
    }   
    
    elseif ($flag==1){

        $old_quantity = $_SESSION['basket'][$x]['quantity'];
        $new_quantity = $old_quantity + 1;
        $_SESSION['basket'][$x]['quantity'] = $new_quantity;
    }
    //gets the current value in the basket, adds one and replaces it in the session.

header('Location: '. $_POST['returnto']);
	
?>
