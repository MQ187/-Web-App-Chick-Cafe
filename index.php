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
         ?>

    </header>

		<a href="#"><img align="middle" width="100%" heigth="350px" src="images/large_main.jpg"/></a>

	
	<footer>
		<strong>Chick Cafe</strong> is a very <strong>popular</strong> cafeteria in the center of <strong>Islington, London</strong> that offers made to order <strong>food</strong> and <strong>drinks.</strong>
	</footer>
	</body>
</html>