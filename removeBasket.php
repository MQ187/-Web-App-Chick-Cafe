<?php

session_start(); 

$product_id = $_POST['product_id'];
$max=count($_SESSION['basket']);
$id = array();
$q = array();
$gone = -1;


if (isset($_POST['quantity'])){
    $qm = $_POST['quantity'];
}
else {
    $qm = 1;
}
//this allows for the removal of more than one item (mainly used if a customer tries to order something where the stock is insuficient.)

$flag=0;
for($i=0;$i<$max;$i++){
    
    $id[$i] = $_SESSION['basket'][$i]['product_id'];
    $q[$i] = $_SESSION['basket'][$i]['quantity'];
    
    if($product_id == $_SESSION['basket'][$i]['product_id']){
        $flag=1;
        $x = $i;
    }
}
//checks that the product exists in the basket (must return one!)

if ($flag == 0){
	$_SESSION['message'] = "7"; //Product not in basket.
	header('Location: '. $_POST['returnto']);
	die();
}
//return an error if the product doesnt exist in the basket
else{

    $_SESSION['basket'] = array();

    if ($q[$x] > 1){
        $q[$x] = $q[$x] - $qm;
    }
    //if multiple, remove one
    else {
        $gone = $x;
    }
    //if the only one, save it as gone.

    if ($gone > -1 && $max == 1){
        unset($_SESSION['menu'];
    }
    else{
        $absent = 0;
        for($y=0;$y<$max;$y++){
            if ($gone == $y){
                $absent++;
            }
            else{
                $j = $y - $absent;
                $_SESSION['basket'][$j]['product_id'] = $id[$y];
                $_SESSION['basket'][$j]['quantity'] = $q[$y];
            }//re-insert all items in the SESSION unless they are gone.
        }
    }
}

header('Location: '. $_POST['returnto']);

?>
