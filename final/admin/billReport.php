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
// 	$query="SELECT e.EmpID AS EmpID, e.EmpFName AS EmpFName, e.EmpLName AS EmpLName,count(s.ApptID) AS seenCount 
// 			FROM Employee e LEFT OUTER JOIN SeenBy s 
// 			ON e.EmpID= s.EmpID 
// 			WHERE e.EmpType='Doctor' GROUP BY e.EmpID";
	if($month=="00"){
	$message=$year;
	$query="SELECT SUM(b.TotalAmount) AS TotalAmount, SUM(b.Paid) AS Paid , SUM(b.pendingAmount) AS PendingAmount
			from Bill b, Appointment a 
			where a.ApptID=b.ApptID And YEAR(a.ApptDate)='$year'";
	}else{
	$dateObj   = DateTime::createFromFormat('!m', $month);
	$monthName = $dateObj->format('F');
	$message=$monthName.", ".$year;
	$query="SELECT SUM(b.TotalAmount) AS TotalAmount, SUM(b.Paid) AS Paid , SUM(b.pendingAmount) AS PendingAmount
			from Bill b, Appointment a 
			where a.ApptID=b.ApptID And YEAR(a.ApptDate)='$year' AND MONTH(a.ApptDate)='$month'";
	
	}
		$results = mysql_query($query);	
		if(mysql_num_rows($results)==0){
		echo '<h2 style="color:#a51313;font-family: courier;text-align:center;">No Results</h2>';}
		else
		{	$row = mysql_fetch_array($results);
			echo '<center>';
			echo '<h2 style="color:green;font-family: courier;text-align:center;">Financial Report for '.$message.'.</h2><br>';
			echo '<label>Total Billed Amount:&ensp;&ensp;</label>$'.$row['TotalAmount'].'<br><br>';
			echo '<label>Total Paid Amount:&ensp;&ensp;&ensp;</label>$ '.$row['Paid'].'<br><br>';
			echo '<label>Total Pending Amount:&ensp;</label>$'.$row['PendingAmount'].'<br><br>';
			echo '</center>';
		}
}
?>

</head>
<body  bgcolor="#f2f2f2">
<div id="wrapper">
<div id="form">
</br> <label><h2>Financial Report :</h2></label> </br>
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
		echo '<div id="section-to-print">';
		displayResults();
		echo '</div>';
	    unset($_REQUEST['reportForm']);
}?>
</div>
</div>
</body>
</html>