<?php
#include_once '../dbconnect.php';
require 'database.php';
include_once 'patientHeader.php';

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css" />

</head>

<body>
<p>Patient ID: <?php echo $_SESSION['user']; ?></p>
<p>First Name:<?php echo $_SESSION['PatientFName']; ?></p>
<?php
$ID=$_SESSION['user'];
#$query="SELECT * FROM patientWHERE patientID=$ID";
$query="SELECT * 
FROM patient, patient_phone
where patient.PatientID=patient_phone.PatientID AND patient.patientID=$ID";
$result= $db->query($query);

 ?>
<br/><br/>
<p align="center"><a href="home.php">My Home</a>  |  <a href="myappointments.php">My Appointment</a>  |  <a href="bills.php">View My Bills</a>  |  <a href="myprofile.php">View My profile</a>   |   <a href="update_profile.php">Update My profile</a>  |  
</p>  

<br/>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<body>
<center>
<div id="login-form">
<form action="updateDB.php" method="post" enctype="multipart/form-data">
<table align="center" width="30%" border="0">
<?php foreach ($result as $patient) : ?>

<tr>
<td colspan="2"><h1 align="center">Updating My Profile</h1>
</td>
</tr>


<tr>

<td><input type="text" name="fName" placeholder="User First Name" value=<?php  echo $patient['PatientFName'];?>  />
  <input type="hidden" name="ID" value=<?php echo $patient['PatientID']?>>

</td>
</tr>
<tr>
<td><input type="text" name="lName" placeholder="User Last Name" value=<?php echo $patient['PatientLName']; ?> /></td>
</tr>
<tr>
<td><input type="date" name="dateOfBearth" placeholder="User Date Of Bearth" value=<?php echo $patient['DOB']; ?> /></td>
</tr>
<tr>
<td><input type="text" name="address" placeholder="User Address" value="<?php echo $patient['PatientAddress']; ?>"  /></td>
</tr>
<tr>
<td><input type="text" name="phone1" placeholder="User Phone Number 1" value=<?php echo $patient['Phone']; ?> /></td>
</tr>




<tr>
<td><button type="submit" name="btn-signup">Update profile</button></td>
</tr>
<?php endforeach; ?>

</table>
</form>
</div>
</center>

</body>
</html>



