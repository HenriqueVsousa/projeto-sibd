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
		$checkuser = $conn -> query($sql1);
		$checkuserr=$checkuser->fetchColumn();

		$sql2 = "SELECT COUNT(*) FROM user WHERE email = '$cleanedEmail'";
		$checkemail = $conn -> query($sql2);
		$checkemaill = $checkemail->fetchColumn();

		if ($checkuserr || $checkemaill) {
		        $_SESSION['USEREMAIL']= TRUE;
				header("Location: register.php");
			}
		else if($checkuserr){
			    $_SESSION['USER']= TRUE;
			    header("Location: register.php");
			}
		else if ($checkemaill ) {
			    $_SESSION['EMAIL']= TRUE;
			    header("Location: register.php");
			}
		else {
		    
		    $create_account = $conn -> prepare('INSERT INTO user VALUES (? , ? , ? , ?)');
		    $create_map = $conn -> prepare('INSERT INTO map VALUES (?,?)');
		    
		    /*INSERT IN USER TABLE*/
		    $create_account -> execute(array($cleanedUsername,$cleanedEmail,sha1($cleanedPassword),$cleanedLocation));
		    $_SESSION['account-created'] = true;
		    
		    /*INSERT IN MAP TABLE*/
		    $create_map -> execute(array($cleanedspacename,$cleanedUsername)); 
		    header("Location: index.php");
			}
		}
?>
