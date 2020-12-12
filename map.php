<?php
	ob_start();
	session_start();
	require_once 'db_connection.php';
  require_once ('footler_auxfunc.php');
  $themes = getallthemes($_SESSION['account-username']);
  echo $themes['name'];
?>

<html>

  <head>
    <meta charset="utf-8">
    <link href="css/styles_common.css" rel="stylesheet">
    <link href="css/styles_header.css" rel="stylesheet">
    <link href="css/styles_reminder2.css" rel="stylesheet">
    <link href="css/styles_favsite.css" rel="stylesheet">
  </head>

<body>

<!-- TOP HEADER SECTION -->
		<div class="topnav">
			<input type="submit" class="left" value= "<?= $_SESSION['account-username'] ?>" onclick="window.location='user-page.php';">
			<input type="button" value="home" onclick="window.location='home.php';">
			<input type="submit" class="right" value="logout" onclick="window.location='footler_logout.php';">
		</div>

<!-- FAV SITES SECTION -->
		<form action="footler_favsite.php" method="POST">
			<div class="sticker2">
				<div class="bar2"></div>

          <label for="theme">Insert your favourite websites</label>
          <datalist id="categoryname">
            <?php foreach ($themes as $themes) { ?>
              <option value="<?=$themes[0]['name']?>"></option>
            <?php } ?>
          </datalist>

					<input type="url" id="url" name="url" placeholder="url">
					<!--
          <div class="website-reminder">
					     <textarea name="website" placeholder="Reminder(Optional)"></textarea>
					</div>
        -->
        <button type="submit" id="save-button2">Save</button>

        <?php
        if(isset($_SESSION['website-error'])){
          echo "Website already exists in this map";
          unset($_SESSION['website-error']);
        }
        if(isset($_SESSION['theme-error'])){
          echo "Theme already exists in this map";
          unset($_SESSION['theme-error']);
        }
        if(isset($_SESSION['website-added'])){
          echo "Website added.";
          unset($_SESSION['website-added']);
        }
        ?>

			</div>
		</form>



  </body>
</html>
