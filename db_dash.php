<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all warnings.
$_SESSION['access'] = "owner";
include('security.php');
$dir = './DBbackup/';
$files = scandir($dir);
$max2 = count($files);
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
                <h2>Database Backup : </h2><form action='db_backup.php' method=POST><input type='submit' name='submit' value='Backup now'/></form></div>
                </td>
            </tr>
            <tr>
                <td><table id="tfhover" class="tftable" border="1" width="100%"><tr><th>Name</th><th>Date</th><th>Restore</th><th>Delete Backup</th></tr>
                    <?php
                        $l = 2;
                        while ($l < $max2){
                            $file = strval($files[$l]);
                            $date = explode("-", $files[$l]);
                            echo '<tr><td>';
                            echo $file;
                            echo '</td><td>';
                            echo date('d.m.Y h:i:s', $date[2]);
                            echo '</td><td>';
                            echo "<form action='db_restore.php' method=POST>
                                <input type='hidden' name='filename' value=" . $file . " />
                                <input type='submit' name='submit' value='Restore now'/></form>";
                            echo '</td><td><center>';
                            echo "<form action='db_delete.php' method=POST>
                                <input type='hidden' name='filename' value=" . $file . " />
                                <input type='image' name='submit' src='images/delete.png' width=30 />";
                            echo '</center></td></tr>';
                            $l++;
                        }
                        if ($max = 0){
                            echo '<tr><td></td><td></td><td></td></tr>';
                        }
                    ?>
                </td>
            </tr>
        </table>
    </body>
</html>