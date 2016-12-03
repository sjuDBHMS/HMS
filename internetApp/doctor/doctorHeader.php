<?php
session_start();
if(!isset($_SESSION['doctor']))
{
	header("Location: ../login/index.php");
}
if (isset($_GET['selectPatientID'])) {
    selectPatient();
    unset($_GET['selectPatientID']);
    header("Location: doctor.php");
}
if (isset($_REQUEST['updateComment'])) {
    updateComment();
    unset($_REQUEST['updateComment']);
    header("Location: doctor.php");
}
if (isset($_REQUEST['updateStatus'])) {
    updateStatus();
    unset($_REQUEST['updateStatus']);
    header("Location: doctor.php");
}
if (isset($_GET['cancelApptID'])) {
    cancelApptID();
    unset($_GET['cancelApptID']);
    header("Location: doctor.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
.wrapper{
margin-left: 20px;
margin-top: -22px;
height: 200px;
border: 2px solid rgba(00,11,22,33);
    border-radius: 5px;
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
background-color: #4A96AD;
margin: 20px;
border: 2px solid rgba(00,11,22,33);
color:#2B2B2B;
border-radius: 5px;
width:80%; 
}
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css" />
<title>Welcome - <?php echo $_SESSION['EmpFName']; ?></title>
<div id="resHeader">
<ul>
	<li><a href="doctor.php">Home</a></li>
	<li style="float:right"><a class="active" href="../login/logout.php?logout">Sign Out</a></li>
	<li style="float:right"><a href="editProfile.php">Edit Profile</a></li>
	<li style="float:right"><a href="doctor.php">Welcome <?php echo $_SESSION['EmpFName']; ?></a></li>
</div>
</head>

<?php
function selectPatient() {
	$doctorID=$_SESSION['doctor'];
	$patientID=$_GET['selectPatientID'];
	$ApptID= $_GET['appointmentID'];
	$query="UPDATE Appointment SET ApptStatus=$doctorID WHERE ApptID=$ApptID";
	$result = mysql_query($query);
	//To check if the data already exist
	$seenByquery="SELECT * from SeenBy where ApptID=$ApptID and EmpId=$doctorID";
	$result = mysql_query($seenByquery);
	if(mysql_num_rows($result)==0)
	{
		$query='INSERT INTO SeenBy(ApptID, EmpId) VALUES ('.$ApptID.','.$doctorID.')';
		$retval=mysql_query($query);
	}
	$Billquery="SELECT * from Bill where ApptID=$ApptID ";
	$result = mysql_query($Billquery);
	$row = mysql_fetch_array($result);
	if(mysql_num_rows($result)==0)
	{
		$query='INSERT INTO Bill( PendingAmount, TotalAmount, Paid, ApptID) VALUES ( 30, 30, 0, '.$ApptID.')';
		$retval=mysql_query($query);
	}else{
		$BillId=$row['BillId'];
		$TotalAmount=$row['TotalAmount']+30;
		$PendingAmount= $row['PendingAmount']+30;
		$query="UPDATE Bill SET PendingAmount= '$PendingAmount', TotalAmount= '$TotalAmount' WHERE BillId= '$BillId' " ;
		mysql_query($query);
	}
	
  }
  
function updateComment()
{
	$newComment= $_REQUEST['comment'];
	$ApptID=  $_REQUEST['ApptID'];
	$query="UPDATE Appointment SET Comments='$newComment' WHERE ApptID='$ApptID'";
	mysql_query($query);
}

function updateStatus()
{
	if($_REQUEST['status']=='close'){
		$ApptID=  $_REQUEST['ApptID'];
		$query="UPDATE Appointment SET ApptStatus='closed' WHERE ApptID=$ApptID";
		$result = mysql_query($query);	
	}
	if($_REQUST['status']=='reschedule'){
	
	}
}
function cancelApptID()
{
	$doctorID=$_SESSION['doctor'];
	$ApptID= $_GET['cancelApptID'];
	$query="UPDATE Appointment SET ApptStatus=NULL WHERE ApptID=$ApptID";
	$result = mysql_query($query);
	
	$removeseenByquery="DELETE FROM SeenBy WHERE ApptID='$ApptID' and EmpId='$doctorID'";
	mysql_query($removeseenByquery);
	$Billquery="SELECT * from Bill where ApptID=$ApptID ";
	$result = mysql_query($Billquery);
	$row = mysql_fetch_array($result);
	if(mysql_num_rows($result)==1)
	{
		$BillId=$row['BillId'];
		$TotalAmount=$row['TotalAmount']-30;
		$PendingAmount= $row['PendingAmount']-30;
		$query="UPDATE Bill SET PendingAmount= '$PendingAmount', TotalAmount= '$TotalAmount' WHERE BillId= '$BillId' " ;
		mysql_query($query);
	}
}
?>
<body bgcolor="#f2f2f2">
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<!-- Select patients -->
<div class="listHeadign" ><h2 style="color:#f2f2f2;">Waiting List</h2></div>
<div class="wrapper">
<?php 
$doctorID=$_SESSION['doctor'];
$apptQuery="SELECT * FROM Appointment where DATE(ApptDate) = CURDATE() and (ApptStatus is null)";
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
echo '<h2 style="color:#a51313;font-family: courier;text-align:center;margin-top:50px">No appointments found<h2>';
?>
</div>


<!-- Selected patients -->
<div class="listHeadign" ><h2  style="color:#f2f2f2;">Selected Patients</h2></div>
<div class="wrapper">
<?php 
$doctorID=$_SESSION['doctor'];
$apptQuery="SELECT * FROM Appointment where DATE(ApptDate) = CURDATE() and ApptStatus = '$doctorID'";
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
        	?>
        	<td>
        		<select name="status" onchange="updateStatus(this.value)"> 
					<option value="select">--Select--</option>
					<option value= <?php echo 'closeAppointment.php?ApptID='.$row['ApptID']?> >close Appointment</option>
				    <option name = "Reschedule" value= "<?php echo 'reschedule.php?PatientID='.$PatientID?> ">Reschedule</option>
				</select><br>
			</td>
        	<td>
	        	<form method="post" action="doctor.php">
	        		<textarea rows="4" cols="25" name="comment"><?php echo $row['Comments']; ?></textarea>
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		<input type="submit" value= "Update" style="width: 30%;" name="updateComment" />
				</form>
        	
        	</td>
        	<td>
        		<a href="doctor.php?cancelApptID=<?php echo $row['ApptID'] ?>">undo select</a>
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


</body>