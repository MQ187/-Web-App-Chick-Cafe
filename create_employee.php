<?php
	session_start();
	//Initialises the session.

	if ($_SESSION['logedIn'] == false || $_SESSION['userType'] != "Manager") {
		//header("Location: login.php");
	}

	include("db_config.php");
	// Connect to the Database and Select the tts database.

	if ($_POST['password']!=$_POST['password2']){
			$_SESSION['message'] = "3"; //passwords don't match.
			header("Location:new_employee.php");
			die();
		}
	//check that the two passwords given match.


	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	$encrypt_password = sha1(md5($password));
	//encrypt the password

	$question="SELECT count(*) AS ct FROM employee WHERE email= :email";

	$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':email' => $email));
	$count = $sth->fetchAll();


	if($count[0]['ct'] == 1){
		$_SESSION['message'] = "4";  //email already exists.
		header("Location:new_employee.php");
		//checks if the user already exists in the database.
	}else{

		$question="INSERT INTO employee(name,password,email,active) VALUES(:name, :password, :email, :active)";
	
		$add = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$add->execute(array(':name' => $name, ':password' => $encrypt_password, ':email' => $email, ':active' => true));

		header('Location: managerAccount.php');

	}
	
// All code on this page was written by Gaetan Mougel

?>

