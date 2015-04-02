<?php

session_start(); 

var_dump($_POST['product_id']);
var_dump($_POST['returnto']);

$product_id = $_POST['product_id'];
$max=count($_SESSION['basket']);

/*
if isset($_POST['quantity']){
    $q = $_POST['quantity'];
}
else {
    $q = 1;
}
//this allows for the removal of more than one item (mainly used if a customer tries to order something where the stock is insuficient.)

$q = 1;
$flag=0;
for($i=0;$i<$max;$i++){
    if($product_id == $_SESSION['basket'][$i]['product_id']){
        $flag=1;
    }
}

if ($flag == 0){
	$_SESSION['message'] = "7"; //Product not in basket.
	header('Location: '. $_POST['returnto']);
	die();
}

if ($_SESSION['basket'][$i]['quantity'] > 1){
	$old_quantity = $_SESSION['basket'][$i]['quantity'];
    $new_quantity = $old_quantity - $q;
    $_SESSION['basket'][$i]['quantity'] = $new_quantity;
}
else {
	unset($_SESSION['basket'][$i]);
}

//$_SESSION['basket']=array_values($_SESSION['basket']);

//header('Location: '. $_POST['returnto']);
*/

?>
