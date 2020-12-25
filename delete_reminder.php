<?php
  ob_start();
  session_start();
	require_once ('db_connection.php');
    echo"<h2>".$_POST['$reminder']."</h2>";
    $reminderquery="DELETE FROM reminder JOIN user on reminder.usr=user.id WHERE reminder.note='".$_POST['$reminder']."'";
    $reminderresult=$conn->query($reminderquery);
    header("Location:home.php");
?>
