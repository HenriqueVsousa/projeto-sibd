<?php
	ob_start();
	session_start();
	require_once ('db_connection.php');
	require_once ('footler_auxfunc.php');
	$userid = getuserID();
	$nowusername = $_SESSION['account-username'];

  switch($_POST['submit']) {

    case 'change my username':
			//get inputs variables
			$cleanedUsername = strtolower(strip_tags(trim($_POST['user-new'])));
			$cleanedPassword = strip_tags(trim($_POST['pw-now']));

			//get password from database
			$pwquery = $conn -> prepare("SELECT * FROM user WHERE lower(username) = ? LIMIT 1");
			$pwquery->execute(array($nowusername));
			$pwresult = $pwquery->fetchAll();

			//get username from database
			$usernamequery = $conn->prepare("SELECT * FROM user WHERE lower(username) = ? LIMIT 1");
			$usernamequery->execute(array($cleanedUsername));
			$usernameresult = $usernamequery->fetchAll();

			if( !strcmp($usernameresult[0]['username'],$cleanedUsername) ){
				$_SESSION['sameusername']=true;
				header("Location: user.php");
				break;
			}
			if( isset($usernameresult[0]['username']) ) {
				$_SESSION['errornewusername']= true;
				header("Location: user.php");
				break;
			}
			if( strcmp( sha1($cleanedPassword), $pwresult[0]['password'] ) ){
				$_SESSION['errorpw'] = true;
				header("Location: user.php");
				break;
			}
			if( !isset($usernameresult[0]['username']) ){
				$newusernamequery = $conn -> prepare("UPDATE user SET username = ? WHERE id = ?");
				$newusernamequery->execute(array($cleanedUsername,$userid));
				$_SESSION['newusername']=true;
				$_SESSION['account-username'] = $cleanedUsername;
				header("Location: user.php");
				break;
			}

    case 'change my pw':

			$nowpw = strip_tags(trim($_POST['pw-now']));
			$newpw1 = strip_tags(trim($_POST['pw-new1']));
			$newpw2 = strip_tags(trim($_POST['pw-new2']));

			$pwquery = $conn -> prepare("SELECT * FROM user WHERE user.id = ? LIMIT 1");
			$pwquery->execute(array($userid));
			$pwresult = $pwquery->fetchAll();

			if( strcmp(sha1($nowpw) , $pwresult[0]['password']) ){
				$_SESSION['nowpwerror']=true;
				header("Location: user.php");
				break;
			}
			if( strcmp( $newpw1 , $newpw2 ) ){
				$_SESSION['newpwmatcherror']=true;
				header("Location: user.php");
				break;
			}
			if( strcmp( $newpw1 , $newpw2 ) == 0 && strcmp( $nowpw , $newpw1 ) == 0 ){
				$_SESSION['allpwsame']=true;
				header("Location: user.php");
				break;
			}
			else {
				$newpwquery = $conn -> prepare("UPDATE user SET password = ? WHERE id = ?");
				$newpwquery->execute(array(sha1($newpw1),$userid));
				$_SESSION['newpw'] = true;
				header("Location: user.php");
				break;
			}

    case 'change my email':

			$emailnow = strip_tags(trim($_POST['email-now']));
			$emailnew = strip_tags(trim($_POST['email-new']));
			$pw = strip_tags(trim($_POST['pw']));

			$query = $conn -> prepare("SELECT * FROM user WHERE user.id = ? LIMIT 1");
			$query->execute(array($userid));
			$result = $query->fetchAll();

			if( strcmp(sha1($pw) , $result[0]['password']) ){
				$_SESSION['pwerror']=true;
				header("Location: user.php");
				break;
			}

			if( strcmp( $emailnow, $result[0]['email']) ){
				$_SESSION['emailnowerror']=true;
				header("Location: user.php");
				break;
			}

			if( !strcmp( $emailnow, $emailnew )){
				$_SESSION['emailsame']=true;
				header("Location: user.php");
				break;
			}

			$emailquery = "SELECT COUNT(*) FROM user WHERE user.email = '$emailnew'";
			$emailquery = $conn -> query($emailquery);
			$emailresult = $emailquery->fetchColumn();

			if( $emailresult ){
				$_SESSION['emailerror']=true;
				header("Location: user.php");
				break;
			}
			else {
				$newemailquery = $conn -> prepare("UPDATE user SET email = ? WHERE id = ?");
				$newemailquery->execute(array($emailnew,$userid));
				$_SESSION['newemail']=true;
				header("Location: user.php");
				break;
			}
			
	}
?>
