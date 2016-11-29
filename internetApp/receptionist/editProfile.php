<?php
include_once 'receptionistHeader.php';
$res = $_SESSION['receptionist'];
?>
<style>
	#form {
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    }
</style>
<body>
<?php
	if(isset($_POST['edit-submit']))
	{
		$fName = mysql_real_escape_string($_REQUEST['fName']);
		$lName = mysql_real_escape_string($_REQUEST['lName']);
		$address = $_REQUEST['address'];
	
		$tmpName = $_FILES['image']['tmp_name'];
		echo($tmpName);
		// Read the file
		$fp = fopen($tmpName, 'r');
		$data = fread($fp, filesize($tmpName));
		$data = addslashes($data);
		fclose($fp);
	
		if (empty($fName)) {
        	echo ('<p style="color: red"> First name is empty </p>');
    	}
    	else if (empty($lName)) {
        	echo ('<p style="color: red"> Last name is empty </p>');
    	}
    	else if (empty($address)) {
        	echo ('<p style="color: red"> Address is empty </p>');
    	}
    	else if (!empty($_REQUEST['image'])) {
	    	$res=mysql_query("update Employee set EmpFName='$fName', EmpLName='$lName', Image='$data', EmpAddress='$address' WHERE EmpID='$res'");
			echo('<p style="color: green"> We have updated your name and image successfully </p>');
    	}
    	 else {
//         echo $fName . " " . $lName;
        	$res=mysql_query("update Employee set EmpFName='$fName', EmpLName='$lName', EmpAddress='$address' WHERE EmpID='$res'");
			echo('<p style="color: green">We have updated your name successfully </p>');
    	}
    }
		$ses_sql=mysql_query("select * from Employee where EmpID='$res'");
		$row_sql=mysql_fetch_array($ses_sql);
		$count_sql = mysql_num_rows($ses_sql);
		$fn = $row_sql['EmpFName'];
	// 	echo($res);
		
		?>
		<div id="form">
		<form method="post">
		<label>First Name:</label>
		<input type="text" name="fName" value=<?php echo($fn)?>>
		<label>Last Name:</label>
		<input type="text" name="lName" value=<?php echo($row_sql['EmpLName'])?>></br>
		<label>Address:</label>
		<input type="text" name="address" value=<?php echo($row_sql['EmpAddress'])?>>
		<label>Image:</label>
		<input type="file" name="image"></br>
		<input type="submit" name="edit-submit"></br>
</body>
</html>