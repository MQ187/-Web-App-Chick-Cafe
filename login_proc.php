<?php 
	session_start(); 
	//Initialises the session.
	require_once("db_config.php");
	// Connect to the Database and Select the ccdb database.


	$email=$_POST['email'];
	$password= $_POST['password'];
	$userType= "Start";
	//fetches the password and email given by the login page via the POST server array.
	

	$encrypt_password = sha1(md5($password));

		$question="SELECT count(*) AS ctC FROM customer WHERE email= :email";

		$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':email' => $email));
		$count = $sth->fetchAll();

		//checks if a user with this email exists in customer.

		$question2="SELECT count(*) AS ctM FROM manager WHERE email= :email";

		$sth2 = $db->prepare($question2, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth2->execute(array(':email' => $email));
		$count2 = $sth2->fetchAll();

		//checks if a user with this email exists in manager.

		$question3="SELECT count(*) AS ctE FROM employee WHERE email= :email";

		$sth3 = $db->prepare($question3, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth3->execute(array(':email' => $email));
		$count3 = $sth3->fetchAll();

		//checks if a user with this email exists in employee.

		if(($count[0]['ctC'] == 0) && ($count2[0]['ctM'] == 0) && ($count3[0]['ctE'] == 0)){
			$_SESSION['message'] = "1";
			header("Location:login.php");
		}
		//if it doesn't exist in any.

		if ($count[0]['ctC'] == 1) {
			$userType = "customer";
		}
		elseif ($count2[0]['ctM'] == 1) {
			$userType = "manager";
		}
		elseif ($count3[0]['ctE'] == 1) {
			$userType = "employee";
		}
		//asign the usertype according to findings.

		Switch($userType){
			case 'customer':
					$question="SELECT count(*) AS ct FROM customer WHERE email= :email AND password= :password";

					$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$sth->execute(array(':email' => $email, ':password' => $encrypt_password));
					$count = $sth->fetchAll();
	
					//checks if a user exists with both the email and password correct in customer.

					if($count[0]['ct'] == 0){
						$_SESSION['message'] = "2";
						header("Location:login.php");	
					}
					elseif($count[0]['ct'] == 1){
						$question="SELECT idCustomer FROM customer WHERE email = :email";
  
	   					$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	   					$sth->bindParam(':email', $email, PDO::PARAM_STR);
	   					$sth->execute();

	    				$fetch = $sth->fetch(PDO::FETCH_ASSOC);
	    				$_SESSION['id'] = $fetch['idCustomer'];
	    				$_SESSION['userType'] = $userType;
	    				$_SESSION['message'] = "0";
	    				$_SESSION['logedIn'] = true;
	    				header('Location: customerDash.php');
					}
				break;
			case 'manager':
					$question="SELECT count(*) AS ct FROM manager WHERE email= :email AND password= :password AND active = :true";

					$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$sth->execute(array(':email' => $email, ':password' => $encrypt_password, ':true' => true));
					$count = $sth->fetchAll();
	
					//checks if a user exists with both the email and password are correct in manager which is also active..

					if($count[0]['ct'] == 0){
						$_SESSION['message'] = "2";
						header("Location:login.php");	
					}
					elseif($count[0]['ct'] == 1){
						$question="SELECT idmanager,owner FROM manager WHERE email = :email";
  
	   					$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	   					$sth->bindParam(':email', $email, PDO::PARAM_STR);
	   					$sth->execute();

	    				$fetch = $sth->fetch(PDO::FETCH_ASSOC);
	    				$_SESSION['id'] = $fetch['idmanager'];
	    				$_SESSION['userType'] = $userType;
	    				$_SESSION['owner'] = $fetch['owner'];
	    				$_SESSION['message'] = "0";
	    				$_SESSION['logedIn'] = true;
	    				header('Location: managerDash.php');
	    			}
				break;
			case 'employee':
					$question="SELECT count(*) AS ct FROM employee WHERE email= :email AND password= :password AND active = :true";

					$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$sth->execute(array(':email' => $email, ':password' => $encrypt_password, ':true' => true));
					$count = $sth->fetchAll();
	
					//checks if a user exists with both the email and password are correct in employee which is also active..

					if($count[0]['ct'] == 0){
						$_SESSION['message'] = "2";
						header("Location:login.php");	
					}
					elseif($count[0]['ct'] == 1){
						$question="SELECT idemployee FROM employee WHERE email = :email";
  
	   					$sth = $db->prepare($question, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	   					$sth->bindParam(':email', $email, PDO::PARAM_STR);
	   					$sth->execute();

	    				$fetch = $sth->fetch(PDO::FETCH_ASSOC);
	    				$_SESSION['id'] = $fetch['idemployee'];
	    				$_SESSION['userType'] = $userType;
	    				$_SESSION['message'] = "0";
	    				$_SESSION['logedIn'] = true;
	    				header('Location: employeeDash.php');
	    			}
				break;
		}
?>
<!-- All code on this page was written by Gaetan Mougel-->

