<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// Selecting Database
$db = mysql_select_db("HMS", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
//echo "<script type='text/javascript'>alert('$user_check');</script>";
//$userName=$user_check;
// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysql_query("select * from Patient where PatientID='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session =$row['PatientID'];
	if(!isset($login_session)){
		mysql_close($connection); // Closing Connection
		header('Location: ../index.php'); // Redirecting To Home Page
	}
	$userName =ucfirst($row['PatientFName']."&nbsp;&nbsp;").ucfirst($row['PatientLName']);//ucfirst converts the first letter to captial
?>

