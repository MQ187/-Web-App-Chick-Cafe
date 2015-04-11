<?php
session_start();
if (isset($_SESSION['basket'])) {
	$_SESSION['basket'] = array();
}//empties the basket if it is already filled
?>
