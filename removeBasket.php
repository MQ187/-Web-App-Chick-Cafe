<?session_start(); 

$product_id = $_POST['product_id'];
$max=count($_SESSION['basket']);

$flag=0;
for($i=0;$i<$max;$i++){
    if($product_id==$_SESSION['basket'][$i]['product_id']){
        $flag=1;
        break;
    }
}

if ($flag = 0){
	$_SESSION['message'] = "7"; //Product not in basket.
	header('Location: '. $_POST['returnto']);
	die();
}

if ($_SESSION['basket'][$i]['quantity'] > 1){
	$old_quantity = $_SESSION['basket'][$i]['quantity'];
    $new_quantity = $old_quantity - 1;
    $_SESSION['basket'][$i]['quantity'] = $new_quantity;
}
else {
	unset($_SESSION['basket'][$i]);
    break;
}

$_SESSION['basket']=array_values($_SESSION['basket']);

header('Location: '. $_POST['returnto']);
?>