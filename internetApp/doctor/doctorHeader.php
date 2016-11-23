<?php
session_start();
if(!isset($_SESSION['doctor']))
{
	header("Location: ../login/index.php");
}
if (isset($_GET['selectPatientID'])) {
    selectPatient();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.wrapper{
margin-left: 20px;
margin-top: -22px;
height: 200px;
border: 2px solid black;
width:80%; 
overflow: auto;
	}
 table{
 	width:98%; 

 }
  table, th, td {
	margin: 10px;
    border: 1px solid black;
    border-collapse: collapse;
    padding-left: 10%;
	height:30%; 
	overflow: auto;
	background-color: #f1f1c1;
}
th, td {
    padding: 5px;
    text-align: left;
}
.listHeadign {
margin: 20px;
border: 2px solid black;
width:80%; 
	border: 2px solid black;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<a href="doctor.php">Home</a>
<title>Welcome - <?php echo $_SESSION['EmpFName']; ?></title>
<link rel="stylesheet" href="../style.css" type="text/css" />

<div id="docHeader">
	<div id="left">
    <label>Login</label>
    </div>
    <div id="right">
    	<div id="content">
        	Welcome <?php echo $_SESSION['EmpFName']; ?>&nbsp;<a href="../login/logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</head>

<?php
function selectPatient() {
	$doctorID=$_SESSION['doctor'];
	$patientID=$_GET['selectPatientID'];
	$query="UPDATE Appointment SET ApptStatus=$doctorID WHERE PatientID=$patientID";
	$result = mysql_query($query);
	$ApptID= $_GET['appointmentID'];
	//To check if the data already exist
	$seenByquery="SELECT * from SeenBy where ApptID=$ApptID and EmpId=$doctorID";
	$result = mysql_query($seenByquery);
	if(mysql_num_rows($result)==0)
	{
		$query='INSERT INTO SeenBy(ApptID, EmpId) VALUES ('.$ApptID.','.$doctorID.')';
		$retval=mysql_query($query);
	}
  }

  
?>


<body>

<div class="listHeadign" ><h2>Waiting List</h2></div>
<div class="wrapper">

<?php 
$doctorID=$_SESSION['doctor'];
$apptQuery="SELECT * FROM Appointment where DATE(AppDate) = CURDATE() and (ApptStatus is null)";
$apptResult = mysql_query($apptQuery);
//echo mysql_num_rows($result)
if(mysql_num_rows($apptResult)>0)
{
?>
<table id="t01">
	<tr>
  		<th>Appointment ID</th>
	    <th>PatientID</th>
	    <th>First Name</th>
    	<th>Last Name</th>
    	<th>Age</th>
	    <th>Select</th>
    </tr> 
	<?php
		while ($row = mysql_fetch_array($apptResult)) {
			$patientID = $row['PatientID'];
			$patientQuer="SELECT * FROM Patient WHERE PatientID='$patientID' ";
			$patientResult = mysql_query($patientQuer);
			$patientDetails = mysql_fetch_array($patientResult);
			$dob = new DateTime($patientDetails['DOB']);
			$currentDate   = new DateTime('today');
			$age= $dob->diff($currentDate)->y;

			echo '<tr>';
        	echo '<td>' . $row['ApptID'] . '</td>';
        	echo '<td>' . $patientID . '</td>';
        	echo '<td>' . $patientDetails['PatientFName'] . '</td>';
        	echo '<td>' . $patientDetails['PatientLName'] . '</td>';
        	echo '<td>' . $age . '</td>';
        	echo '<td> <a href=doctor.php?selectPatientID='.$patientID.'&appointmentID='.$row['ApptID'].'>Select</a> </td>';
			echo '</tr>';
		}
	?>
</table>
<?php 
}else
echo "No appointments found"
?>
</div>

<div class="listHeadign" ><h2>Selected Patients</h2></div>
<div class="wrapper">
<?php 
$doctorID=$_SESSION['doctor'];
$apptQuery="SELECT * FROM Appointment where DATE(AppDate) = CURDATE() and ApptStatus = '$doctorID'";
$apptResult = mysql_query($apptQuery);
//echo mysql_num_rows($result)
if(mysql_num_rows($apptResult)>0)
{
?>
<table id="t01">
	<tr>
  		<th>Appointment ID</th>
	    <th>PatientID</th>
	    <th>First Name</th>
    	<th>Last Name</th>
    	<th>Age</th>
	    <th>UpdateStatus</th>
	    <th>Comment</th>
	    <th>Submit</th>
    </tr> 
	<?php
		while ($row = mysql_fetch_array($apptResult)) {
			$patientID = $row['PatientID'];
			$patientQuer="SELECT * FROM Patient WHERE PatientID='$patientID' ";
			$patientResult = mysql_query($patientQuer);
			$patientDetails = mysql_fetch_array($patientResult);
			$dob = new DateTime($patientDetails['DOB']);
			$currentDate   = new DateTime('today');
			$age= $dob->diff($currentDate)->y;

			echo '<tr>';
        	echo '<td>' . $row['ApptID'] . '</td>';
        	echo '<td>' . $patientID . '</td>';
        	echo '<td>' . $patientDetails['PatientFName'] . '</td>';
        	echo '<td>' . $patientDetails['PatientLName'] . '</td>';
        	echo '<td>' . $age . '</td>';
        	?><td>
        	<select name="formGender">
			  	<option value="">Select...</option>
			  	<option value="M">Close</option>
				<option value="F">Reschedule to</option>
			</select>
			</td>
        	<?php
        	echo '<td><input type="text" name="nato_pf" /></td>';
        	echo '<td> <a href=doctor.php?selectPatientID='.$patientID.'>Select</a> </td>';
			echo '</tr>';
		}
	?>
</table>
<?php 
}else
echo "No Patient Selected"
?>
</div>
</body>