<?php

	$_SESSION['access'] = array("owner","manager");
	include('security.php');

	if(isset($_POST['customerID'])){
		session_start();
		//Initialises the session.

		include("db_config.php");
		// Connect to the Database and Select the tts database.
		$encrypt_accNumber = sha1(md5($_POST['accountNumber']));
		//insert posted fields from below into the refund table
		$question="INSERT INTO refund(idCustomer,idManager,idOrder,accountNumber,date,ammount,details) VALUES(:idCustomer,
				:idManager, :idOrder, :accountNumber, :date, :ammount, :details)";
		
		$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$sth->execute(array(':idCustomer' => $_POST['customerID'], ':idManager' => $_SESSION['id'], ':idOrder' => $_POST['orderID'], 
			':accountNumber' => $encrypt_accNumber, ':date' => date('Y-m-d H:i:s'), ':ammount' => $_POST['amount'], ':details' => $_POST['details']));

		$question2="UPDATE `order` SET orderStatus='Refunded' WHERE idorder='$_POST[orderID]'";
		$sth1 = $db->prepare($question2);
		$sth1->execute();

		//header('Location: managerDash.php');
	}
?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
	    <title>Refund | Chick Cafe</title>
	    <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
	    <link rel="icon" type="image/x-ico" href="favicon.ico" />
	    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  	</head>
	<body>
		<header>
	        <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
	        <br>

	        <?php
                require_once("nav/managerDash.php");
        	?>
    	</header>
		<div class="flat-form" style="align:center; margin-left:350px; margin-top:25px;">
	      <div class="title"><a>Refund</a></div>
	        <div class="form-action">
	            <form action="refund.php" method="POST">
	                <ul><!--refund form values used to record refund-->
	                    <li><input type="text" name="customerID" placeholder="Customer ID" class="text" required="required"/></li>
	                    <li><input type="text" name="orderID" placeholder="Order ID" class="text" required="required"/></li>
	                    <li><input type="text" name="accountNumber" placeholder="Account Number" class="text" required="required"/></li>
	                    <li><input type="text" name="amount" placeholder="Amount" required="required" class="text" /></li>
	                    <li><input type="text" name="details" placeholder="Details" required="required" class="text" /></li>
	                    <li><input type="submit" value="Submit" class="button"/></li>
	                </ul>
	            </form>
	        </div>
	    </div>
	</body>
</html>

