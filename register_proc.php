<?php
	session_start();
	//Initialises the session.

	if ($_SESSION['logedIn'] == true) {
		header("Location:myAccount.php");
	}

	include("db_config.php");
	// Connect to the Database and Select the tts database.

	if ($_POST['password']!=$_POST['password2']){
			$_SESSION['message'] = "3"; //passwords don't match.
			header("Location:register.php");
			die();
		}
	//check that the two passwords given match.


	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$encrypt_password = sha1(md5($password));
	//encrypt the password

	$question="SELECT count(*) AS ct FROM customer WHERE email= :email";

	$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':email' => $email));
	$count = $sth->fetchAll();


	if($count[0]['ct'] == 1){
		$_SESSION['message'] = "4";  //email already exists.
		header("Location:login.php");
		//checks if the user already exists in the database.
	}else{

		$question="INSERT INTO customer(name,surname,email,phone,password) VALUES(:name,
			:surname, :email, :phone, :password)";
		$add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$add->execute(array(':name' => $name, ':surname' => $surname, ':email' => $email, 
			':password' => $encrypt_password, ':phone' => $phone));

		$id = intval($db->lastInsertId());
	    
	    $_SESSION['id'] = $id;
	    $_SESSION['email'] = $email;
		$_SESSION['logedIn'] = true;
		$_SESSION['message'] = "0";
		$_SESSION['userType'] = "customer";

		$question="UPDATE customer SET isLoggedIn = '1' WHERE idCustomer = '$_SESSION[id]'";  
		$sth = $db->prepare($question);
		$sth->execute();

		$date =  date( 'Y-m-d' , time());

		$question="INSERT INTO Discounts(vipMembership,discountType,discountValue,startTime) VALUES(:vip,
			:discountT, :discountV, :startTime)";
		$get = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$get->execute(array(':vip' => 0,':discountT' => 0, ':discountV' => 1, ':startTime' => $date));

		$_SESSION['vip'] = 0;
		$_SESSION['vipD'] = 0;

		ini_set('session.cookie_lifetime', 28800);
		header('Location: customerDash.php');

	}
	
// All code on this page was written by Gaetan Mougel

?>

