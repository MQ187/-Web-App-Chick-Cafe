<?php

$mysqlDatabaseName ='ccdb';
$mysqlUserName ='root';
$mysqlPassword ='root';
$mysqlHostName ='localhost';
$time = time();
$mysqlExportPath ='C:\Server-Xampp\htdocs\DBbackup\ccdb-backup-' . $time . '.sql';


$command='mysqldump -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' > "' .$mysqlExportPath. '"';
exec($command,$output=array(),$worked);
var_dump($worked);
//header("Location: db_dash.php");

?>