<?php
#include_once '../dbconnect.php';
require 'database.php';
include_once 'patientHeader.php';

?>

<body>

<?php
$ID=$_SESSION['user'];
$query="SELECT * 
FROM Patient , Patient_Phone
WHERE Patient.PatientID=Patient_Phone.PatientID AND Patient.PatientID=$ID";
$result= $db->query($query);

 ?>
<br/><br/>
<h1 align="center">My Profile</h1><br/>
<div align="center">
<table>

<?php $count=1; ?>


<?php foreach ($result as $patient) : ?>

<?php if($count==1) { ?>

<tr>
    <td colspan="2" ><p align="center"><?php echo '<img style="width: 128px; height: 128px;" src="data:image/jpeg;base64,'.base64_encode($patient['Image'] ).'"/>'; ?></p>
	</td>
  </tr>
<tr>
<td>Patient ID: </td>
<td align="center"><?php echo $patient['PatientID']; ?></td>
</tr>
<tr>
<td>First Name: </td>
<td align="center"><?php echo $patient['PatientFName']; ?></td>
</tr>
<tr>
<td>Last Name: </td>
<td align="center"><?php echo $patient['PatientLName']; ?></td>
</tr>

<tr>
<td>Date of Birth: </td>
<td align="center"><?php echo $patient['DOB']; ?></td>
</tr>
<tr>
<td>Address: </td>
<td align="center"><?php echo $patient['PatientAddress']; ?></td>
</tr>
<?php } ?>
<?php if($count>=1) ?>
<td>Phone <?php echo $count?> : </td>
<td align="center"><?php echo $patient['Phone']; ?></td>
</tr>
<?php  $count++; ?>

<?php endforeach; ?>
</table>
</div>
</body>
</html>
