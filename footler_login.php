<?php
	ob_start();
	session_start();
	require_once 'db_connection.php';
	$page_messages = Array();

	if( isset($_POST['submit']) ){

		$cleanedUsername = strtolower(strip_tags(trim($_POST['username']))); // Lowercase (strtolower) to make SQL case insensitive.
		$cleanedPassword = strip_tags(trim($_POST['password']));
		global $conn;
		$loginquery = $conn -> prepare("SELECT * FROM user WHERE lower(username) = '$cleanedUsername' LIMIT 1");
		$loginquery->execute();
		$loginresult = $loginquery->fetchAll();

		if(isset($loginresult[0]['username']) && !strcmp( sha1($cleanedPassword), $loginresult[0]['password'])){
			$_SESSION['account-username'] = $loginresult[0]['username'];
			$_SESSION['account-connected'] = true;
			header("Location: home.php");
		}
		else { array_push($page_messages, "Invalid username or password.");
      header("Location: index.php");
    }
	}
?>
