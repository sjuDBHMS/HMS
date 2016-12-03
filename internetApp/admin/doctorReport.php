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

div#form, div#results
	{
    position:absolute;
    margin: 5px;
	}
div#form
	{
    position: absolute;
    top: 30%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
	}
div#results
	{
    top:50%;
    left:2.5%;
    width:95%;
	}​
	
    #profileImage {
    position: relative;
	}
	#profileImage img {
    position: fixed;
    top: 80px;
    right: 50px;
    border: 2px solid rgba(00,11,22,33);
	border-radius: 7px;
}
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
	$message=$year;
	if($checkBox)
		$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND YEAR(a.ApptDate)='$year' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor' AND e.EndDate is null
			GROUP BY e.EmpID";
	else
	$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND YEAR(a.ApptDate)='$year' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor'
			GROUP BY e.EmpID";
	}else{
	$dateObj   = DateTime::createFromFormat('!m', $month);
	$monthName = $dateObj->format('F'); 
	$message=$monthName.", ".$year;
	if($checkBox)
		$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND MONTH(a.ApptDate)='$month' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor' AND e.EndDate is null
			GROUP BY e.EmpID";
	else
		$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount , e.DeptID AS DeptID
			FROM Employee e LEFT OUTER JOIN (SELECT s.ApptID, s.EmpId FROM SeenBy s, Appointment a WHERE s.ApptID=a.ApptID AND MONTH(a.ApptDate)='$month' ) s 
			ON e.EmpID= s.EmpID 
			WHERE e.EmpType='Doctor'
			GROUP BY e.EmpID";
	
	}
		$results = mysql_query($query);	
		if(mysql_num_rows($results)==0){
		echo '<h2 style="color:#a51313;font-family: courier;text-align:center;">No Results</h2>';}
		else
		{echo '<h2 style="color:green;font-family: courier;text-align:center;">Doctor Report for '.$message.'.</h2>';
		?>
		<div id="section-to-print">
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