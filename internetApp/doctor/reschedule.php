<!doctype html>
<html lang="en">
<?php
include_once '../dbconnect.php';
$res = $_SESSION['doctor'];
if (isset($_REQUEST['rescheduleAppointment'])) {
    rescheduleAppointment();
    unset($_REQUEST['rescheduleAppointment']);
}
function rescheduleAppointment()
{
	$AppTime= $_REQUEST['AppTime'];
	$PatientID=  $_REQUEST['PatientID'];
	
	$AppDate=  date("Y-m-d", strtotime($_REQUEST['AppDate']) );
	$query="INSERT INTO Appointment( AppDate, AppTime, PatientID) VALUES ('$AppDate', '$AppTime', '$PatientID')";
	$result = mysql_query($query);	
echo '<script type="text/javascript">',
     'parent.jQuery.colorbox.close();',
     'alert("Reschedule Appointment Created");</script>';
}
?>
<head>
<style>
div {
    margin-top: 30px;
    margin-left: 3px;

}
</style>
<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  function validateForm() {
    var date = document.forms["rescheduleform"]["AppDate"].value;
    var time = document.forms["rescheduleform"]["AppTime"].value;
    var d1 = new Date();
	var d2 = new Date(date);
    var date_regex = /^(0[1-9]|1[0-2])\/(0[1-9]|1\d|2\d|3[01])\/(19|20)\d{2}$/ ;
    var regex = /^([0]\d|[1][0-2]):([0-5]\d)\s?(?:AM|PM)$/i;
    if (date == "") {
        document.getElementById("dateError").innerHTML = "&#9754; Error: Date cannot be empty!";
        document.getElementById("datepicker").focus();
        return false;
    }else if(!(date_regex.test(date)))
    {
    	document.getElementById("dateError").innerHTML = "&#9754; Error: Invalid Date!";
        document.getElementById("datepicker").focus();
        return false;
    }else if(d2<d1){
    	document.getElementById("dateError").innerHTML = "&#9754; Error: Date cannot be before today!";
        document.getElementById("datepicker").focus();
        return false;
    }
    else{
    	document.getElementById("dateError").innerHTML = "&#10003;";
    	}
    
    if (time == "") {
        document.getElementById("timeError").innerHTML = "&#9754; Error: time cannot be empty!";
        document.getElementById("time").focus();
        return false;
    }else if(!(regex.test(time))) {
		document.getElementById("timeError").innerHTML = "&#9754; Invalid time format: " ;
      	document.getElementById("time").focus();
      	return false;
    }else{
    	document.getElementById("timeError").innerHTML = "&#10003;";
    	}
}
  </script>
</head>
<body bgcolor="#f2f2f2">
<div>
<h2> Reschedule</h2>
<form name="rescheduleform" onsubmit="return validateForm()" method="post" action="reschedule.php">
<p>Date: </p>
<input type="text" name="AppDate" id="datepicker"><span id="dateError"></span><p>
<input type="hidden" name="PatientID" value= <?php echo $_GET['PatientID']; ?> ><p>
<p>Time:</p>
<input type="time" name="AppTime" id="time"><span id="timeError"></span><p>
<input type="submit" value= "Reschedule and Close" style="width: 30%;" name="rescheduleAppointment" />
</form>
</div>
</body>
</html>