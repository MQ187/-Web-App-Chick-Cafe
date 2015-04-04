<?php
	session_start();
	//Initialises the session.

	include("db_config.php");
	// Connect to the Database and Select the tts database.

	if(isset($_POST['prepare'])){
		$_SESSION['startTime'] = new DateTime();
		$question2="UPDATE `order` SET orderStatus='Preparing', idEmployee='$_SESSION[id]' WHERE idorder='$_POST[prepare]'";
		$sth = $db->prepare($question2);
		$sth->execute();
	}

	if(isset($_POST['ready'])){
		$endTime = time();

        $question2="UPDATE `order` SET orderStatus='Completed', timeCompleted='$end' WHERE idorder='$_POST[ready]'";
        $sth = $db->prepare($question2);
        $sth->execute();
    }

	header('Location: employeeDash.php');

?>