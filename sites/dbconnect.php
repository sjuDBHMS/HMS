<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
$connection = mysql_connect("localhost", "root", "");
if(!$connection)
{
	die('oops connection problem ! --> '.mysql_error());
}
//if(!mysql_select_db("malamodi_dbtest"))
$db = mysql_select_db("HMS", $connection);
if(!$db)
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>