<?php

$mysqlDatabaseName ='ccdb';
$mysqlUserName ='root';
$mysqlPassword ='root';
$mysqlHostName ='localhost';
$time = time();
$mysqlExportPath ='C:\Server-Xampp\htdocs\DBbackup\ccdb-backup-' . $time . '.sql';


$command='mysqldump -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > "' .$mysqlExportPath. '"';
exec($command,$output=array(),$worked);
header("Location: db_dash.php");

//Back's up DB into server's internal memory @location C:\Server-Xampp\htdocs\DBbackup\. 
?>