<?php
	session_start();
	//Initialises the session.

	include("db_config.php");
	// Connect to the Database and Select the tts database.

	if ($_POST['password']!=$_POST['password2']){
			$_SESSION['message'] = "3"; //passwords don't match.
			header("Location:myAccount.php");
			die();
	}

	$userType = $_SESSION['userType'];
	$id = $_SESSION['id'];
	$returnto = $_POST['returnto'];

	Switch($userType){ //partially functional (updates all fields) 
		case 'customer':
			$name = $_POST['name'];
			$surname = $_POST['surname'];
			$email = $_POST['email'];
			$password = sha1(md5($_POST['password']));

			$question="SELECT count(*) AS ct FROM customer WHERE email= :email";

			$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':email' => $email));
			$count = $sth->fetchAll();


			if($count[0]['ct'] == 1){
				$_SESSION['message'] = "4";  //email already exists.
				header("Location:" . $returnto);
				//checks if the user already exists in the database.
			}else{

				$question="UPDATE `customer` SET name='$name', surname='$surname', email='$email', password='$password' WHERE idcustomer='$id'";
				$sth = $db->prepare($question);
			    $sth->execute();
			}
			break;
			

		case 'manager':
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = sha1(md5($_POST['password']));

			$question="SELECT count(*) AS ct FROM manager WHERE email= :email";

			$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':email' => $email));
			$count = $sth->fetchAll();


			if($count[0]['ct'] == 1){
				$_SESSION['message'] = "4";  //email already exists.
				header("Location:" . $returnto);
				//checks if the user already exists in the database.
			}else{

				$question="UPDATE `manager` SET name='$name', email='$email', password='$password' WHERE idmanager='$id'";
			    $sth = $db->prepare($question);
			    $sth->execute();
			}
			break;


		case 'employee':
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = sha1(md5($_POST['password']));

			$question="SELECT count(*) AS ct FROM employee WHERE email= :email";

			$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute(array(':email' => $email));
			$count = $sth->fetchAll();


			if($count[0]['ct'] == 1){
				$_SESSION['message'] = "4";  //email already exists.
				header("Location:" . $returnto);
				//checks if the user already exists in the database.
			}else{

				$question="UPDATE `employee` SET name='$name', email='$email', password='$password' WHERE idemployee='$id'";
			    $sth = $db->prepare($question);
			    $sth->execute();
			break;
	}

	header("Location: " . $returnto);

?>