<?php
session_start();
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.
require_once("messages.php");
//adds the check for all warnings.
$dir = 'DBbackup/';
$files = scandir($dir);
$max = count($files);
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
                <td><table id="tfhover" class="tftable" border="1" width="100%"><tr><th>Name</th><th>Date</th><th>Restore</th></tr>
                    <?php
                    
                        $i = 2;
                        while ($i<$max){
                            $file = strval($files[$i]);
                            $date = explode("-", $files[$i]);
                            echo '<tr><td>';
                            echo $file;
                            echo '</td><td>';
                            echo date('d.m.Y h:i:s', $date[2]);
                            echo '</td><td>';
                            echo "<form action='db_restore.php' method=POST>
                                <input type='hidden' name='filename' value=" . $file . "/>
                                <input type='submit' name='submit' value='Restore now'/></form>";
                            echo '</td></tr>';
                            $i++;
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