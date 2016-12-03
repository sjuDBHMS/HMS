<?php
include_once 'adminHeader.php';
$res = $_SESSION['admin'];
if (isset($_REQUEST['deleteuser'])){
	$userID = $_REQUEST['deleteuser'];
	$deleteQuery = "DELETE FROM LoginDetails WHERE ID='$userID'";
	$message="Successfully deleted";
	mysql_query($deleteQuery);
	$mysqldate = date("Y-m-d");
	$updateEmpEndEate="UPDATE Employee SET EndDate='$mysqldate' WHERE EmpID='$userID'";
	mysql_query($updateEmpEndEate);
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
<head>
<style>

div#form, div#results
	{
    position:absolute;
    margin: 5px;
	}
div#form
	{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
	}
div#results
	{
    top:80%;
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
</style>
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
<?php
function displayResults() {
	$ID = mysql_real_escape_string($_REQUEST['ID']);
	$fName = mysql_real_escape_string($_REQUEST['fName']);
	$lName = mysql_real_escape_string($_REQUEST['lName']);
	$userType=mysql_real_escape_string($_REQUEST['userType']);
	if($userType=="patient"){
		$query="SELECT * FROM Patient p, LoginDetails l WHERE (PatientID='$ID' or PatientFName='$fName' or PatientLName='$lName') AND p.PatientID=l.ID";
		$results = mysql_query($query);	
		if(mysql_num_rows($results)==0){
		echo '<h2 style="color:#a51313;font-family: courier;text-align:center;">No Matches found try again<h2>';}
		else
		{?>
		<table id="t01">
			<tr>
	    	<th>PatientID</th>
		    <th>First Name</th> 
		    <th>Last Name</th>
		    <th>PatientAddress</th>
		    <th>Birth of date</th>
		    <th>Reset Password</th>
		    <th>Delete</th>
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
        	echo '<td><a href="updateUser.php?resetPassword=' . $row['PatientID'] . '">Reset Password</a></td>';
        	echo '<td><a href="updateUser.php?deleteuser=' . $row['PatientID'] . '">Delete</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		}
	}
	else{
		$query="SELECT * FROM Employee e , LoginDetails l WHERE (EmpID = '$ID' or EmpFName = '$fName' or EmpLName = '$lName')  AND e.EmpID=l.ID";
		$results = mysql_query($query);	
		if(mysql_num_rows($results)==0){
		echo '<h2 style="color:#a51313;font-family: courier;text-align:center;">No Matches found try again<h2>';}
		else
		{?>
		<table id="t01">
			<tr>
	    	<th>Employee ID</th>
		    <th>First Name</th> 
		    <th>Last Name</th>
		    <th>Employee Address</th>
		    <th>Reset Password</th>
		    <th>Delete</th>
			</tr>
	  	<?php
		while ($row = mysql_fetch_array($results)) {
			$pr = $row['PatientID'];
			echo '<tr>';
        	echo '<td>' . $row['EmpID'] . '</td>';
        	echo '<td>' . $row['EmpFName'] . '</td>';
        	echo '<td>' . $row['EmpLName'] . '</td>';
        	echo '<td>' . $row['EmpAddress'] . '</td>';
        	echo '<td><a href="updateUser.php?resetPassword=' . $row['EmpID'] . '">Reset Password</a></td>';
        	echo '<td><a href="updateUser.php?deleteuser=' . $row['EmpID'] . '">Delete</a></td>';
			echo '</tr>';
		}
		echo '</table>';
		}
		}
	
}
?>

</head>
<body  bgcolor="#f2f2f2">
<div id="wrapper">
<div id="form">
<form name="searchForm" enctype="multipart/form-data" onsubmit="return validateForm()"  method="post" action="updateUser.php">
</br> <label><h2>Search by ID, First Name or Last Name:</h2></label> </br>

	<label>Login ID:&emsp;</label>
	<input type="text" name="ID" id="ID" placeholder="Login ID"><span id="IDError"></span><br><br>

	<label>First Name:&ensp;</label>
	<input type="text" name="fName" id="fName" placeholder="First Name"><span id="fNameError"></span><br><br>

	<label>Last Name:&ensp;&thinsp;</label>
	<input type="text" name="lName" id="lName" placeholder="Last Name"><span id="fNameError"></span><br><br>

	<label>Type:&emsp;&emsp;&emsp;</label>
		<input type="radio" name="userType" value="employee" checked> Employee
	  	<input type="radio" name="userType" value="patient"> Patient<br><br>
	<input type="submit" value="Search" name="search-FName">&emsp;<span id="sumbitError"></span><br><br>
	
</form>
</div>
<div id="results">
<?php
if(isset($_POST['search-FName']))
{
	displayResults();
}
?>
</div>
</div>
</body>
</html>