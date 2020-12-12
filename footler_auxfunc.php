<?php

function getallthemes($user) {
  global $conn;
  $aux = $conn->prepare('SELECT theme.name FROM theme join map on theme.map_name=map.name WHERE map.usr = ? ');
  $aux->execute(array($user));
  return $aux->fetchAll();
}

function getdata(){
  date_default_timezone_set('Portugal');
  return date('Y-m-d');
}
function getmapname(){
  global $conn;
  $query="SELECT name FROM user JOIN map ON map.usr=user.username WHERE user.username='".$_SESSION['account-username']."'";
  $mapquery=$conn->query($query);
  $mapresult=$mapquery->fetchAll();
  return $mapresult[0]['name'];
}
function getlocation(){
  global $conn;
  $query="SELECT user.location FROM user WHERE user.username='".$_SESSION['account-username']."'";
  $locationquery=$conn->query($query);
  $locationresult=$locationquery->fetchAll();
  return $locationresult[0]['location'];
}







?>
