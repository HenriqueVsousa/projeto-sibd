<?php
	ob_start();
	session_start();
	require_once ('db_connection.php');

	if( isset($_POST['submit']) ){

		$url = trim($_POST['url']);
		$theme = strtolower(trim($_POST['theme']));
		$username = $_SESSION['account-username'];

		/*$note ="SELECT count(*) FROM site join map on site.map_name=map.name left join theme on site.theme_name=theme.name WHERE map.usr ='".$_SESSION['account-username']."'";
		$site_query=$conn->query($note);
		$site_result=$site_query->fetchAll();*/

		$theme_query = $conn -> prepare('SELECT count(*) FROM theme join map on theme.map_name=map.name WHERE map.usr = ? and theme.name = ? LIMIT 1');
		$theme_query->execute(array($username,$theme));
		$theme_result = $theme_query->fetchAll();

		$site_query = $conn -> prepare("SELECT count(*) FROM site join map on site.map_name=map.name left join theme on site.theme_name=theme.name WHERE map.usr ='$username'");
		$site_query->execute();
		$site_result = $site_query->fetchAll();

		if( isset($site_result[0]['url']) ){
			$_SESSION['website-error'] = true;
			header("Location: home.php");
		}
		else if( isset($theme_result[0]['theme']) ){
			$_SESSION['theme-error'] = true;
			header("Location: home.php");
		}
		else {
			$insert_website=$conn->prepare('INSERT INTO site VALUES(?,?,?)');
			$insert_website->execute(array($url,$theme,$mapname));

			$_SESSION['website-added']=true;
			header("Location: home.php");
		}
	}
?>
