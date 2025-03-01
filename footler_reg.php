<?php
	ob_start();
	session_start();
	require_once 'db_connection.php';
	require_once ('footler_auxfunc.php');

	if( isset($_POST['submit'] ) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['spacename']) ){

		$cleanedUsername = strtolower(strip_tags(trim($_POST['username'])));
		$cleanedEmail = strip_tags(trim($_POST['email']));
		$cleanedPassword = strip_tags(trim($_POST['password']));
		$cleanedLocation = strip_tags(trim($_POST['location']));
		$cleanedSpaceName = $_POST['spacename'];

		$sql1 = "SELECT COUNT(*) FROM user WHERE lower(username) = '$cleanedUsername'";
		$checkuser = $conn -> query($sql1);
		$checkuserr = $checkuser->fetchColumn();

		$sql2 = "SELECT COUNT(*) FROM user WHERE email = '$cleanedEmail'";
		$checkemail = $conn -> query($sql2);
		$checkemaill = $checkemail->fetchColumn();

		/*ERROR MESSAGES CHECK FOR SAME USERNAME/EMAIL*/
		if ($checkuserr && $checkemaill ) {
			$_SESSION['USEREMAIL']= TRUE;
			header("Location: register.php");
		}
		else if ($checkuserr ) {
			$_SESSION['USER']= TRUE;
			header("Location: register.php");
		}
		else if ($checkemaill ) {
			$_SESSION['EMAIL']= TRUE;
			header("Location: register.php");
		}
		else {
			$create_account = $conn -> prepare('INSERT INTO user(username,email,password,location) VALUES (? , ? , ? , ?)');
			$create_map = $conn -> prepare('INSERT INTO map(name,usr,theme_number) VALUES (?,?,?)');
			$zero = 0;
			/*INSERT IN USER TABLE*/
			$create_account -> execute(array($cleanedUsername,$cleanedEmail,sha1($cleanedPassword),$cleanedLocation));

			/*INSERT IN MAP TABLE*/
		 	$newid = getuserID($cleanedUsername);// nao incrementa um pois neste momento o novo user ja esta na tabela com o valor de id mais alto que corresponde ao numero de users
			$create_map -> execute(array($cleanedSpaceName,$newid,$zero));

			$_SESSION['account-created'] = true;
			header("Location: index.php");
		}
	}
?>
