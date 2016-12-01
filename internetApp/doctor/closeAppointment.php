<html>
<?php
include_once '../dbconnect.php';
$res = $_SESSION['doctor'];
if (isset($_REQUEST['closeAppointment'])) {
    closeAppointment();
    unset($_REQUEST['closeAppointment']);
}
function closeAppointment()
{
	$Prescription= $_REQUEST['Prescription'];
	$ApptID=  $_REQUEST['ApptID'];
	echo "success";
	$query="UPDATE Appointment SET ApptStatus='closed', Prescription='$Prescription' WHERE ApptID=$ApptID";
	$result = mysql_query($query);	
echo '<script type="text/javascript">',
     'parent.jQuery.colorbox.close();',
     'alert("Appointment Closed")</script>';

}
?>
<script>

</script>
<h2> Prescreption</h2>
<form method="post" action="closeAppointment.php">
<textarea rows="10" cols="50" name="Prescription"></textarea>
<input type="hidden" name="ApptID" value= <?php echo $_GET['ApptID']; ?> ><br>
<input type="submit" value= "Prescribe and Close" style="width: 30%;" name="closeAppointment" />
</form>
</html>