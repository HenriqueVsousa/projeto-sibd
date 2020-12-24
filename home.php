<?php
	ob_start();
	session_start();
	require_once ('db_connection.php');
	require_once ('footler_auxfunc.php');

	if( !isset($_SESSION['account-connected']) ) {
		header("Location: index.php");
		exit;
	}
	$today = getdata();
	$mapname = getmapname(getuserID());
	$locationame = getlocation();
	$mapid = getmapid();
  $themes = getallthemes($mapid);
?>

<html>

	<video poster="visual/black.png" id="video" playsinline autoplay muted loop>
	<source src="visual/Orbit.mp4" type="video/mp4">
	</video>

	<head>
		<meta charset="utf-8">
		<title>Fav Launch</title>
		<link href="css/styles_common.css" rel="stylesheet">
		<link href="css/styles_header.css" rel="stylesheet">
		<link href="css/styles_weather.css" rel="stylesheet">
		<link href="css/styles_mainurl.css" rel="stylesheet">

	</head>

	<body>

<!-- TOP HEADER SECTION -->
		<div class="topnav">
			<input type="submit" class="left" value= "<?= $_SESSION['account-username'] ?>" onclick="window.location='user.php';">
			<input type="button" value="<?=$mapname?>" onclick="window.location='map.php';">
			<input type="submit" class="right" value="logout" onclick="window.location='footler_logout.php';">
		</div>

<!-- REMINDER SECTION
		<form action="footler_note.php" method="POST">
			<div draggable="true" class="sticker1">
				<div class="bar" ></div>
					<input type="checkbox" id="show-note">
					<label for="show-note"></label>
					<!--<button type="submit" id="save-button"><i class="fa fa-floppy-o"></i></button> JAVA
					<button type="submit" id="save-button">Save</button>
					<textarea name="reminder"></textarea>
			</div>
		</form>
-->

<!-- FAV URLS -->
		<div class="urls-box">
			<?php foreach ($themes as $theme) { ?>

				<!-- <div class='theme-box'> -->
						<h1> <?php echo $theme['name'] ?> </h1>
							<?php
							$id = getthemeid($theme['name'],$mapid);
							$sites = getallurl($id);
							foreach ($sites as $site){ ?>

								<a href="<?php echo $site['url'];?>"> <?php echo $site['url'] ?> </a>
								<br>
							<?php } ?>
			<!--	</div> -->

			<?php } ?>
		</div>

<!-- WEATHER SECTION -->
		<div class="weather-box">
			<div class="weather-title-box">
				<span class="weather-title">Weather</span><br>
			</div>
			<div class="time-place">
				<p id="location">Location: <?=$locationame?></p>
				<p id="day">Date: <?=$today?></p>
				<p id="temperature">Temperature:16°C-7°C</p>
				<p id="humidity">Humidity:10%</p>
			</div>
			<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 512 512">
				<path d="M377.139 259.492c0 66.637-54.020 120.658-120.658 120.658-66.637 0-120.658-54.021-120.658-120.658 0-66.637 54.020-120.658 120.658-120.658 66.637 0 120.658 54.020 120.658 120.658z" fill="#FF8C00"/>
				<path d="M228.352 100.669l30.27-77.906 25.979 77.906z" fill="#FF8C00"/>
				<path d="M228.352 411.341l30.27 77.895 25.979-77.895z" fill="#FF8C00"/>
				<path d="M100.659 287.601l-77.895-30.29 77.895-25.959z" fill="#FF8C00"/>
				<path d="M411.361 287.601l77.875-30.29-77.875-25.959z" fill="#FF8C00"/>
				<path d="M126.597 165.703l-33.659-76.472 73.442 36.7z" fill="#FF8C00"/>
				<path d="M346.276 385.423l76.524 33.639-36.741-73.442z" fill="#FF8C00"/>
				<path d="M168.499 388.199l-76.493 33.639 36.72-73.442z" fill="#FF8C00"/>
				<path d="M388.199 168.499l33.618-76.513-73.4 36.751z" fill="#FF8C00"/>
			</svg>
		</div>

	</body>
</html>
