<?php

	session_start();
	// Inialise session

	if($_SESSION['userType'] == 'customer'){
		include("db_config.php");
		$question="UPDATE customer SET isLoggedIn = '0' WHERE idCustomer = '$_SESSION[id]'";  
		$sth = $db->prepare($question);
		$sth->execute();
	}

	session_destroy();
	// Delete all session variables and details.

	session_start();

	$_SESSION['logedIn'] = false;
	
	header('Location: index.php');
	// Jump to home page

	//All code on this page was written by Gaetan Mougel

?>