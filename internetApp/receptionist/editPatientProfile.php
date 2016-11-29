<?php
include_once 'receptionistHeader.php';
$res = $_REQUEST['id'];
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
	<div align="center">
<?php
	if(isset($_POST['edit-submit']))
	{
		$fName = mysql_real_escape_string($_REQUEST['fName']);
		$lName = mysql_real_escape_string($_REQUEST['lName']);
		$address = mysql_real_escape_string($_REQUEST['address']);
		$date = mysql_real_escape_string($_REQUEST['dob']);
	
/*
	if (getimagesize($_FILES['image']['tmp_name']) == false)
	{
		echo("Please select an image!");
	}
	else{
*/
/*
		$tmpName = $_FILES['image']['tmp_name'];
		$image = addslashes(file_get_contents($tmpName));
		$name = addslashes(file_get_contents($_FILES['image']['name']));
		$image = file_get_contents($image);
		$image = base64_encode($image);
*/
		
		$image = file_get_contents($_FILES['image']['tmp_name']);
		//echo(addcslashes(file_get_contents($_FILES['image']['tmp_name'])));
// 		$image_name = addcslashes(_FILES['image']['name']);
		
/*
		move_uploaded_file($_FILES['image']['tmp_name'], "img/".$_FILES['image']['name']);
		
		$folder = "img/";
		if (is_dir($folder))
		{
			if ($handle = opendir($folder))
			{
				while(($file = readdir($handle)) != false)
				{
					if($file==='.' || $file==='..') continue;
					echo '<img src="img/'.$file.'" width="128" height="128" >';
					echo($file);
				}
				closedir($handle);
				
			} else {
			echo("cannot open directory");
		}
		} else {
			echo("No such directory");
		}
*/
// 		}
		// Read the file
/*
		$fp = fopen($tmpName, 'r');
		$data = fread($fp, filesize($tmpName));
		$data = addslashes($data);
		fclose($fp);
*/
		
		
		?>
<!-- 	    <img src="<?php echo($data) ?>"> -->
	    <?php
	
		if (empty($fName)) {
        	echo ('<p style="color: red"> First name is empty </p>');
    	}
    	else if (empty($lName)) {
        	echo ('<p style="color: red"> Last name is empty </p>');
    	}
    	else if (empty($address)) {
        	echo ('<p style="color: red"> Address is empty </p>');
    	}
/*
    	else if (!empty($_REQUEST['image'])) {
	    	$res=mysql_query("update Patient set PatientFName='$fName', PatientLName='$lName', Image='$file', PatientAddress='$address', DOB='$date' WHERE PatientID='$res'");
			echo('<p style="color: green"> We have updated your name and image successfully </p>');
    	}
*/
    	 else {
//         echo $fName . " " . $lName;
        	$res=mysql_query("update Patient set PatientFName='$fName', PatientLName='$lName', Image='$image', PatientAddress='$address', DOB='$date' WHERE PatientID='$res'");
			echo('<p style="color: green">We have updated your name successfully </p>');
    	}
    }
    if(isset($_REQUEST['id']))
		{
		$fn = $_REQUEST['id'];
		$ses_sql=mysql_query("select * from Patient where PatientID='$fn'");
		
/*
		while($image_data = mysql_fetch_array($ses_sql)) 
 {
 
 echo "images/" . $image_data['Image'];
 
 }
*/ 
 		$row_sql=mysql_fetch_array($ses_sql);
		$count_sql = mysql_num_rows($ses_sql);
		
		$s=$row_sql['Image'];
//    echo $row_sql['Image'];

   echo '<img src="data:image/jpeg;base64,'.base64_encode( $s ).'" style="width: 128px; height: 128px; margin: 0 auto; display: block;">';
   
	// 	echo($res);
		
		?>
		
		<div id="form">
		<form method="post" enctype="multipart/form-data">
		<input type="text" name="fName" value=<?php echo($row_sql['PatientFName'])?>>
		<label>Last Name:</label>
		<input type="text" name="lName" value=<?php echo($row_sql['PatientLName'])?>></br>
		<label>Address:</label>
		<input type="text" name="address" value=<?php echo($row_sql['PatientAddress'])?>>
		<label>Date of birth:</label>
		<input type="date" name="dob" value=<?php echo($row_sql['DOB'])?>></br>
		<label>Image:</label>
		<input type="file" name="image"></br>
		<input type="submit" name="edit-submit"></br>
		<?php } ?>
	</div>
</body>
</html>