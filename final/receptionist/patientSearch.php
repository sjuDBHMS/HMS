<?php
include_once 'receptionistHeader.php';
$res = $_SESSION['receptionist'];
?>

<body bgcolor="#f2f2f2">
	<div align="center">
	  <form method="post">
	  </br> <label>Search by patient ID, name or date of birth:</label> </br>
	  <input type="text" name="pid" placeholder="Patient ID">
	  <input type="text" name="fName" placeholder="First Name">
	  <input type="text" name="lName" placeholder="Last Name">
	  <input type="date" name="date" placeholder="Date of Birth">
	  <input type="submit" name="search-FName"></br>
	  </form>

	  <form method="post">
	  <label>Search between two dates:</label></br>
	  <input type="date" name="dateFrom" placeholder="Date From">
	  <input type="date" name="dateTo" placeholder="Date To">
	  <input type="submit" name="search-Date">
	  </form>

  <?php
	  if (isset($_REQUEST['deletePatient'])){
		$pid = $_REQUEST['deletePatient'];
		$deleteQuery = "DELETE FROM Patient WHERE PatientID='$pid'";
		mysql_query($deleteQuery);

	  if ($num = mysql_affected_rows() > 0) {
	    echo ('<p style="color: green"> Patient deleted successfully </p>');
	  } else {
	    echo ('<p style="color: red"> Error deleting patient </p>');
	  }
	  }
	
  if(isset($_POST['search-FName']))
	{
		$pid = mysql_real_escape_string($_REQUEST['pid']);
		$fName = mysql_real_escape_string($_REQUEST['fName']);
		$lName = mysql_real_escape_string($_REQUEST['lName']);
		$date = mysql_real_escape_string($_REQUEST['date']);
	
        	$query="SELECT * FROM Patient WHERE PatientID='$pid' or PatientFName='$fName' or PatientLName='$lName' or DOB='$date'";
			$results = mysql_query($query);
    	
	    ?>
	    </br>
	  <table border="1">
	  <tr>
	    <th>PatientID</th>
	    <th>First Name</th> 
	    <th>Last Name</th>
	    <th>PatientAddress</th>
	    <th>Birth of date</th>
	    <th>Edit</th>
	    <th>Delete</th>
	    <th>New Appointment</th>
	  </tr>
	  <?php

		while ($row = mysql_fetch_array($results)) {
			$pr = $row['PatientID'];
			echo '<tr>';
        	echo '<td>' . $row['PatientID'] . '</td>';
        	echo '<td>' . $row['PatientFName'] . '</td>';
        	echo '<td>' . $row['PatientLName'] . '</td>';
        	echo '<td>' . $row['PatientAddress'] . '</td>';
        	echo '<td>' . $row['DOB'] . '</td>';
        	echo '<td><a href="editPatientProfile.php?id=' . $row['PatientID'] . '">Edit</a></td>';
        	echo '<td><a href="ApppatientSearch.php?deletePatient=' . $row['PatientID'] . '">Delete</a></td>';
        	echo '<td><a href="newApp.php?newApp=' . $row['PatientID'] . '">New</a></td>';
			echo '</tr>';
		}}
		
		if(isset($_POST['search-Date']))
	{
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];
		$query="select * FROM Patient where DOB between '$dateFrom' and '$dateTo'";
		$results = mysql_query($query);
    	
	    ?>
	  </br>
	  <table border="1">
	  <tr>
	    <th>PatientID</th>
	    <th>First Name</th> 
	    <th>Last Name</th>
	    <th>PatientAddress</th>
	    <th>Birth of date</th>
	    <th>Edit</th>
	    <th>Delete</th>
	    <th>New Appointment</th>
	  </tr>
	  <?php

		while ($row = mysql_fetch_array($results)) {
			$pr = $row['PatientID'];
			echo '<tr>';
        	echo '<td>' . $row['PatientID'] . '</td>';
        	echo '<td>' . $row['PatientFName'] . '</td>';
        	echo '<td>' . $row['PatientLName'] . '</td>';
        	echo '<td>' . $row['PatientAddress'] . '</td>';
        	echo '<td>' . $row['DOB'] . '</td>';
        	echo '<td><a href="editPatientProfile.php?id=' . $row['PatientID'] . '">Edit</a></td>';
        	echo '<td><a href="patientSearch.php?deletePatient=' . $row['PatientID'] . '">Delete</a></td>';
        	echo '<td><a href="newApp.php?newApp=' . $row['PatientID'] . '">New</a></td>';
			echo '</tr>';
		}}
	?>
	</table>
	</div
</body>
</html>