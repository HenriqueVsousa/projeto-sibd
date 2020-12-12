<?php
	ob_start();
	session_start();
	require_once 'db_connection.php';

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
