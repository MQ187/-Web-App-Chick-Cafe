<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.

if (!isset($_POST['ingredients'])) {
	$_POST['ingredients'] = array();
}//create the basket if it doesnt exist.

$max=count($_POST['ingredients']); //check how many items are in the basket.

?>