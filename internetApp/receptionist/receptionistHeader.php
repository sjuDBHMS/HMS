<?php
session_start();
include_once '../dbconnect.php';

$userName = $_SESSION['receptionistFName'];

if(!isset($_SESSION['receptionist']))
{
	header("Location: ../login/index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userName; ?></title>
<link rel="stylesheet" href="../style.css" type="text/css" />

<div id="resHeader">
<ul>
  <li><a href="patientSearch.php">Patient Search</a></li>
  <li><a href="editProfile.php">Edit Profile</a></li>
  <li><a href="newApp.php">New Appointment</a></li>
  <li><a href="appSearch.php">Appointment Search</a></li>
  <li style="float:right"><a class="active" href="../login/logout.php?logout">Sign Out</a></li>
  <li style="float:right"><a>Welcome <?php echo $userName; ?></li>
<!--   <li style="float:right"><a class="active" href="#about">About</a></li> -->
</ul>
</div>

</head>