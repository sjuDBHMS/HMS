<?php
session_start();
include_once '../dbconnect.php';

$userName = $_SESSION['adminFName'];

if(!isset($_SESSION['admin']))
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
<link rel="stylesheet" href="style.css" type="text/css" />
<style>


li:hover ul {
    display: block;
    position: absolute;
}
li:hover li {
    float: none;
    font-size: 80%;
}
li:hover a { background: #252a33; }
li:hover li a:hover {
    background: #252a33;
}
	.dpdwn ul{
		display: none;
	}
	.dpdwn:hover ul {
		display:block;
	}
</style>
<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />

<div id="resHeader">
<ul>
<li><a href="admin.php">Home</a></li>
<li class="dpdwn"><a href="#">Report</a>
			<ul>
				<li><a href="doctorReport.php">Doctor Report</a></li><br>
				<li><a href="billReport.php">Billing Report</a></li>
			</ul>
</li>
  <li><a href="updateUser.php">Update/delete User</a></li>
  <li style="float:right"><a class="active" href="../login/logout.php?logout">Sign Out</a></li>
  <li style="float:right"><a href="editProfile.php">Edit Profile</a></li>
  <li style="float:right"><a href="admin.php">Welcome <?php echo $userName ?></a></li>
<!--   <li style="float:right"><a class="active" href="#about">About</a></li> -->
</ul>
</div>

</head>