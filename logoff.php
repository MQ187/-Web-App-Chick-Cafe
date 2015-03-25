<?php

	session_start();
	// Inialise session

	session_destroy();
	// Delete all session variables and details.

	session_start();

	$_SESSION['logedIn'] = false;
	
	header('Location: index.php');
	// Jump to home page

	//All code on this page was written by Gaetan Mougel

?>