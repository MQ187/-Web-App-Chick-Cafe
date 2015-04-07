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

	    				$question="UPDATE customer SET isLoggedIn = '1' WHERE idCustomer = '$_SESSION[id]'";  
	   					$sth = $db->prepare($question);
	   					$sth->execute();

	   					$question="SELECT * FROM customerDiscount WHERE idcustomer = '$_SESSION[id]'";  
	   					$sth = $db->prepare($question);
	   					$sth->execute();
	   					$fetch = $sth->fetchAll();

						foreach ($fetch as $key) {
							$idDiscounts = $key['idDiscounts'];
            				$date =  date( 'Y-m-d' , time());

							$question="SELECT * FROM Discounts WHERE idDiscounts = :id";  
	   						$sth = $db->prepare($question);
	   						$sth->execute(array(':id' => $idDiscounts));
	   						$fetch2 = $sth->fetchAll();

	   						foreach ($fetch2 as $key2) {
	   							if ($key2['startTime'] > $date) {
	   								echo 'too early';
	   								break;
	   							}
	   							if ($key2['endTime'] == null || $key2['endTime'] > $date || $key2['endTime'] == "0000-00-00"){ //date OK?

	   								$_SESSION['vip'] = $key2['vipMembership'];

	   								if ($key2['discountType'] == 0){ // fixed

	   									$_SESSION['vipD'] = $key2['discountValue'];

	   								}
	   								else{ // flex

	   									$_SESSION['vipFlex'] = array();

	   									$question="SELECT * FROM flexDiscounts WHERE idDiscounts = :id";  
	   									$sth = $db->prepare($question);
	   									$sth->execute();
	   									$fetch3 = $sth->fetchAll(array(':id' => $idDiscounts));

	   									$x=0;
	   									foreach ($fetch3 as $key3) {

	   										$_SESSION['vipFlex'][$x]['up'] = $key3['upper'];
	   										$_SESSION['vipFlex'][$x]['lo'] = $key3['lower'];
	   										$_SESSION['vipFlex'][$x]['v'] = $key3['value'];
	   										
	   										$x++;
	   									}
	   								}
	   								break;
	   							}	   
	   							break;							
	   						}
						}
						ini_set('session.cookie_lifetime', 28800);
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

