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
	echo '<div id="results" >';
    displayResults();
    echo '</div>';
    unset($_REQUEST['reopen']);
	//header("Location: view.php");
}
if (isset($_REQUEST['updateAppointment'])) {
	echo '<div id="results" >';
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
	echo '<h5 style="color:blue;font-family: courier;text-align:center;">Appointment Updated</h2>';
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
    var date = document.forms["searchForm"]["date"].value;
    var month = document.forms["searchForm"]["month"].value;
    var year = document.forms["searchForm"]["year"].value;
    //alert("month ="+month+" \t date="+date+" month!=00"+(date!="00" && month== "00"));
    if(date!="00" && month== "00"){
        document.getElementById("monthError").innerHTML = "Select month to search";
        document.getElementById("month").focus();
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
</br> <label><h2>Search Appointments :</h2></label> </br>
<form name="searchForm" enctype="multipart/form-data" onsubmit="return validateForm()"  method="post" action="searchAppt.php">
<label>Month :&emsp;</label>
	<select name="month" id="month" size="1">
	<option value="00">--Month--</option>
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="06">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
	</select><span id="IDError"></span><span id="monthError"></span><br><br>
	
<label>Date :&emsp;&emsp;</label>
	<select name="date" id="date" >
		<option value="00">--Date--</option>
		<?for($i=1;$i<=31;$i++):?>
         <option value="<?=str_pad($i,2,'0',STR_PAD_LEFT)?>"><?=$i?></option>
    <?endfor?>
	</select></span><span id="dateError"></span><br><br>

<label>Year :&emsp;&emsp;</label>
	<select name="year" id="year" ></select></span><span id="yearError"></span><br><br>
	
<input type="submit" name="search"></br>

<script>
	var end = 1900;
	var start = new Date().getFullYear();
	var options = "";
	for(var year = start ; year >=end; year--){
	  options += "<option>"+ year +"</option>";
	}
	document.getElementById("year").innerHTML = options;
</script>
</form>
</div>
<div id="results">
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
$date=$_REQUEST['date'];
$month=$_REQUEST['month'];
$year=$_REQUEST['year'];
if($month=="00"){
	$messageDate=$year;
	$apptQuery="SELECT a.* 
			FROM appointment a  INNER JOIN seenby s
			ON a.ApptID=s.ApptID
			Where a.ApptStatus='closed' And s.EmpId='$EmpID' AND YEAR(a.ApptDate)='$year'
			ORDER BY a.ApptDate DESC";

}else if($month!="00" && $date!="00"){
$dateObj   = DateTime::createFromFormat('!m', $month);
$monthName = $dateObj->format('F'); 
$messageDate=$monthName.", ".$date.", ".$year;
$fullDate="$year-$month-$date";
$apptQuery="SELECT a.* 
			FROM appointment a  INNER JOIN seenby s
			ON a.ApptID=s.ApptID
			Where a.ApptStatus='closed' And s.EmpId='$EmpID' AND a.ApptDate='$fullDate'
			ORDER BY a.ApptDate DESC";
}else{
$dateObj   = DateTime::createFromFormat('!m', $month);
$monthName = $dateObj->format('F'); 
$messageDate=$monthName.", ".$year;
$apptQuery="SELECT a.* 
			FROM appointment a  INNER JOIN seenby s
			ON a.ApptID=s.ApptID
			Where a.ApptStatus='closed' And s.EmpId='$EmpID' AND YEAR(a.ApptDate)='$year' AND MONTH(a.ApptDate)='$month'
			ORDER BY a.ApptDate DESC";
}
$apptResult = mysql_query($apptQuery);
//echo mysql_num_rows($result)
if(mysql_num_rows($apptResult)>0)
{
echo '<h2 style="color:green;font-family: courier;text-align:center;">Appointments on '.$messageDate.'.</h2>';
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
        		<form method="post" action="searchAppt.php">
	        		<textarea rows="4" cols="25" name="Prescription"><?php echo $row['Prescription']; ?></textarea>
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		<input type="hidden" name="date" value= "<?php echo $date; ?>" >
	        		<input type="hidden" name="month" value= "<?php echo $month; ?>" >
	        		<input type="hidden" name="year" value= "<?php echo $year; ?>" >
	        		
			</td>
        	<td>
	        		<textarea rows="4" cols="25" name="Comments"><?php echo $row['Comments']; ?></textarea>
        	</td>
        	<td>
        		<input type="submit" value= "Update" name="updateAppointment" />
				</form>
        	</td>
        	<td>
        	<form method="post" action="searchAppt.php">
	        		<input type="hidden" name="ApptID" value= <?php echo $row['ApptID']; ?> >
	        		<input type="hidden" name="date" value= "<?php echo $date; ?>" >
	        		<input type="hidden" name="month" value= "<?php echo $month; ?>" >
	        		<input type="hidden" name="year" value= "<?php echo $year; ?>" >
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
echo '<h2 style="color:#a51313;font-family: courier;text-align:center;margin-top:50px">No Appointments Found<h2>';
?>
</div>
<?php } ?>
</body>
</html>