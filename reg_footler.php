<?php
	ob_start();
	if(!isset($_SESSION))
 {
		 session_start();
 }
	require_once 'db_connection.php';
	$page_messages = Array();

	if( isset($_POST['submit'] ) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['space-name'])){

		$cleanedUsername = strtolower(strip_tags(trim($_POST['username'])));
		$cleanedEmail = strip_tags(trim($_POST['email']));
		$cleanedPassword = strip_tags(trim($_POST['password']));
		$cleanedLocation = strip_tags(trim($_POST['location']));
		$cleanedspacename=strip_tags(trim($_POST['space-name']));
		$_SESSION['space-name']=$cleanedspacename;

		$sql1 = "SELECT COUNT(*) FROM user WHERE lower(username) = '$cleanedUsername'";
		$checkusername = $conn -> query($sql1);

		$sql2 = "SELECT COUNT(*) FROM user WHERE email = '$cleanedEmail'";
		$checkemail = $conn -> query($sql2);

			if ($checkusername->fetchColumn() || $checkemail->fetchColumn()  ) {
				array_push($page_messages, "ERROR: That username/email currently exists.");
				header("Location: register.php");
			}else {
				$create_account = $conn -> prepare('INSERT INTO user VALUES (? , ? , ? , ?)');
				$create_account -> execute(array($cleanedUsername,$cleanedEmail,sha1($cleanedPassword),$cleanedLocation));
				$create_map=$conn->prepare('INSERT INTO map VALUES(?,?)');
				$create_map->execute(array($cleanedspacename,$cleanedUsername));
				$_SESSION['account-created'] = true;
				header("Location: index.php");
			}
		}
?>
