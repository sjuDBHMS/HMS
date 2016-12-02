
<?php 

$appointment_id=$_POST['appointment_id'];
require_once('database.php');
#echo $appointment_id;
try {
$query="DELETE FROM appointment where ApptID='$appointment_id'";

$db->exec($query);

		header("Location: myappointments.php");

	
}
catch(PDOException $e)
{
echo $sql . "<br>" . $e->getMessage();
}  
?>





