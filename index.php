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
        //include("notification_pop.php");
        ?>
	<header>
		<a href="index.php"><img align="middle" src="images/Logo.png"/></a>

		 <?php
            require_once('nav/menus.php');
            session_start();
            //var_dump($_SESSION);
         ?>

    </header>

		<a href="index.php"><img align="middle" width="100%" heigth="350px" src="images/large_main.jpg"/></a>
	</body>
	<footer>
</footer>
</html>