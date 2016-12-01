<?php
include_once 'receptionistHeader.php';
$res = $_SESSION['receptionist'];
$newApp = $_REQUEST['newApp'];
?>
<style>
/*
	#form {
		position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translateX(-50%) translateY(-50%);
    }
*/
</style>
<body>
	<div align="center">
<?php
	if(isset($_POST['add-submit']))
	{
		$pid = mysql_real_escape_string($_REQUEST['pid']);
		$date = mysql_real_escape_string($_REQUEST['date']);
		$time = mysql_real_escape_string($_REQUEST['time']);
		$comm = mysql_real_escape_string($_REQUEST['comm']);
		$status = mysql_real_escape_string($_REQUEST['status']);
	
	
		if (empty($pid)) {
        	echo ('<p style="color: red"> PatientId cannot be empty </p>');
    	}
    	else if (empty($date)) {
        	echo ('<p style="color: red"> Date cannot be empty </p>');
    	}
    	else if (empty($time)) {
        	echo ('<p style="color: red"> Time cannot be empty </p>');
    	}
    	else {
	    	if(mysql_query("INSERT INTO Appointment(ApptDate, ApptTime, Comments, ApptStatus, PatientID) VALUES('$date','$time','$comm','$status', '$pid')"))
	    	{
				echo ('<p style="color: green"> successfully added a new Appointment </p>');
			}
			else
			{
				echo ('<p style="color: red"> error while registering you: </p>');
				echo mysql_error();
			}
		
// 			echo('<p style="color: green"> We have updated your name and image successfully </p>');
    	}
    }
		
		
		?>
		</br> <label>Add a new appointment:</label> </br>
		<div id="form">
		<form method="post">
		<label>Patient ID:</label>
		<input type="number" name="pid" value="<?php  echo $newApp; ?>"></br>
		<label>Appointment Date:</label>
		<input type="date" name="date"></br>
		<label>Appointment Time:</label>
		<input type="text" name="time"></br>
		<label>Comments:</label>
		<input type="text" name="comm"></br>
		<label>ApptStatus:</label>
		<input type="text" name="status"></br></br>
		<input type="submit" name="add-submit"></br>
</div>
</body>
</html>