<?php
  ob_start();
  session_start();
  require_once ('db_connection.php');
  require_once ('footler_auxfunc.php');
  global $conn;
  $userid=getUserID();

  //se não apresentar nome então vai ser atribuído o nome "Nota"
  if(!($_POST['reminder-description'])){
    $_SESSION['desc-error'] = true;
    header("location: map.php");
  }else{
    if(!($_POST['reminder-name'])){
      $reminder_name="Nota";
    }else{
      $reminder_name=$_POST['reminder-name'];
    }
    $reminder_description=$_POST['reminder-description'];
  }

  if($_POST['reminder-date']< date("Y-m-d")){
    $_SESSION['date-error'] = true;
    header("location: map.php");
  }else{
    $time=$_POST['reminder-date'];
    $create_reminder=$conn->prepare('INSERT INTO reminder (name,note,tme,usr) VALUES (?,?,?,?)');
    $create_reminder->execute(array($reminder_name, $reminder_description,$time,getuserID()));
    $_SESSION['add'] = true;
    $_SESSION['add-name'] = $reminder_name;
    header("location: map.php");
  }
?>
