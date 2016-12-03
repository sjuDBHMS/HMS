<?php
session_start();
include_once '../dbconnect.php';
include_once 'adminHeader.php';
$EmpID = $_SESSION['admin'];

?>
<link rel="stylesheet" href="../style.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'login.php';
    }
    i.innerHTML = parseInt(i.innerHTML)-1;
}
setInterval(function(){ countdown(); },1000);
</script>
<style>
	#form {
	position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    }
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../style.css" type="text/css" />
<title>Welcome - <?php echo $_SESSION['EmpFName']; ?></title>
<script>
function validateForm() {
    var EmpFName = document.forms["editProfileForm"]["EmpFName"].value;
    var EmpLName = document.forms["editProfileForm"]["EmpLName"].value;
    var EmpAddress = document.forms["editProfileForm"]["EmpAddress"].value;
    if( EmpFName== ""){
        document.getElementById("EmpFNameError").innerHTML = "&#9754; First name cannot be blank";
        document.getElementById("EmpFName").focus();
        return false;
    }else{
        document.getElementById("EmpFNameError").innerHTML = "&#10003;";
	}
	
	if( EmpLName== ""){
        document.getElementById("EmpLNameError").innerHTML = "&#9754; Last name cannot be blank";
        document.getElementById("EmpLName").focus();
        return false;
    }else{
        document.getElementById("EmpLNameError").innerHTML = "&#10003;";
	}
	
    if( EmpAddress== ""){
        document.getElementById("EmpAddressError").innerHTML = "&#9754; Address name cannot be blank";
        document.getElementById("EmpAddress").focus();
        return false;
    }else{
        document.getElementById("EmpAddressError").innerHTML = "&#10003;";
	}
	
}
</script>
</head>

<body bgcolor="#f2f2f2">
<?php
	if (isset($_REQUEST['updateProfile'])) {
		updateProfile();
	    unset($_REQUEST['updateProfile']);
	}
function updateProfile()
{
	$maxsize = 10000000;
	$EmpFName=  $_REQUEST['EmpFName'];
	$EmpLName=  $_REQUEST['EmpLName'];
	$EmpAddress= $_REQUEST['EmpAddress'];
	$EmpID= $_REQUEST['EmpID'];
	$flag="Not updated";
	//check associated error code
    if($_FILES['image']['error']==UPLOAD_ERR_OK) {
        //check whether file is uploaded with HTTP POST
        if(is_uploaded_file($_FILES['image']['tmp_name'])) {    
            //checks size of uploaded image on server side
            if( $_FILES['image']['size'] < $maxsize) {  
               //checks whether uploaded file is of image type
              //if(strpos(mime_content_type($_FILES['image']['tmp_name']),"image")===0) {
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['image']['tmp_name']),"image")===0) {    
                    // prepare the image for insertion
                    $imgData =addslashes (file_get_contents($_FILES['image']['tmp_name']));
                    $sql = "update Employee set EmpFName='$EmpFName', EmpLName='$EmpLName', EmpAddress='$EmpAddress', Image='{$imgData}' WHERE EmpID='$EmpID'";
                    // insert the image
                    mysql_query($sql) or die("Error in Query: " . mysql_error());
                    $message='<p>Profile and Image successfully updated </p>';
                    $flag="updated";
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
             else {
                // if the file is not less than the maximum allowed, print an error
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['image']['name'].' is '.$_FILES['image']['size'].
                ' bytes</div><hr />';
                }
        }
        else
            $msg="File not uploaded successfully.";

    }
    else {
            mysql_query( "update Employee set EmpFName='$EmpFName', EmpLName='$EmpLName', EmpAddress='$EmpAddress' WHERE EmpID='$EmpID'");
			$message = "Your profile has been successfully updated ";
			$flag="updated";	
    }
    if($flag=="Not updated"){
	    echo '<center><h2 style="color: red;font-family:verdana;margin-top:30px;"> '.$msg.'</h2></center>';
    }else{
    	echo '<center><h2 style="color: green;font-family:verdana;margin-top:30px;"> '.$message.'</h2>';
    	echo '<p>You will be redirected in <span id="counter">5</span> second(s).</p></center>';
		echo "<script>setTimeout(\"location.href = 'admin.php';\",5000);</script>";
    }
	

}
	$ses_sql=mysql_query("select * from Employee where EmpID='$EmpID'");
	$row_sql=mysql_fetch_array($ses_sql);
	$count_sql = mysql_num_rows($ses_sql);
	
		?>
		<div id="profileImage">
			<img src="data:image/png;base64, <?php echo base64_encode($row_sql['Image']) ?>",width=175 height=200/>
		</div>
		<div id="form">
		<form name="editProfileForm" enctype="multipart/form-data" onsubmit="return validateForm()"  method="post" action="editProfile.php">
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
		</div>
</body>
</html>