<?php
	ob_start();
	session_start();
	require_once 'db_connection.php';
  require_once ('footler_auxfunc.php');
  $themes = getallthemes($_SESSION['account-username']);
	$mapid = getmapid();
?>

<html>

  <head>
    <meta charset="utf-8">
		<title>Fav Launch</title>
    <link href="css/styles_common.css" rel="stylesheet">
    <link href="css/styles_header.css" rel="stylesheet">
    <link href="css/styles_favurl.css" rel="stylesheet">
  </head>

<body>

<!-- TOP HEADER SECTION -->
		<div class="topnav">
			<input type="submit" class="left" value= "<?= $_SESSION['account-username'] ?>" onclick="window.location='user.php';">
			<input type="button" value="home" onclick="window.location='home.php';">
			<input type="submit" class="right" value="logout" onclick="window.location='footler_logout.php';">
		</div>

<!-- FAV SITES SECTION -->

		<div class="urlbox">

			<div class="bar">
				<?php
				if( isset($_SESSION['theme-url-error']) ){
					echo 'URL already stored into '.$_SESSION['theme-try'].' theme';
					unset($_SESSION['theme-url-error']);}
				if( isset($_SESSION['url-added']) ){
					echo 'URL added to '.$_SESSION['theme-try'].' theme';
					unset($_SESSION['url-added']);}
				if( isset($_SESSION['url-theme-added']) ){
					echo 'URL added to created '.$_SESSION['theme-try'].' theme';
					unset($_SESSION['url-theme-added']);}
				?>
			</div>

			<form action="footler_favurl.php" method="POST">
				<label for="browser">Insert fav url</label>

				<input list="themes" name="theme" id="theme" placeholder="theme name">
					<datalist id="themes">
						<?php foreach ($themes as $theme) { ?>
				     <option value="<?=$theme['name']?>"></option>
            <?php } ?>
					</datalist>
				<input type="url" id="url" name="url" placeholder="url">
        <!--<div class="website-reminder">
					     <textarea name="website" placeholder="Reminder(Optional)"></textarea>
					</div> -->
        <input type="submit" name="submit" id="save-button" value="Save">
			</form>

		</div>



<!--TEST URL TABLE -->
		<table>
			<tr>
				<th>theme</th>
				<th> urls </th>
			</tr>
			<?php foreach ($themes as $theme) { ?>
			<tr>
		    <th> <?=$theme['name']?> </th>
				<th>
				<?php
				$id = getthemeid($theme['name'],$mapid);
				$sites = getallurl($id);
					foreach ($sites as $site){
						echo $site['url'];
						echo "<br>";}
				?>
				</th>
				<?php } ?>
			</tr>

	  </table>

  </body>
</html>
