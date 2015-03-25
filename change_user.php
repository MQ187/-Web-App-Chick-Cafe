<?php
session_start(); 
include("db_config.php");

if ($_POST['password']!=$_POST['password2']){
			$_SESSION['message'] = "3"; //passwords don't match.
			header("Location:register.php");
			die();
}

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
		header("Location:myAccount.php");
		//checks if the user already exists in the database.
	}else{

	}

?>