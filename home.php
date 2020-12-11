<?php
	ob_start();
	session_start();
	require_once 'db_connection.php';

	if( !isset($_SESSION['account-connected']) ) {
		header("Location: index.php");
		exit;
	}

?>
<html>

	<video poster="visual/black.png" id="video" playsinline autoplay muted loop>
	<source src="visual/Orbit.mp4" type="video/mp4">
	</video>

	<head>
		<meta charset="utf-8">
		<link href="css/styles_header.css" rel="stylesheet">
		<link href="css/styles_reminder2.css" rel="stylesheet">
		<link href="css/styles_favsite.css" rel="stylesheet">
	</head>

	<body>

<!-- TOP HEADER SECTION -->
		<div class="topnav">
			<input type="submit" class="left" value= "<?= $_SESSION['account-username'] ?>" onclick="window.location='user-page.php';">
			<input type="submit" value="<?= $_SESSION['spacename'] ?>" onclick="window.location='map.php';">
			<input type="submit" class="right" value="Logout" onclick="window.location='footler_logout.php';">
		</div>



<!-- REMINDER SECTION -->
		<form action="footler_note.php" method="POST">
			<div draggable="true" class="sticker1">
				<div class="bar" ></div>
					<input type="checkbox" id="show-note">
					<label for="show-note"></label>
					<!--<button type="submit" id="save-button"><i class="fa fa-floppy-o"></i></button> JAVA-->
					<button type="submit" id="save-button">Save</button>
					<textarea name="reminder"></textarea>
			</div>
		</form>

	</body>
</html>
