<?php
	ob_start();
	session_start();
	require_once ('db_connection.php');
	require_once ('footler_auxfunc.php');
	global $conn;
	$userid = getuserID();
	$mapid = getmapid();
	$nthemes = getnumbthemes($userid);

	if( isset($_POST['submit']) ){

		$username = $_SESSION['account-username'];

		$url = trim($_POST['url']);

		//caso tema venha empty procura se theme_default esta stored
		if(!($_POST['theme']) ) {
			$theme = 'theme_default';
			$theme_query = $conn -> prepare('SELECT count(*) FROM theme JOIN map ON theme.map_id=map.id WHERE map.usr = ? and theme.name = ?');
			$theme_query->execute(array($userid,$theme));
			$theme_result = $theme_query->fetchColumn();
			//encontrou tema = theme_default
			if($theme_result == 1){
				$themeid = getthemeid($theme,$mapid);
				$toAddTheme = FALSE;
			}
			else {
				$toAddTheme = TRUE;
			}
		}

		//caso contratio procura-se se ja existe algum tema com esse nome
		if( $_POST['theme'] ){
			$theme = strtolower(trim($_POST['theme']));
			$theme_query = $conn -> prepare('SELECT count(*) FROM theme JOIN map ON theme.map_id=map.id WHERE map.id = ? and theme.name = ?');
			$theme_query->execute(array($mapid,$theme));
			$theme_result = $theme_query->fetchColumn();
			//encontrou tema = $_POST['theme']
			if($theme_result != 0 ){
				$themeid = getthemeid($theme,$mapid);
				$toAddTheme = FALSE;
			}else {
				$toAddTheme = TRUE;
			}
		}

		//procura dentro do tema a inserir se o url já existe
		$site_query = $conn -> prepare('SELECT count(*) FROM site JOIN theme ON site.theme_id=theme.id JOIN map ON theme.map_id=map.id WHERE site.url = ? AND theme.id = ? AND map.id = ?');
		$site_query->execute(array($url,$themeid,$mapid));
		$site_result = $site_query->fetchColumn();
		if($site_result != 0){
			$toAddSite = FALSE;
		}else {
			$toAddSite = TRUE;
		}

		//URL IS ALREADY STORED INTO $THEME
		if( $toAddTheme == FALSE && $toAddSite == FALSE ){
			$_SESSION['theme-url-error'] = true;
			$_SESSION['theme-try'] = $theme;
			header("Location: map.php");
		}
		//URL IS ADDED TO ALREADY STORED THEME
		else if( $toAddTheme == FALSE && $toAddSite == TRUE ){
			$insert_url=$conn->prepare('INSERT INTO site(url,theme_id) VALUES(?,?)');
			$insert_url->execute(array($url,$themeid));

			$_SESSION['url-added']=true;
			$_SESSION['theme-try'] = $theme;
			header("Location: map.php");
		}

		//THEME ADD AND URL ADD TO THE THEME
		if($nthemes == 9 ){
			$_SESSION['theme-limit'] = TRUE;
			$_SESSION['aux'] = $nthemes;
			header("Location: map.php");
		}
		else if( $toAddTheme == TRUE && $toAddSite == TRUE ){
			$insert_theme=$conn->prepare('INSERT INTO theme(name,map_id) VALUES(?,?)');
			$insert_theme->execute(array($theme,$mapid));

			$newnthemes = $nthemes + 1 ;
			$update_theme_number=$conn->prepare('UPDATE map SET theme_number = ? where map.id = ?');
			$update_theme_number->execute(array($newnthemes,$mapid));

			$themeid = getthemeid($theme,$mapid);
			$insert_url=$conn->prepare('INSERT INTO site(url,theme_id) VALUES(?,?)');
			$insert_url->execute(array($url,$themeid));

			$_SESSION['theme-try'] = $theme;
			$_SESSION['url-theme-added']=true;
			header("Location: map.php");
		}
	}
?>
