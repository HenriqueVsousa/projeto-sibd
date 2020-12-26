<?php
  ob_start();
  session_start();
	require_once ('db_connection.php');

    $reminderquery="DELETE FROM reminder WHERE reminder.note='".$_POST['$reminders']."' AND reminder.usr='".$_SESSION['account-username']."'";
    $reminderresult=$conn->query($reminderquery);
    var_dump($_POST['$reminders']);
    //header("Location:home.php");
?>
