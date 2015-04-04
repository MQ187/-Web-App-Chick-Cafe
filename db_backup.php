<?php
/* backup the db OR just a table */
//function backup_tables($host,$user,$pass,$name,$tables = '*')
//{
session_start();

require_once("db_config.php");

$tables = array();
$result = mysql_query('SHOW TABLES');
while($row = mysql_fetch_row($result))
{
$tables[] = $row[0];
}
//get the name of each table


foreach($tables as $table)
{
	$result = mysql_query('SELECT * FROM '.$table);
	$num_fields = mysql_num_fields($result);
	
	$return.= 'DROP TABLE '.$table.';';
	$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
	$return.= "\n\n".$row2[1].";\n\n";
	
	for ($i = 0; $i < $num_fields; $i++) 
	{
		while($row = mysql_fetch_row($result))
		{
			$return.= 'INSERT INTO '.$table.' VALUES(';
			for($j=0; $j<$num_fields; $j++) 
			{
				$row[$j] = addslashes($row[$j]);
				$row[$j] = ereg_replace("\n","\\n",$row[$j]);
				if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
				if ($j<($num_fields-1)) { $return.= ','; }
			}
			$return.= ");\n";
		}
	}
	$return.="\n\n\n";
}
//get each table one by one.


$handle = fopen('DBbackup/db-backup-'.time().'-.sql','w+');
fwrite($handle,$return);
fclose($handle);
//save file
?>