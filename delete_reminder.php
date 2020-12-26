<?php
  ob_start();
  session_start();
	require_once ('db_connection.php');
  require_once ('footler_auxfunc.php');
    $post=$_POST['sequence'];
    $reminder=$_SESSION['reminders'][$post];
    $userid=getuserID();
    $reminderquery="DELETE FROM reminder WHERE reminder.note='".$reminder['note']."' AND reminder.usr='".$userid."'";
    $reminderresult=$conn->query($reminderquery);

    header("Location:home.php");
?>
