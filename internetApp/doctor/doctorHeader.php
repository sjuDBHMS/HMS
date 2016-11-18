<?php
if(!isset($_SESSION['doctor']))
{
	header("Location: ../login/index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $_SESSION['EmpFName']; ?></title>
<link rel="stylesheet" href="../style.css" type="text/css" />

<div id="docHeader">
	<div id="left">
    <label>Login</label>
    </div>
    <div id="right">
    	<div id="content">
        	Welcome <?php echo $_SESSION['EmpFName']; ?>&nbsp;<a href="../login/logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>
</head>
