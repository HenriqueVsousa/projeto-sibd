<?php
  ob_start();
  session_start();
	require_once ('db_connection.php');
  require_once ('footler_auxfunc.php');

  $userid = getuserID($_SESSION['account-username']);
  $mapid = getmapid($userid);

  switch($_POST['submit']) {
    case 'delete theme 0':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[0]['name'],$mapid);
      break;
    case 'delete theme 1':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[1]['name'],$mapid);
      break;
    case 'delete theme 2':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[2]['name'],$mapid);
      break;
    case 'delete theme 3':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[3]['name'],$mapid);
      break;
    case 'delete theme 4':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[4]['name'],$mapid);
      break;
    case 'delete theme 5':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[5]['name'],$mapid);
      break;
    case 'delete theme 6':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[6]['name'],$mapid);
      break;
    case 'delete theme 7':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[7]['name'],$mapid);
      break;
    case 'delete theme 8':
      $themes = getallthemes($mapid);
      $idtheme = getthemeid($themes[8]['name'],$mapid);
      break;
  }

  //DELETE ALL SITES OFF THEME X
  $aux = $conn->prepare('DELETE FROM site WHERE site.theme_id = ? ');
  $aux->execute(array($idtheme));

  //DELETE THEME X
  $aux = $conn->prepare('DELETE FROM theme WHERE theme.id = ? ');
  $aux->execute(array($idtheme));

  //UPDATE NUMBER OF THEMES IN MAP
  $nownthemes = getnumbthemes($mapid);
  $update_theme_number=$conn->prepare('UPDATE map SET theme_number = ? where map.id = ?');
  $update_theme_number->execute(array($nownthemes,$mapid));

  header("Location:home.php");
?>
