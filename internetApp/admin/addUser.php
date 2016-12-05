<?php
include_once '../dbconnect.php';
include_once 'adminHeader.php';
?>
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  function validateForm() {
    var fName = document.forms["addUserForm"]["fName"].value;
    var lName = document.forms["addUserForm"]["lName"].value;
    var address = document.forms["addUserForm"]["address"].value;
    var userType = document.forms["addUserForm"]["userType"].value;
    var department = document.forms["addUserForm"]["department"].value;
    if(fName.trim()==""){
	    document.getElementById("fNameError").innerHTML = "&#9754; Error: Enter First Name!";
        document.getElementById("fName").focus();
        return false;
    }
    else{document.getElementById("fNameError").innerHTML = "&#10003;";}
    
    if(lName.trim()==""){
	    document.getElementById("lNameError").innerHTML = "&#9754; Error: Enter Last Name!";
        document.getElementById("lName").focus();
        return false;
    }
    else{document.getElementById("lNameError").innerHTML = "&#10003;";}
    
    if(address.trim()==""){
	    document.getElementById("addressError").innerHTML = "&#9754; Error: Enter Address!";
        document.getElementById("address").focus();
        return false;
    }
    else{document.getElementById("addressError").innerHTML = "&#10003;";}
       
    if(userType=="00"){
	    document.getElementById("userTypeError").innerHTML = "&#9754; Error: select user type!";
        document.getElementById("userType").focus();
        return false;
    }
    else{document.getElementById("userTypeError").innerHTML = "&#10003;";}
    
    if(department=="00"){
	    document.getElementById("departmentError").innerHTML = "&#9754; Error: select user Department!";
        document.getElementById("department").focus();
        return false;
    }
    else{document.getElementById("departmentError").innerHTML = "&#10003;";}
}
  </script>
<?php
if (isset($_REQUEST['createUser'])) {
    createUser();
    unset($_REQUEST['createUser']);
}
function createUser()
{	
	$fName= $_REQUEST['fName'];
	$lName= $_REQUEST['lName'];
	$address= $_REQUEST['address'];
	$userType= $_REQUEST['userType'];
	$department= $_REQUEST['department'];
	$today= date("Y-m-d");
	$query="INSERT INTO employee( EmpFName, EmpLName, StartDate, EmpAddress, EmpType, DeptID) VALUES ('$fName', '$lName', '$today', '$address', '$userType', '$department')";
	$result = mysql_query($query);	
	$EmpID= mysql_insert_id();
	$pass = md5($EmpID);
	mysql_query("INSERT INTO LoginDetails(ID, Password, Type) VALUES('$EmpID','$pass','$userType')");
	echo '<script type="text/javascript">'; 
	echo 'alert("User Successfully created with ID: '.$EmpID.' ");'; 
	echo 'window.location.href = "addUser.php";';
	echo '</script>';
}
  ?>
</head>
<body  bgcolor="#f2f2f2">
<h1 style="text-align:center">Add user</h1>
<div id="login-form" style="margin-left:40%;">
<form name="addUserForm" id="addUserForm" onsubmit="return validateForm()" method="post" action="addUser.php">
First Name:
<input type="text" style="margin-left:2em;" id="fName" name="fName" placeholder="User First Name"  /><span id="fNameError"></span><br>

Last Name:
<input style="margin-left:2em;" type="text" id="lName" name="lName" placeholder="User Last Name" /><span id="lNameError"></span><br>

Address:
<input style="margin-left:3.75em;" type="text" id="address" name="address" placeholder="User Address"  /><span id="addressError"></span><br>

User Type:
<select style="margin-left:3em;" name="userType" id="userType" size="1">
	<option value="00">User Type</option>
    <option value="Admin">Admin</option>
    <option value="Doctor">Doctor</option>
    <option value="recep">Receptionist</option>
</select><span id="IDError"></span><span id="userTypeError"></span><br><br>

Department:
<select style="margin-left:2em;" id="department" name="department">
<option value="00">Department</option>
<?php
$sql=mysql_query("SELECT * FROM department");
if(mysql_num_rows($sql))
while($rs=mysql_fetch_array($sql))
      echo '<option value="'.$rs['DeptId'].'">'.$rs['DeptName'].'</option>';
?>
</select><span id="departmentError"></span><br><br>
<input type="submit" name="createUser">
</form>
</div>
</body>
</html>