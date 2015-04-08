<?php
	session_start();

	if (isset($_SESSION['userType']) && isset($_SESSION['logedIn'])){
		//is a session even set?

		if ($_SESSION['logedIn'] == true){
			//is the user logged in?
			
			$access = $_SESSION['access'];

			if (isset($_SESSION['owner'])){
				if ($_SESSION['owner'] == 1){
					$usertype = "owner";
				}
				else{
					$usertype = $_SESSION['userType'];
				}
			//checks if the manager logged in is an owner. If he is, set the usertype to owner, otherwise to manager.
			}
			else{
				$usertype = $_SESSION['userType'];
			}
			//if he isnt a manager just assign the usertype

			if (is_array($access)){
				foreach ($access as $key) {
					if ($usertype == $key){
					//we're good! :) access granted!
						$authorised = 1;
						break;
					}
				}
				if (!isset($authorised)){
					unset($_SESSION['access']);
					$_SESSION['message'] = "10";
					switch ($usertype) {
						case 'customer':
							header("Location: customerDash.php");
							break;
						case 'employee':
							header("Location: employeeDash.php");
							break;
						case 'manager':
							header("Location: managerDash.php");
							break;
						default:
							header("Location: login.php");
							break;
					}//access denied, redirect to relevant dash!
				}
			}
			else{
				if ($access == $usertype){
					//we're good! :) access granted!
				}
				else{
					unset($_SESSION['access']);
					$_SESSION['message'] = "I'm stupid";
					switch ($usertype) {
						case 'customer':
							header("Location: customerDash.php");
							break;
						case 'employee':
							header("Location: employeeDash.php");
							break;
						case 'manager':
							header("Location: managerDash.php");
							break;
						default:
							header("Location: login.php");
							break;
					}//access denied, redirect to relevant dash!
				}
			}
		}
		else{
			unset($_SESSION['access']);
			$_SESSION['message'] = "10";
			header("Location: login.php");
		}//not logged in, access denied --> login!
	}
	else{
		unset($_SESSION['access']);
		$_SESSION['message'] = "10";
		header("Location: login.php");
	}//session not set, access denied --> login!




/*
To use simply use the following code:

$_SESSION['access'] = $UsertypeNeeded;
include('security.php');

$UsertypeNeeded can be: "owner"
						"manager"
						"employee"
						"customer"
						or array("owner","manager")     - Any Combination

*/
?>