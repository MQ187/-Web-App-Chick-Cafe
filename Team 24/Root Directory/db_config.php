<?php

global $db;
$user = "root";
		$pass = "root";
        $db = new PDO('mysql:host=localhost;dbname=ccdb', $user, $pass);

	/*try {
		$user = "root";
		$pass = "root";
        $db = new PDO('mysql:host=localhost;dbname=ccdb', $user, $pass);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
    catch(PDOException $e){
        echo $e->getMessage();
        }

    return $db;
*/
    // All code on this page was written by Gaetan Mougel
?>