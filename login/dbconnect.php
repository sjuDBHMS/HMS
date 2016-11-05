<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","",""))
{
	die('oops connection problem ! --> '.mysql_error());
}
//if(!mysql_select_db("malamodi_dbtest"))
if(!mysql_select_db(""))
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>