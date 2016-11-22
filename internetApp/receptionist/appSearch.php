<?php
include_once 'receptionistHeader.php';
$res = $_SESSION['receptionist'];
?>

<body>
	  <form method="post">
	  <label>Search by patient's ID, name, or date of birth:</label></br>
	  <input type="text" name="fName" placeholder="Patient's First Name">
	  <input type="text" name="lName" placeholder="Patient's Last Name">
	  <input type="date" name="date" placeholder="Patient's Date of Birth">
	  <input type="submit" name="search-name"></br>
	  </form>
	  
	  <form method="post">
	  <label>Search by appointment ID, date, time, status, or Patient Id:</label></br>
	  <input type="text" name="ApptID" placeholder="Appointment ID">
	  <input type="text" name="date" placeholder="Appointment Date">
	  <input type="text" name="time" placeholder="Appointment Time">
	  <input type="text" name="status" placeholder="Appointment Status">
	  <input type="date" name="pid" placeholder="Patient ID">
	  <input type="submit" name="search-all"></br>
	  </form>

	  <form method="post">
	  <label>Search between two dates:</label></br>
	  <input type="date" name="dateFrom" placeholder="Date From">
	  <input type="date" name="dateTo" placeholder="Date To">
	  <input type="submit" name="search-date">
	  </form>

  <?php
	  if (isset($_REQUEST['deleteID'])){
		$did = $_REQUEST['deleteID'];
		$deleteQuery = "DELETE FROM Appointment WHERE ApptID='$did'";

	  if (mysql_query($deleteQuery) === TRUE) {
	    echo ('<p style="color: red"> Appointment deleted successfully </p>');
	  } else {
	    echo ('<p style="color: red"> Error deleting appointment </p>');
	  }
	  }
	
  if(isset($_POST['search-name']))
	{
		//$res = $_POST['fName'];
		$fName = mysql_real_escape_string($_REQUEST['fName']);
		$lName = mysql_real_escape_string($_REQUEST['lName']);
		$date = mysql_real_escape_string($_REQUEST['date']);
		
		$query="SELECT * FROM Appointment WHERE PatientID = any (SELECT PatientID FROM Patient WHERE PatientFName='$fName' or PatientLName='$lName' or DOB='$date')";
		$results = mysql_query($query);
    	
	    ?>
	  <table border="1">
	  <tr>
	    <th>Appointment ID</th>
	    <th>Patient ID</th>
	    <th>Date</th> 
	    <th>Time</th>
	    <th>Comments</th>
	    <th>Prescription</th>
	    <th>Status</th>
	    <th>Edit</th>
	    <th>Delete</th>
	  </tr>
	  <?php

		while ($row = mysql_fetch_array($results)) {
			$pr = $row['PatientID'];
			echo '<tr>';
        	echo '<td>' . $row['ApptID'] . '</td>';
        	echo '<td>' . $row['PatientID'] . '</td>';
        	echo '<td>' . $row['ApptDate'] . '</td>';
        	echo '<td>' . $row['ApptTime'] . '</td>';
        	echo '<td>' . $row['Comments'] . '</td>';
        	echo '<td>' . $row['Prescription'] . '</td>';
        	echo '<td>' . $row['ApptStatus'] . '</td>';
        	echo '<td><a href="editAppointment.php?id=' . $row['ApptID'] . '">Edit</a></td>';
        	echo '<td><a href="appSearch.php?deleteID=' . $row['ApptID'] . '">Delete</a></td>';
			echo '</tr>';
		//}
		}}
		
		if(isset($_POST['search-all']))
	{
		$appID = mysql_real_escape_string($_REQUEST['ApptID']);
		$date = mysql_real_escape_string($_REQUEST['date']);
		$time = mysql_real_escape_string($_REQUEST['time']);
		$status = mysql_real_escape_string($_REQUEST['status']);
		$pID = mysql_real_escape_string($_REQUEST['pid']);
	
        	$query="SELECT * FROM Appointment WHERE ApptID='$appID' or ApptTime='$time' or ApptDate='$date' or ApptStatus='$status' or PatientID='$pID'";
			$results = mysql_query($query);
    	
	    ?>
	  <table border="1">
	  <tr>
	    <th>Appointment ID</th>
	    <th>Patient ID</th>
	    <th>Date</th> 
	    <th>Time</th>
	    <th>Comments</th>
	    <th>Prescription</th>
	    <th>Status</th>
	    <th>Edit</th>
	    <th>Delete</th>
	  </tr>
	  <?php

		while ($row = mysql_fetch_array($results)) {
			$pr = $row['PatientID'];
			echo '<tr>';
        	echo '<td>' . $row['ApptID'] . '</td>';
        	echo '<td>' . $row['PatientID'] . '</td>';
        	echo '<td>' . $row['ApptDate'] . '</td>';
        	echo '<td>' . $row['ApptTime'] . '</td>';
        	echo '<td>' . $row['Comments'] . '</td>';
        	echo '<td>' . $row['Prescription'] . '</td>';
        	echo '<td>' . $row['ApptStatus'] . '</td>';
        	echo '<td><a href="editAppointment.php?id=' . $row['ApptID'] . '">Edit</a></td>';
        	echo '<td><a href="appSearch.php?deleteID=' . $row['ApptID'] . '">Delete</a></td>';
			echo '</tr>';
		}}
		
		if(isset($_POST['search-date']))
	{
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];
	
		
//   			$query="select * FROM Appointment where ApptDate between (select ApptDate from Appointment where ApptDate like '%$dateFrom%' limit 1) and (select ApptDate from Appointment where ApptDate like '%$dateTo%' limit 1) group by ApptDate";
 			$query="select * FROM Appointment where ApptDate between '$dateFrom' and '$dateTo'";
			$results = mysql_query($query);
			echo($res);
    	
	    ?>
	  <table border="1">
	  <tr>
	    <th>Appointment ID</th>
	    <th>Patient ID</th>
	    <th>Date</th> 
	    <th>Time</th>
	    <th>Comments</th>
	    <th>Prescription</th>
	    <th>Status</th>
	    <th>Edit</th>
	    <th>Delete</th>
	  </tr>
	  <?php

		while ($row = mysql_fetch_array($results)) {
			$pr = $row['PatientID'];
			echo '<tr>';
        	echo '<td>' . $row['ApptID'] . '</td>';
        	echo '<td>' . $row['PatientID'] . '</td>';
        	echo '<td>' . $row['ApptDate'] . '</td>';
        	echo '<td>' . $row['ApptTime'] . '</td>';
        	echo '<td>' . $row['Comments'] . '</td>';
        	echo '<td>' . $row['Prescription'] . '</td>';
        	echo '<td>' . $row['ApptStatus'] . '</td>';
        	echo '<td><a href="editAppointment.php?id=' . $row['ApptID'] . '">Edit</a></td>';
        	echo '<td><a href="appSearch.php?deleteID=' . $row['ApptID'] . '">Delete</a></td>';
			echo '</tr>';
		}}
	?>
	</table>
	
</body>
</html>