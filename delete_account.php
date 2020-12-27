<?php
  ob_start();
  session_start();
	require_once ('db_connection.php');
  require_once ('footler_auxfunc.php');

  $userid = getuserID($_SESSION['account-username']);
  $nthemes = getnumbthemes($userid);
  $mapid = getmapid($userid);
  $themes = getallthemes($mapid);

  //DELETE ALL URLS FROM EVERY THEME THAT USER HAS
  for ($i = 0; $i < $nthemes; $i++ ) {
    $idtheme = getthemeid($themes[$i]['name'],$mapid);
    $nurl = getnumburl($themeid);
    if($nurl){
      $aux = $conn->prepare('DELETE FROM site WHERE site.theme_id = ? ');
      $aux->execute(array($idtheme));
    }
  }

  //DELETE ALL THEMES THAT USER HAS
  $aux = $conn->prepare('DELETE FROM theme WHERE theme.map_id = ? ');
  $aux->execute(array($mapid));

  //DELETE THE MAP THAT USER HAS
  $aux = $conn->prepare('DELETE FROM map WHERE map.usr = ? ');
  $aux->execute(array($userid));

  //DELETE ALL REMINDERS THAT USER HAS
  $aux = $conn->prepare('DELETE FROM reminder WHERE reminder.usr = ? ');
  $aux->execute(array($userid));

  /*SHOULD SET THE ID BACK WHEN DELETING ALL URLS,THEMES,MAP AND REMINDERS*/

  //DELETE THE USER
  $aux = $conn->prepare('DELETE FROM user WHERE user.id = ?');
  $aux->execute(array($userid));

  header("Location:footler_logout.php");
?>
