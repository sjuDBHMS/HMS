<?php
session_start();
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("","",""))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("malamodi_csc621new"))
//if(!mysql_select_db("malamodi_csc621"))
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>