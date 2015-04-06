<?php

$file = $_POST['filename'];

$mysqlDatabaseName ='ccdb';
$mysqlUserName ='root';
$mysqlPassword ='root';
$mysqlHostName ='localhost';
$mysqlExportPath ='C:\Server-Xampp\htdocs\DBbackup\\' . $file;


$command='mysqldump -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < "' .$mysqlExportPath. '"';
exec($command,$output=array(),$worked);
var_dump($worked);

header("Location: db_dash.php");

//Restores DB from chosen file in db_dash.php

?>