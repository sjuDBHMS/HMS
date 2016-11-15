<?php
include('session_doctor.php');
if(!isset($_SESSION["message"])){
$message='';
header( "refresh:300;url=../logout.php" );
}else{
$message=$_SESSION["message"];
unset($_SESSION['message']);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userName; ?></title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
</head>

<body>
<h1>Welcome : <i><?php echo $userName; ?></h1>
<div id="docHeader">
	<div id="left">
    <label>Login</label>
    </div>
    <div id="right">
    	<div id="content">
        	<a href="../logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
<p>Hello Doctor</p>
<div id="body">
</div>

</body>
</html>
