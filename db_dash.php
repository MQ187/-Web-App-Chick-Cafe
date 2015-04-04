<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all possible errors as well as the warnings.
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Main | Chick Cafe</title>
        <link type="text/css" href="styles.css" rel="stylesheet" media="screen" />
    </head>

    <body>
    <header>
         <a href="index.php"><img align="middle" id="logo" src="images/Logo.png"/></a>
         <?php
         require_once("nav/managerDash.php");
         ?>

    </header>
    <body>
    	<nav>
        <ul><li><i>Database Management</i>
        <table id="tfhover" class="tftable" border="1" width="100%">
            <tr>
                <td>
                Database Backup : <form action='db_backup.php' method=POST><input type='submit' name='submit'/></form></div>
                </td>
            </tr>
        </table>
    </body>
</html>