<?php
	if(!file_exists('db/db.db')) {
		echo "ERROR: Database file not found.";
		exit;
	} else {
		$conn = new PDO('sqlite:db/db.db');
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
?>
