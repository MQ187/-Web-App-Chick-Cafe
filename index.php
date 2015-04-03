<!DOCTYPE html>
<html>
	<head>
		<title>Main | Chick Cafe</title>
		<link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
	</head>
	<body>
        <?php 
        require_once("basketNotification.php");
        require_once("messages.php");
        ?>
	<header>
		<a href="index.php"><img align="middle" src="images/Logo.png"/></a>

		 <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="br_menu.php">Breakfast</a></li>
                <li><a href="lu_menu.php">Lunch</a></li>
                <li><a href="di_menu.php">Dinner</a></li>
                <li><a href="dr_menu.php">Drinks</a></li>

                <?php
                session_start();
                if (!isset($_SESSION['logedIn'])) { $_SESSION['logedIn'] = false;}
				if (!isset($_SESSION['userType'])) {$_SESSION['userType'] = "NONE";}
				$userType = $_SESSION['userType'];
                if ($_SESSION['logedIn'] == false){
                	?> 
                	<li><a href="login.php">Login/Register</a></li> 
                	<?php
                }
                else{

                	Switch($userType){
                		case 'customer':
                		?> 
                		<li><a href="customerDash.php">Dashboard</a></li>
                		<?php
                		break;
                		case 'employee':
                		?>
                		<li><a href="employeeDash.php">Dashboard</a></li>
                		<?php
                		break;
                		case 'manager':
                		?>
                		<li><a href="managerDash.php">Dashboard</a></li>
                		<?php
                		break;
                	}
                	?>
                	<li><a href="logoff.php">Logout</a></li>
                	<?php
                }
                ?>

                
            </ul>
        </div>

    </header>

		<a href="#"><img align="middle" width="100%" heigth="350px" src="images/large_main.jpg"/></a>

	
	<footer>
		<strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
	</footer>
	</body>
</html>