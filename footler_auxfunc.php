<?php
function getuserID(){
  global $conn;
  $query="SELECT * FROM user WHERE user.username='".$_SESSION['account-username']."'";
  $idquery=$conn->query($query);
  $idresult=$idquery->fetchAll();
  return $idresult[0]['id'];
}
function getnumbusers(){
  global $conn;
  $aux = $conn->prepare('SELECT count(*) FROM user');
  $aux->execute();
  $auxresult = $aux->fetchColumn();
  return $auxresult;
}
function getallthemes($userid) {
  global $conn;
  $aux = $conn->prepare('SELECT theme.name FROM theme join map on theme.map_id=map.id WHERE map.usr = ? ');
  $aux->execute(array($userid));
  return $aux->fetchAll();
}
function getthemeid($theme_name,$mapid){
  global $conn;
  $aux = $conn->prepare('SELECT theme.id FROM theme JOIN map ON theme.map_id=map.id WHERE map.id=? AND theme.name=? ');
  $aux->execute(array($mapid,$theme_name));
  $aix = $aux->fetchAll();
  return $aix[0]['id'];
}
function getallurl($themeid) {
  global $conn;
  $aux = $conn->prepare('SELECT site.url FROM site join theme on site.theme_id=theme.id WHERE theme.id = ? ');
  $aux->execute(array($themeid));
  return $aux->fetchAll();
}
function getmapname($userid){
  global $conn;
  $mapquery = $conn->prepare('SELECT * FROM map JOIN user ON map.usr=user.id WHERE user.id = ?');
  $mapquery->execute(array($userid));
  $mapresult = $mapquery->fetchAll();
  return $mapresult[0]['name'];
}
function getmapid(){
  global $conn;
  $query="SELECT map.id FROM map JOIN user ON map.usr=user.id WHERE user.username='".$_SESSION['account-username']."'";
  $mapquery=$conn->query($query);
  $mapresult=$mapquery->fetchAll();
  return $mapresult[0]['id'];
}
function getlocation(){
  global $conn;
  $query="SELECT user.location FROM user WHERE user.username='".$_SESSION['account-username']."'";
  $locationquery=$conn->query($query);
  $locationresult=$locationquery->fetchAll();
  return $locationresult[0]['location'];
}
function getdata(){
  date_default_timezone_set('Portugal');
  return date('Y-m-d');
}
function getreminders(){
  global $conn;
  $query="SELECT reminder.name, reminder.note FROM reminder JOIN user ON reminder.usr=user.id where user.username='".$_SESSION['account-username']."'";
  $reminderquery=$conn->query($query);
  $reminderresult=$reminderquery->fetchAll();
  return $reminderresult;
}
?>
