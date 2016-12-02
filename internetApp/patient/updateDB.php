<?php
#include_once '../dbconnect.php';
require 'database.php';


    $fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$dateOfBearth = $_POST['dateOfBearth'];
	$address = $_POST['address'];
	$phone1 = $_POST['phone1'];
	$pass = md5($_POST['pass']);
	
	

	$ID=$_POST['ID'];

	
	echo $ID;
	
	$query="UPDATE patient set PatientFName='$fName', PatientLName='$lName', DOB='$dateOfBearth', PatientAddress='$address' where PatientID=$ID";
	$db->exec($query);
	
	
	$query="UPDATE patient_phone set Phone='$phone1' where PatientID=$ID";
	$db->exec($query);
	



		header("Location: myprofile.php");
	
	
?>