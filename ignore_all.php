<?php 
    session_start();
	if (!isset($_SESSION['ignored'])){
        $_SESSION['ignored'] = array();
    }
    $max = count($_SESSION['ignored']);

    $j = $_POST['j'];

    for ($i=0; $i < $j; $i++) { 
    	
    	$k = $i + $max;
    	$_SESSION['ignored'][$k] = $_POST[$i];
        //var_dump($_SESSION);
    }

//adds all the id's passed from the manager dash menu to the session['ignored']
?>

<script type="text/javascript">
window.close();
//closes this new tab.
</script>
