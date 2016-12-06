<?php
include_once 'adminHeader.php';
$res = $_SESSION['admin'];
if (isset($_REQUEST['deleteuser'])){
	$userID = $_REQUEST['deleteuser'];
	$deleteQuery = "DELETE FROM LoginDetails WHERE ID='$userID'";
	$message="Successfully deleted";
	mysql_query($deleteQuery);
	unset($_GET['deleteuser']);
	echo '<center><h2 style="color: green;font-family:verdana;margin-top:30px;"> '.$message.'</h2>';
}
if (isset($_REQUEST['resetPassword'])){
	$userID = $_REQUEST['resetPassword'];
	$pass = md5($userID);
	$resetPasswordQuey="UPDATE LoginDetails SET Password='$pass' WHERE ID='$userID'";
	mysql_query($resetPasswordQuey);
	$message=" Password reset Successfully";
	echo '<center><h2 style="color: green;font-family:verdana;margin-top:30px;"> '.$message.'</h2>';
	unset($_GET['resetPassword']);
}
?>
<div id="resHeader">
<ul>
<li style="float:center; margin-top:-60px;"><a href="doctorReport.php">Doctor Report</a></li>
</ul>
</div>
<head>
<script>
    function printDiv() {
      var divToPrint = document.getElementById('section-to-print');
      newWin = window.open("");
      newWin.document.write(divToPrint.outerHTML);
      newWin.print();
      newWin.close();
   }
</script>
<style>
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<?php
function displayResults() {
	$month = mysql_real_escape_string($_REQUEST['month']);
	$year = mysql_real_escape_string($_REQUEST['year']);
	$checkBox=mysql_real_escape_string($_REQUEST['searchCurrentEmp']);
// 	$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount 
// 			FROM Employee e LEFT OUTER JOIN SeenBy s 
// 			ON e.EmpID= s.EmpID 
// 			WHERE e.EmpType='Doctor' GROUP BY e.EmpID";
	if($month=="00"){
	if($checkBox){
	$message=$year;
		$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND YEAR(a.ApptDate)='$year' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor' AND e.EndDate is null AND YEAR(e.StartDate)<='$year'
			GROUP BY e.EmpID
			ORDER BY seenCount DESC";}
	else{
	$message=$year."(All Doctors)";
	$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND YEAR(a.ApptDate)='$year' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor' AND YEAR(e.StartDate)<='$year'
			GROUP BY e.EmpID
			ORDER BY seenCount DESC";}
	}else{
	$message=$year;
	$dateObj   = DateTime::createFromFormat('!m', $month);
	$monthName = $dateObj->format('F'); 
	$date="$year-$month-31";
	if($checkBox){
		$message=$monthName.", ".$year;
		$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND MONTH(a.ApptDate)='$month' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor' AND e.EndDate is null AND e.StartDate<='$date'
			GROUP BY e.EmpID
			ORDER BY seenCount DESC";}
	else{
		$message=$monthName.", ".$year."(All Doctors)";
		$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND MONTH(a.ApptDate)='$month' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor' AND e.StartDate<='$date'
			GROUP BY e.EmpID
			ORDER BY seenCount DESC";}
	
	}
		$results = mysql_query($query);	
		if(mysql_num_rows($results)==0){
		echo '<h2 style="color:#a51313;font-family: courier;text-align:center;">No Results</h2>';}
		else
		{
		echo '<div id="section-to-print">';
		echo '<h2 style="color:green;font-family: courier;text-align:center;">Doctor Report for '.$message.'.</h2>';
		?>
		
		<table id="t01">
			<tr>
	    	<th>Employee ID</th>
		    <th>First Name</th> 
		    <th>Last Name</th>
		    <th>Department</th>
		    <th>Number of patients seen</th>
			</tr>
	  	<?php
		while ($row = mysql_fetch_array($results)) {
			$deptQuery='SELECT DeptName FROM Department WHERE Department.DeptId= '.$row['DeptID'].' ';
			$deptResult = mysql_query($deptQuery);	
			$deptRow = mysql_fetch_array($deptResult);
			echo '<tr>';
        	echo '<td>' . $row[0] . '</td>';
        	echo '<td>' . $row[1] . '</td>';
        	echo '<td>' . $row[2] . '</td>';
        	echo '<td>' . $deptRow['DeptName'] . '</td>';
        	echo '<td>' . $row[3] . '</td>';
        	echo '</tr>';
		}
		echo '</table>';
		echo '</div>';
	}
}
?>

</head>
<body  bgcolor="#f2f2f2">
<div id="wrapper">
<div id="form">
</br> <label><h2>Doctor Report :</h2></label> </br>
<form name="searchForm" enctype="multipart/form-data" onsubmit="return validateForm()"  method="post" action="#">
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
	
<label>Year :&emsp;</label>
	<select name="year" id="year" ></select></span><span id="yearError"></span><br><br>
	<input type="checkbox" name="searchCurrentEmp" id="searchCurrentEmp" value="true" checked> Search only Current employee.<br><br>
	
<input type="submit" name="reportForm"></br>

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
if (isset($_REQUEST['reportForm'])) {
		displayResults();
	    unset($_REQUEST['reportForm']);
}?>
</div>
</div>
</body>
</html>