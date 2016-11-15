<?php

if(!isset($_POST['btn-login'])){
$error='';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
	<center>
	<div id="login-form">
	<?php echo $error; ?>
		<form action="login.php" method="post">
			<table align="center" width="30%" border="0">
			<tr>
				<td><input type="text" name="ID" placeholder="Your ID" required /></td>
			</tr>
			<tr>
				<td><input type="password" name="pass" placeholder="Your Password" required /></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-login">Sign In</button></td>
			</tr>
			<tr>
				<td><a href="register.php">Sign Up Here</a></td>
			</tr>
			</table>
		</form>
	</div>
	</center>
</body>
</html>
