<?php
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.

$time = $POST_['time'];
$table_name = "employee";
$backup_file  = "C:/SERVER-Xampp/htdocs/DBbackup/db-backup-" . $time . ".sql";
$sql = "LOAD DATA INFILE '$backup_file' INTO TABLE INFORMATION_SCHEMA.COLUMNS";

mysql_select_db('test_db');
$retval = mysql_query( $sql, $db);
if(! $retval )
{
  die('Could not load data : ' . mysql_error());
}
echo "Loaded  data successfully\n";

/*
 
$templine = '';
$lines = file($filename);
foreach ($lines as $line)
{
    
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;
    // Skip it if it's a comment
 
    $templine .= $line;
    if (substr(trim($line), -1, 1) == ';')
    {
        mysql_query($templine);
        $templine = '';
    }
    // If it has a semicolon at the end, it's the end of the query
}
*/
 
?>