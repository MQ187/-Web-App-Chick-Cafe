<?php
require_once("db_config.php");
// Connect to the Database and Select the ccdb database.

$filename = $POST_['filename'];
 
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
 
?>