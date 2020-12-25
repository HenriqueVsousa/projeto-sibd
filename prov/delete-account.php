<?php
  ob_start();
  session_start();
	require_once ('db_connection.php');
    $userquery="DELETE FROM user WHERE user.username='".$_SESSION['account-username']."'";
    $userresult=$conn->query($userquery);
    header("Location:index.php");
?>
