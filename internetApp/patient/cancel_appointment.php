
<?php 

$appointment_id=$_POST['appointment_id'];
require_once('database.php');
#echo $appointment_id;
try {
$query="DELETE FROM Appointment where ApptID='$appointment_id'";

$db->exec($query);

	
	

	
}
catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}  


		header("Location: myappointments.php");

?>





