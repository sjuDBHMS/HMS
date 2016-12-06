<?php
#include_once '../dbconnect.php';
require 'database.php';
include_once 'patientHeader.php';

?>

<body>

<?php
$ID=$_SESSION['user'];
$query="SELECT * 
FROM Appointment a, SeenBy s, Employee e, Department d
WHERE a.ApptID=s.ApptID And s.EmpId=e.EmpID and e.DeptID=d.DeptId and PatientID=$ID";
$appointments= $db->query($query);

 ?>
<br/> 

<br/>
<h1 align="center">My Appointments</h1><br/>
<div align="center">
<table>
<tr>
<th>Appointment ID</th>
<th>Appointment Date</th>
<th> Time</th>
<th>Status</th>
<th>Doctor</th>
<th>Department</th>
<th>Comments</th>
<th>Prescription</th>
<th>CANCEL</th>

<?php foreach ($appointments as $appointment) : ?>
</tr>
<td align="center"><?php echo $appointment['ApptID']; ?></td>
<td align="center"><?php echo $appointment['ApptDate']; ?></td>
<td align="center"><?php echo $appointment['ApptTime']; ?></td>
<td align="center"><?php echo $appointment['ApptStatus']; ?></td>
<td align="center"><?php echo $appointment['EmpFName']; ?>&nbsp;<?php echo $appointment['EmpLName']; ?></td>
<td align="center"><?php echo $appointment['DeptName']; ?></td>
<td align="center"><?php echo $appointment['Comments']; ?></td>
<td align="center"><?php echo $appointment['Prescription']; ?></td>
<td align="center"><form action="cancel_appointment.php" method="post" id="cancel_appointment_form">
<input type="hidden" name="appointment_id" value="<?php echo $appointment['ApptID']; ?>"/>
<input type="submit" value="Cancel" /></form>
</td>

<?php endforeach; ?>
</table>
</div>
</body>
</html>
