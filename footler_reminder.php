<?php
  ob_start();
  session_start();
  require_once ('db_connection.php');
  require_once ('footler_auxfunc.php');
  global $conn;
  $userid=getUserID();
  //se não apresentar nome então vai ser atribuído o nome "Nota"
  if(!($_POST['reminder-name'])){
    $reminder_name="Nota";
  }

?>
