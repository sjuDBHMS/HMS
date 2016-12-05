<?php
session_start();
include_once '../dbconnect.php';
$EmpID = $_SESSION['doctor'];
$message="";
if (isset($_REQUEST['reopen'])) {
	$EmpID=$_SESSION['doctor'];
	$ApptID=  $_REQUEST['ApptID'];
	$EmpID=$_SESSION['doctor'];
	$PatientID=$_REQUEST['ID'];
	$fName=$_REQUEST['fName'];
	$lName=$_REQUEST['lName'];

	$query="UPDATE Appointment SET ApptStatus='$EmpID' WHERE ApptID='$ApptID'";
	mysql_query($query);
	echo '<div id="results" >';
    displayResults();
    echo '</div>';
    unset($_REQUEST['reopen']);
	//header("Location: view.php");
}
if (isset($_REQUEST['updateAppointment'])) {
	echo '<div id="results" style="padding-top:5%;">';
    updateAppointment();
    echo '</div>';
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
	echo '<h5 style="color:blue;font-family: courier;text-align:center;">Appointment Updated</h5>';
	displayResults();

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
<script>
function validateForm() {
    var ID = document.forms["searchForm"]["ID"].value;
    var fName = document.forms["searchForm"]["fName"].value;
    var lName = document.forms["searchForm"]["lName"].value;
    if( ID== "" && fName=="" && lName==""){
        document.getElementById("sumbitError").innerHTML = "Enter some value to search";
        document.getElementById("ID").focus();
        return false;
    }
	
}
</script>
</head>
<body bgcolor="#f2f2f2">

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

<div id="wrapper">
<div id="form">
</br> <label><h2>Advance Search Appointments :</h2></label> </br>
<form name="searchForm" enctype="multipart/form-data" onsubmit="return validateForm()"  method="post" action="advSearchAppt.php">

<label>Patient ID:&emsp;</label>
	<input type="text" name="ID" id="ID" placeholder="Login ID"><span id="IDError"></span><br><br>


<label>First Name:&ensp;</label>
	<input type="text" name="fName" id="fName" placeholder="First Name"><span id="fNameError"></span><br><br>

	<label>Last Name:&ensp;&thinsp;</label>
	<input type="text" name="lName" id="lName" placeholder="Last Name"><span id="fNameError"></span><br><br>	
<input type="submit" name="search" value="Search"><a style="padding-left:20px;text-decoration: none" href="searchAppt.php">Search by Date</a></br>&emsp;<span id="sumbitError"></span>
</form>
</div>
<div id="results"  style="padding-top:5%;">
<?php
if (isset($_REQUEST['search'])) {
		displayResults();
	    unset($_REQUEST['search']);
}?>
</div>
</div>
<?php function displayResults() {?>
<?php 
$EmpID=$_SESSION['doctor'];
$PatientID=$_REQUEST['ID'];
$fName=$_REQUEST['fName'];
$lName=$_REQUEST['lName'];

	if($fName!='' &&$lName=='' && $PatientID=='')
		$message="First Name: $fName";
	else if($fName=='' &&$lName!='' && $PatientID=='')
		$message=" Last Name: $lName ";
	else if($fName=='' &&$lName=='' && $PatientID!='')
		$message="PatientID: $PatientID";
	else
		$message="PatientID:'$PatientID', First Name:'$fName', Last Name:'$lName', ";
	$apptQuery="SELECT a.* 
			FROM (SELECT app.* FROM appointment app INNER JOIN patient p ON app.PatientID= p.PatientID WHERE (p.PatientID='$PatientID' or p.PatientFName='$fName' or p.PatientLName='$lName')) a  INNER JOIN seenby s
			ON a.ApptID=s.ApptID
			Where a.ApptStatus='closed' And s.EmpId='$EmpID'
			ORDER BY a.ApptDate DESC";
$apptResult = mysql_query($apptQuery);
//echo mysql_num_rows($result)
if(mysql_num_rows($apptResult)>0)
{
echo '<h2 style="color:green;font-family: courier;text-align:center;">Appointments on '.$message.'.</h2>';
?>
<div class="listHeadign" style="margin-top:50px; width:90%" ><h2  style="color:#f2f2f2;">&nbsp;Previous Appointments</h2></div>
<div class="wrapper" id="ApptView" style=" width:90%">
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
        		<form method="post" action="advSearchAppt.php">
	        		<textarea rows="4" cols="20" name="Prescription"><?php echo $row['Prescription']; ?></textarea>
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		<input type="hidden" name="ID" value= <?php echo $PatientID; ?> >
	        		<input type="hidden" name="fName" value= "<?php echo $fName; ?>" >
	        		<input type="hidden" name="lName" value= "<?php echo $lName; ?>" >
	        		
			</td>
        	<td>
	        		<textarea rows="4" cols="20" name="Comments"><?php echo $row['Comments']; ?></textarea>
        	</td>
        	<td>
        		<input type="submit" value= "Update" name="updateAppointment" />
				</form>
        	</td>
        	<td>
        	<form method="post" action="advSearchAppt.php">
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		<input type="hidden" name="ID" value= <?php echo $PatientID; ?> >
	        		<input type="hidden" name="fName" value= "<?php echo $fName; ?>" >
	        		<input type="hidden" name="lName" value= "<?php echo $lName; ?>" >
	        		<input type="submit" value= "ReOpen" name="reopen"  onclick="return confirm('Are you sure want to reopen Appointmen: <?php echo $row['ApptID']?> ?')" />
				</form>
        	</td>
        	<?php
			echo '</tr>';
		}
	?>
</table>
<?php 
}else
echo '<h2 style="color:#a51313;font-family: courier;text-align:center;margin-top:50px;">No Appointments Found for search <h3 style="color:gray;font-family: courier;text-align:center;">'.$message.'</h3></h2>';
?>
</div>
<?php } ?>
</body>
</html>