<?php
#include_once '../dbconnect.php';
require 'database.php';
include_once 'patientHeader.php';

?>

<body>

<?php
$ID=$_SESSION['user'];
$query="SELECT * 
FROM appointment a, seenby s, employee e, department d, bill b
WHERE a.ApptID=s.ApptID And s.EmpId=e.EmpID and e.DeptID=d.DeptId and a.ApptID=b.ApptID and patientID=$ID";
$appointments= $db->query($query);

 ?>
<br/> <br/>
<h1 align="center">My Bills</h1><br/>
<div align="center">
<table>
<tr>
<th>ID</th>
<th>Appointment Date</th>
<th> Time</th>
<th>Doctor</th>
<th>Department</th>
<th>Bill ID</th>
<th>Pending Amount</th>
<th>Total Amount</th>
<th>Paid</th>


<?php foreach ($appointments as $appointment) : ?>
</tr>
<td align="center"><?php echo $appointment['ApptID']; ?></td>
<td align="center"><?php echo $appointment['ApptDate']; ?></td>
<td align="center"><?php echo $appointment['ApptTime']; ?></td>

<td align="center"><?php echo $appointment['EmpFName']; ?>&nbsp;<?php echo $appointment['EmpLName']; ?></td>
<td align="center"><?php echo $appointment['DeptName']; ?></td>

<td align="center"><?php echo $appointment['BillId']; ?></td>
<td align="center"><?php echo $appointment['PendingAmount']; ?></td>
<td align="center"><?php echo $appointment['TotalAmount']; ?></td>
<td align="center"><?php echo $appointment['Paid']; ?></td>


<?php endforeach; ?>
</table>
</div>
</body>
</html>
