<?php
include_once 'receptionistHeader.php';
$appID = $_REQUEST['id'];
?>
<!--
<style>
/*
	#form {
		position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translateX(-50%) translateY(-50%);
    }
*/
    input[type=text] {
	    padding: 12px 20px;
	    margin: 8px 0;
	    display: inline-block;
	    border: 1px solid #ccc;
	    border-radius: 10px;
	    box-sizing: border-box;
	}
</style>
-->
<body>
	
<?php
	if(isset($_POST['edit-submit']))
	{
		$date = mysql_real_escape_string($_REQUEST['date']);
		$time = mysql_real_escape_string($_REQUEST['time']);
		$status = mysql_real_escape_string($_REQUEST['status']);
		$comm = mysql_real_escape_string($_REQUEST['comm']);
		$pID = mysql_real_escape_string($_REQUEST['pid']);
	
		if (empty($pID)) {
        	echo ('<p style="color: green"> Patient Id cannot be empty </p>');
    	}
    	else if (empty($date)) {
        	echo ('<p style="color: red"> Date cannot be empty </p>');
    	}
    	else if (empty($time)) {
        	echo ('<p style="color: red"> Time cannot be empty </p>');
    	}
    	 else {
        	$res=mysql_query("update Appointment set ApptDate='$date', ApptTime='$time', Comments='$comm', ApptStatus='$status', PatientID='$pID' WHERE ApptID='$appID'");
			echo('<p style="color: green"> We have updated your name successfully </p>');
    	}
    }
    if(isset($_REQUEST['id']))
		{
		$fn = $_REQUEST['id'];
		$ses_sql=mysql_query("select * from Appointment where ApptID='$fn'");
		$row_sql=mysql_fetch_array($ses_sql);
		$count_sql = mysql_num_rows($ses_sql);
	// 	echo($res);
		
		?>
		
		<div id="form">
		<form method="post">
		<label>Patient ID:</label>
		<input type="number" name="pid" value=<?php echo($row_sql['PatientID'])?>></br>
		<label>Appointment Date:</label>
		<input type="date" name="date" value=<?php echo($row_sql['ApptDate'])?>></br>
		<label>Appointment Time:</label>
		<input type="test" name="time" value=<?php echo($row_sql['ApptTime'])?>></br>
		<label>Comments:</label>
		<input type="text" name="comm" value=<?php echo($row_sql['Comments'])?>></br>
		<label>ApptStatus:</label>
		<input type="text" name="status" value=<?php echo($row_sql['ApptStatus'])?>></br></br>
		<input type="submit" name="edit-submit"></br>
		<?php } ?>
</body>
</html>