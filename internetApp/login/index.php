<?php
session_start();
include_once '../dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: http://www.malamodi.com/internetApp/patient/logout.php?logout");
}

if(isset($_POST['btn-login']))
{
	$ID = mysql_real_escape_string($_POST['ID']);
	$upass = mysql_real_escape_string($_POST['pass']);

	$ID = trim($ID);
	$upass = trim($upass);
	$res=mysql_query("SELECT ID, Password, Type FROM LoginDetails WHERE ID='$ID'");
	$row=mysql_fetch_array($res);
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row

	if($count == 1 && $row['Password']==md5($upass) && $row['Type'] == "Patient")
	{
		
		$patientID = $row['ID'];
		$ses_sql=mysql_query("select * from Patient where PatientID='$patientID'");
		$row_sql=mysql_fetch_array($ses_sql);
		$count_sql = mysql_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['PatientFName'] = $row_sql['PatientFName'];
		}
	
		$_SESSION['user'] = $patientID;
		header("Location: ../patient/home.php");
	}
	else if($count == 1 && $row['Password']==md5($upass) && $row['Type'] == "Doctor")
	{
		$doctorID = $row['ID'];
		$ses_sql=mysql_query("select * from Employee where EmpID='$doctorID'");
		$row_sql=mysql_fetch_array($ses_sql);
		$count_sql = mysql_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['EmpFName'] = $row_sql['EmpFName'];
		}
		
		$_SESSION['doctor'] = $doctorID;
		header("Location: ../doctor/doctor.php");
	}
	else if($count == 1 && $row['Password']==md5($upass) && $row['Type'] == "recep")
	{
		$receptionistID = $row['ID'];
		$ses_sql=mysql_query("select * from Employee where EmpID='$receptionistID'");
		$row_sql=mysql_fetch_array($ses_sql);
		$count_sql = mysql_num_rows($ses_sql);
		if($count_sql == 1)
		{
			$_SESSION['receptionistFName'] = $row_sql['EmpFName'];
		}
		
		$_SESSION['receptionist'] = $receptionistID;
		header("Location: ../receptionist/receptionist.php");
	} 
	else
	{
		?>
        <script>alert('Username / Password Seems Wrong !');</script>
        <?php
	}

}receptionist
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
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="ID" placeholder="Your ID" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</button></td>
</tr>
<tr>
<td><a href="register.php">Sign Up Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
