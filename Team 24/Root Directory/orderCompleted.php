<?php
require_once("db_config.php");

$id = $_POST['id'];


$q2 = "UPDATE `order` SET orderStatus = 'Collected' WHERE idorder='$id'";
$sth2 = $db->prepare($q2);
$sth2->execute();

header("Location: customerDash.php");


?>