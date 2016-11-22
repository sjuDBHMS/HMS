<?php
session_start();
include_once '../dbconnect.php';

if(!isset($_SESSION['receptionist']))
{
	header("Location: ../login/index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $_SESSION['user']; ?></title>
<link rel="stylesheet" href="../style.css" type="text/css" />

<div id="resHeader">
	<div id="left">
	<span ><a style="text-decoration:none; color:white;" href="patientSearch.php">Patient Search - </a></span>
    <span ><a style="text-decoration:none; color:white;" href="editProfile.php">Edit Profile - </a></span>
    <span ><a style="text-decoration:none; color:white;" href="newApp.php">New Appointment - </a></span>
    <span ><a style="text-decoration:none; color:white;" href="appSearch.php">Appointment Search - </a></span>
    </div>
    <div id="right">
    	<div id="content">
        	Welcome <?php echo $_SESSION['receptionistFName']; ?>&nbsp;<a href="../login/logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</head>