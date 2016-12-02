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

<?php
$ID=$_SESSION['user'];
#$query="SELECT * FROM patientWHERE patientID=$ID";
$query="SELECT * 
FROM patient, patient_phone, logindetails
where patient.PatientID=patient_phone.PatientID AND patient.PatientID=logindetails.ID AND patient.patientID=$ID";
$result= $db->query($query);

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<body>
<center>
<div id="login-form">
<form action="updateDB.php" method="post" enctype="multipart/form-data">
<table align="center" width="30%" border="0">
<tr>
<td colspan="2"><h1 align="center">Update My Profile</h1>
</td>
</tr>
<?php $count=1 ?>
<?php foreach ($result as $patient) : ?>


<?php if($count==1) {?>

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
<td><input type="password" name="password" placeholder="Password" value="<?php echo $patient['PatientAddress']; ?>"  /></td>
</tr>
<?php } ?>

<?php if($count>=1) {?>

<tr>
<td><input type="text" name="phone<?php echo $count ?>" placeholder="User Phone Number " value=<?php echo $patient['Phone']; ?> />
<input type="hidden" name="oldphone<?php echo $count ?>" placeholder="User Phone Number " value=<?php echo $patient['Phone']; ?> />
</td>
</tr>
<?php } ?>

<?php $count++; ?>


<?php endforeach; ?>
<tr>
<td><button type="submit" name="btn-signup">Update profile</button></td>
</tr>

</table>
</form>
</div>
</center>

</body>
</html>



