<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location: ../login/index.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $_SESSION['PatientFName']; ?></title>
<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />

<div id="resHeader">
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="myappointments.php">My Appointments</a></li>
  <li><a href="bills.php">View My Bills</a></li>
  <li><a href="myprofile.php">View My profile</a></li>
  <li><a href="update_profile.php">Update My profile</a></li>
  <li style="float:right"><a class="active" href="../login/logout.php?logout">Sign Out</a></li>
  <li style="float:right"><a>Welcome <b><?php echo $_SESSION['PatientFName']; ?></b></li>
<!--   <li style="float:right"><a class="active" href="#about">About</a></li> -->
</ul>
</div>

</head>