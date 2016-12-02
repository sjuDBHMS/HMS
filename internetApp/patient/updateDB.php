<?php
#include_once '../dbconnect.php';
require 'database.php';


    $fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$dateOfBearth = $_POST['dateOfBearth'];
	$address = $_POST['address'];
	$oldphone1=trim($_POST['oldphone1']);
	$phone1 = trim($_POST['phone1']);
	
	$oldphone2=trim($_POST['oldphone2']);
	$phone2 = trim($_POST['phone2']);

	$pass = md5($_POST['password']);
	
			
	$ID=$_POST['ID'];

	

	if(!empty($fName) && !empty($lName) && !empty($dateOfBearth) && !empty($address)) 
	{
	$query1="UPDATE patient set PatientFName='$fName', PatientLName='$lName', DOB='$dateOfBearth', PatientAddress='$address' where PatientID=$ID";
	$db->exec($query1);
			
	}		
	
	if(!empty($phone1)){
	$query2="UPDATE patient_phone set Phone='$phone1' where PatientID=$ID And Phone='$oldphone1'";
	$db->exec($query2);	
	}
	
	
	if(!empty($phone2))
	{
	$query3="UPDATE patient_phone set Phone='$phone2' where PatientID=$ID And Phone='$oldphone2'";
	$db->exec($query3);
	}
	if(!empty($pass))
	{
	$query4="UPDATE logindetails set Password='$pass' where ID=$ID";
	$db->exec($query4);
		
	}
	
	
	


	header("Location: myprofile.php");
	
	
?>