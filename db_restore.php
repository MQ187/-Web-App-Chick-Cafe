<?php
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.


$mysqlDatabaseName ='ccdb';
$mysqlUserName ='root';
$mysqlPassword ='root';
$mysqlHostName ='localhost';
$time = $_POST['time'];
$mysqlExportPath ='C:\Server-Xampp\htdocs\DBbackup\ccdb-backup-' . strval($time) . '.sql';


$command='mysqldump -u' .$mysqlUserName .' -p' .$mysqlPassword .' ' .$mysqlDatabaseName .' < "' .$mysqlExportPath. '"';
exec($command,$output=array(),$worked);
var_dump($worked);

//header("Location: db_dash.php");










/*
$time = $POST_['time'];
$backup_file  = "C:/SERVER-Xampp/htdocs/DBbackup/db-backup-" . $time . ".sql";
$sql = "LOAD DATA INFILE :bf INTO TABLE INFORMATION_SCHEMA.COLUMNS";



try {
    $sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    var_dump($sth);
    $sth->execute(array(':bf' => $backup_file));
    var_dump($sth);

} catch (PDOException $e) {
    echo 'Could not connect : ' . $e->getMessage();
}

if(! $sth )
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