<?php 
	if (!isset($_SESSION['ignored'])){
        $_SESSION['ignored'] = array();
    }
    $max = count($_SESSION['ignored']);

    $j = $_POST['j'];
    for ($i=0; $i < $j; $i++) { 
    	
    	$k = $i + $max;
    	$_SESSION['ignore'][$k]['id'] = $_POST[$i];

    }


//adds all the id's passed from the manager dash menu to the session['ignored']
?>

<script type="text/javascript">
window.close();
</script>