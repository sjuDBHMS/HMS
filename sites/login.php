<?php
session_start();
$error=''; // Variable To Store Error Message
if (isset($_POST['btn-login'])) {
if (empty($_POST['ID']) || empty($_POST['pass'])) {
	$error = "Fill out the fields";
	header("location: index.php"); // Redirecting To Home Page
}
else
{
include_once 'dbconnect.php';

	$ID = mysql_real_escape_string($_POST['ID']);
	$upass = mysql_real_escape_string($_POST['pass']);

	$ID = trim($ID);
	$upass = trim($upass);

	$res=mysql_query("select * from LoginDetails where Password='$upass' AND LoginID='$ID'");
	$rows = mysql_num_rows($res);
	$row=mysql_fetch_array($res);
	if ($rows == 1) {
		$Type=$row['Type'];
		$_SESSION['login_user']=$ID;
		$_SESSION['type']=$Type;
		if($Type == "doctor"){
			header("Location: doctor/doctor.php");
		}else if($Type == "patient"){
			header("Location: patient/patient.php");
		}else{
			header("location: receptionist/receptionist.php"); // Redirecting To Home Page	
		}
	}else{
		$error = "Username or Password is invalid";
		include('index.php'); // Redirecting To Home Page
	}
}
}else {
//Redirecting if the the link is manually typed
	header("Location: index.php");
}

?>