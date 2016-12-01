<?php
session_start();
include_once '../dbconnect.php';
$EmpID = $_SESSION['doctor'];

?>
<style>
	#form {
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    }
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css" />
<title>Welcome - <?php echo $_SESSION['EmpFName']; ?></title>
<div id="resHeader">
<ul>
	<li><a href="editProfile.php">Edit Profile</a></li>
	<li style="float:right"><a class="active" href="../login/logout.php?logout">Sign Out</a></li>
	<li style="float:right"><a href="doctor.php">Welcome <?php echo $_SESSION['EmpFName']; ?></a></li>
</div>
<script>
function validateForm() {
    var EmpFName = document.forms["editProfileForm"]["EmpFName"].value;
    var EmpLName = document.forms["editProfileForm"]["EmpLName"].value;
    var EmpAddress = document.forms["editProfileForm"]["EmpAddress"].value;
    if( EmpFName== ""){
        document.getElementById("EmpFNameError").innerHTML = "First name cannot be blank";
        document.getElementById("EmpFName").focus();
        return false;
    }else{
        document.getElementById("EmpFNameError").innerHTML = "&#10003;";
	}
	
	if( EmpLName== ""){
        document.getElementById("EmpLNameError").innerHTML = "Last name cannot be blank";
        document.getElementById("EmpLName").focus();
        return false;
    }else{
        document.getElementById("EmpLNameError").innerHTML = "&#10003;";
	}
	
    if( EmpAddress== ""){
        document.getElementById("EmpAddressError").innerHTML = "Address name cannot be blank";
        document.getElementById("EmpAddress").focus();
        return false;
    }else{
        document.getElementById("EmpAddressError").innerHTML = "&#10003;";
	}
	
}
</script>
</head>

<body>
<?php
	$ses_sql=mysql_query("select * from Employee where EmpID='$EmpID'");
	$row_sql=mysql_fetch_array($ses_sql);
	$count_sql = mysql_num_rows($ses_sql);
	if (isset($_REQUEST['updateProfile'])) {
	updateProfile();
    unset($_REQUEST['updateProfile']);
}
function updateProfile()
{
// 	if (!empty($_REQUEST['image'])) {
// 		$tmpName = $_FILES['image']['tmp_name'];
// 		$fp = fopen($tmpName, 'r');
// 		$data = fread($fp, filesize($tmpName));
// 		$data = addslashes($data);
// 		fclose($fp);
// 	    	$res=mysql_query( "update Employee set EmpFName='$EmpFName', EmpLName='$EmpLName', EmpAddress='$EmpAddress' WHERE EmpID='$EmpID'");
// 	}
	$EmpFName=  $_REQUEST['EmpFName'];
	$EmpLName=  $_REQUEST['EmpLName'];
	$EmpAddress= $_REQUEST['EmpAddress'];
	$EmpID= $_REQUEST['EmpID'];
	mysql_query( "update Employee set EmpFName='$EmpFName', EmpLName='$EmpLName', EmpAddress='$EmpAddress' WHERE EmpID='$EmpID'");
	$message = "Your profile has been successfully updated ";
	echo '<center><h1 style="color: green;font-family:verdana;margin-top:100px"> '.$message.'</h1></center>';
	echo "<script>setTimeout(\"location.href = 'doctor.php';\",2000);</script>";

	

}
		?>
		<span id="Message"></span>
		<div id="form">
		<form name="editProfileForm" onsubmit="return validateForm()"  method="post" action="editProfile.php">
		<label>First Name:</label>
		<input type="text" name="EmpFName" id="EmpFName" value=<?php echo($row_sql['EmpFName'])?>><span id="EmpFNameError"></span><br><br>
		<label>Last Name:</label>
		<input type="text" name="EmpLName" id="EmpLName" value=<?php echo($row_sql['EmpLName'])?>><span id="EmpLNameError"></span><br><br>
		<label>Address:</label>
		<input type="text-area" name="EmpAddress" id="EmpAddress" value="<?php echo($row_sql['EmpAddress'])?>"><span id="EmpAddressError"></span><br><br>
		<label>Image:</label>
		<input type="file" name="image"></br><br>
		<input type="hidden" name="EmpID" value= <?php echo $EmpID; ?> ><p>
		<input type="submit" name="updateProfile"></br>
</body>
</html>