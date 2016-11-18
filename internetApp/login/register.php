<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: ../patient/home.php");
}
include_once '../dbconnect.php';

if(isset($_POST['btn-signup']))
{

	$fName = mysql_real_escape_string($_POST['fName']);
	$lName = mysql_real_escape_string($_POST['lName']);
	$dateOfBearth = mysql_real_escape_string($_POST['dateOfBearth']);
	$address = mysql_real_escape_string($_POST['address']);
	$phone1 = mysql_real_escape_string($_POST['phone1']);
	$phone2 = mysql_real_escape_string($_POST['phone2']);
	$pass = md5(mysql_real_escape_string($_POST['pass']));
	
	$tmpName = $_FILES['image']['tmp_name'];
	// Read the file
	$fp = fopen($tmpName, 'r');
	$data = fread($fp, filesize($tmpName));
	$data = addslashes($data);
	fclose($fp);

	
	$fName = trim($fName);
	$lName = trim($lName);
	$dateOfBearth = trim($dateOfBearth);
	$address = trim($address);
	$phone1 = trim($phone1);
	$phone2 = trim($phone2);
	//$image = trim($image);
	$pass = trim($pass);

		// Insert new patient
		if(mysql_query("INSERT INTO Patient(PatientFName, PatientLName, DOB, PatientAddress, Image) VALUES('$fName','$lName','$dateOfBearth','$address', '$data')"))

		{
			?>
<!-- 			<script>alert('successfully registered you as <?php echo($PID) ?> ');</script> -->
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php  echo mysql_error();
		}
		
		$res=mysql_query("SELECT max(PatientID) as max_id FROM Patient");
		$row=mysql_fetch_array($res);
		$PID = $row['max_id'];
		
		//Insert new employee login detail
		if(mysql_query("INSERT INTO LoginDetails(ID, Password, Type) VALUES('$PID','$pass','Patient')"))
		{
			?>
<!-- 			<script>alert('successfully registered to login details ');</script> -->
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php  echo mysql_error();
		}
		
		//Insert new phone number/s
		if(mysql_query("INSERT INTO Patient_Phone(PatientID, Phone) VALUES('$PID','$phone1')"))
		{
			?>
			<script>alert('Your ID is <?php echo($PID) ?>');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php  echo mysql_error();
		}
		
		if($phone2 != null)
		{
		if(mysql_query("INSERT INTO Patient_Phone(PatientID, Phone) VALUES('$PID','$phone2')"))
		{
			?>
<!-- 			<script>alert('successfully added new phone ');</script> -->
			<?php
		}
		else
		{
			?>
			<script>alert('error while registering you...');</script>
			<?php  echo mysql_error();
		}
		}

header("Location: home.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post" enctype="multipart/form-data">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="fName" placeholder="User First Name" required /></td>
</tr>
<tr>
<td><input type="text" name="lName" placeholder="User Last Name" required /></td>
</tr>
<tr>
<td><input type="date" name="dateOfBearth" placeholder="User Date Of Bearth" required /></td>
</tr>
<tr>
<td><input type="text" name="address" placeholder="User Address" required /></td>
</tr>
<tr>
<td><input type="text" name="phone1" placeholder="User Phone Number 1" required /></td>
</tr>
<tr>
<td><input type="text" name="phone2" placeholder="User Phone Number 2" /></td>
</tr>
<tr>
<td><input type="file" name="image" placeholder="User Image" required /></td>
</tr>

<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="index.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>

</body>
</html>
