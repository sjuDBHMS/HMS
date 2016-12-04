<?php
session_start();
include_once '../dbconnect.php';
$EmpID = $_SESSION['doctor'];
$message="";
if (isset($_REQUEST['reopen'])) {
	$EmpID=$_SESSION['doctor'];
	$ApptID=  $_REQUEST['ApptID'];
	$query="UPDATE Appointment SET ApptStatus='$EmpID' WHERE ApptID='$ApptID'";
	mysql_query($query);
	unset($_REQUEST['reopen']);
	//header("Location: view.php");
}
if (isset($_REQUEST['updateAppointment'])) {
    updateAppointment();
    unset($_REQUEST['updateAppointment']);
	//header("Location: view.php");
}
function updateAppointment()
{
	$Comments= $_REQUEST['Comments'];
	$Prescription= $_REQUEST['Prescription'];
	$ApptID=  $_REQUEST['ApptID'];
	$query="UPDATE Appointment SET Comments='$Comments' ,Prescription='$Prescription' WHERE ApptID='$ApptID'";
	mysql_query($query);

}
?>
<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css" />
<title>Welcome - <?php echo $_SESSION['EmpFName']; ?></title>
<div id="resHeader">
<ul>
	<li><a href="doctor.php">Home</a></li>
	<li class="dpdwn"><a style="background:#333;" href="view.php">Appointments</a>
			<ul>
				<li><a href="searchAppt.php">Search Appointments</a></li>
				<li><a href="view.php">View Appointments</a></li>
			</ul>
	</li>
	<li style="float:right"><a class="active" href="../login/logout.php?logout">Sign Out</a></li>
	<li style="float:right"><a href="editProfile.php">Edit Profile</a></li>
	<li style="float:right"><a href="doctor.php">Welcome <?php echo $_SESSION['EmpFName']; ?></a></li>
</div>

<?php 
if($message!="")
echo '<center><h2 style="color: green;font-family:verdana;margin-bottom:-29px;">'.$message.'</h2></center>';
?>
<div class="listHeadign" style="margin-top:50px; width:90%" ><h2  style="color:#f2f2f2;">&nbsp;Previous Appointments</h2></div>
<div class="wrapper" id="ApptView" style=" width:90%">
<?php 
$doctorID=$_SESSION['doctor'];
$apptQuery="SELECT a.* 
			FROM appointment a  INNER JOIN seenby s
			ON a.ApptID=s.ApptID
			Where a.ApptStatus='closed' And s.EmpId='$EmpID'
			ORDER BY a.ApptDate DESC";
$apptResult = mysql_query($apptQuery);
//echo mysql_num_rows($result)
if(mysql_num_rows($apptResult)>0)
{
?>
<table id="t01">
	<tr>
  		<th>Appt ID</th>
	    <th>PatientID</th>
	    <th>First Name</th>
    	<th>Last Name</th>
    	<th>Age</th>
	    <th>Date</th>
	    <th>Prescription</th>
	    <th>Comment</th>
	    <th>Update</th>
	    <th>Reopen</th>
    </tr> 
	<?php
		while ($row = mysql_fetch_array($apptResult)) {
			$PatientID = $row['PatientID'];
			$patientQuer="SELECT * FROM Patient WHERE PatientID='$PatientID' ";
			$patientResult = mysql_query($patientQuer);
			$patientDetails = mysql_fetch_array($patientResult);
			$dob = new DateTime($patientDetails['DOB']);
			$currentDate   = new DateTime('today');
			$age= $dob->diff($currentDate)->y;

			echo '<tr>';
        	echo '<td>' . $row['ApptID'] . '</td>';
        	echo '<td>' . $PatientID . '</td>';
        	echo '<td>' . $patientDetails['PatientFName'] . '</td>';
        	echo '<td>' . $patientDetails['PatientLName'] . '</td>';
        	echo '<td>' . $age . '</td>';
        	echo '<td>' . $row['ApptDate'] . '</td>';
        	?>
        	<td>
        		<form method="post" action="view.php">
	        		<textarea rows="4" cols="25" name="Prescription"><?php echo $row['Prescription']; ?></textarea>
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		
			</td>
        	<td>
	        		<textarea rows="4" cols="25" name="Comments"><?php echo $row['Comments']; ?></textarea>
        	</td>
        	<td>
        		<input type="submit" value= "Update" name="updateAppointment" />
				</form>
        	</td>
        	<td>
        	<form method="post" action="view.php">
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		<input type="hidden" name="date" value= "<?php echo $date; ?>" >
	        		<input type="hidden" name="month" value= "<?php echo $month; ?>" >
	        		<input type="hidden" name="year" value= "<?php echo $year; ?>" >
	        		<input type="submit" value= "ReOpen" name="reopen" onclick="return confirm('Are you sure want to reopen Appointmen: <?php echo $row['ApptID']?> ?')" />
				</form>
        	</td>
        	<?php
			echo '</tr>';
		}
	?>
</table>
<?php 
}else
echo '<h2 style="color:#a51313;font-family: courier;text-align:center;margin-top:50px">No Patient Selected<h2>';
?>
</div>

</head>

<body bgcolor="#f2f2f2">

</body>
</html>