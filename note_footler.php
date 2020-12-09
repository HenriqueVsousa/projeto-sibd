<?php
	ob_start();
	session_start();
	/*require_once 'reg_footler.php';*/
	require_once 'db_connection.php';
	$page_messages=Array();
	if(isset($_POST['website'])){
		$note ="SELECT count(*) FROM site join map on site.map_name=map.name left join theme on site.theme_name=theme.name WHERE map.usr ='".$_SESSION['account-username']."'";
		$site_query=$conn->query($note);
		$site_result=$site_query->fetchAll();
		if(isset($site_result[0]['url'])){
		/*if($site_query->fetchColumn()){*/
			array_push($page_messages,"Website already exists in user map.");
		}else{
		$url_text=trim($_POST['url']);
		$theme_text=trim($_POST['theme']);
		$insert_website=$conn->prepare('INSERT INTO site VALUES(?,?,?)');
		$insert_website->execute(array($url_text,$theme_text,$_SESSION['space-name']));
		$_SESSION['website added']=true;
		header("Location: home.php");
		}
	}
  if(isset($_POST['reminder'])){
		$note = "SELECT COUNT(*) FROM reminder";
		$note_id = $conn->query($note);
		$note_id_count = $note_id->fetchColumn();
    $reminderText = $_POST['reminder'];

    $insert_note = $conn->prepare( 'INSERT INTO reminder VALUES(? , ? , ?)');
    $insert_note->execute(array(++$note_id_count,"nota",$reminderText));
    $_SESSION['note-added'] = true;
    header("Location: home.php");
  }
?>
