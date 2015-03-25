<?php 
	session_start(); 
	//Initialises the session.
	require_once("db_config.php");
	// Connect to the Database and Select the ccdb database.

	$idPayment = $_POST['idPayment'];
	$bankAccount = $_POST['bankAccount'];
	$sortCode = $_POST['sortCode'];
	$name = $_POST['name'];

	$question="INSERT INTO bank(idPayment,bankAccount,bankSortCode,bankAccountName) VALUES(:id,
			:payment, :sortCode, :name)";
	
	$add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

	$add->execute(array( ':id' => $idPayment ':bankAccount' => $bankAccount, ':sortCode' => $sortCode,':name, => $name'));

	//creates a new bank payment using the information sent over from the previous page.

	header("Location:paymentConfirm.php");
?>