<?php
  ob_start();
  session_start();
  require_once ('db_connection.php');
	require_once ('footler_auxfunc.php');
  $mapname = getmapname();
?>

<html>

  <head>
    <meta charset="utf-8">
    <title>Fav Launch</title>
    <link href="css/styles_user.css" rel="stylesheet">
    <link href="css/styles_common.css" rel="stylesheet">
    <link href="css/styles_header.css" rel="stylesheet">
  </head>

  <body>

<!-- TOP HEADER SECTION -->
		<div class="topnav">
			<input type="submit" id="user-on" class="left" value= "<?= $_SESSION['account-username'] ?>" onclick="window.location='user.php';">
			<input type="button" value="home" onclick="window.location='home.php';">
			<input type="submit" class="right" value="logout" onclick="window.location='footler_logout.php';">
		</div>


    <div class="user_box">
      <h1>CONFIGURATIONS ROOM</h1>

      <div class="username_box">
        <h1>USERNAME</h1>
        <form action="footler_user.php" method="POST">
              <input type="username" class="inf" id="user-new" name="user-new" placeholder="your new username" required/>


              <input type="password" class="inf" id="pw-now" name="pw-now" placeholder="your password to verify identity" required/>

              <input type="submit" class="sel" name="submit" value="change my username">

        </form>
      </div>

      <div class="email_box">
        <h1>EMAIL </h1>
          <form action="footler_user.php" method="POST">
            <input type="email" class="inf" id="email-now" name="email-now" placeholder="your actual email" required/>
            <input type="email" class="inf" id="email-new" name="email-new" placeholder="your new email" required/>
            <input type="password" class="inf" id="pw-now" name="pw-now" placeholder="your password to verify identity" required/>
            <input type="submit" class="sel" name="submit" value="change my email">
          </form>
      </div>

      <div class="pw_box">
        <h1>PASSWORD CHANGE</h1>
        <form action="footler_user.php" method="POST">
    	        <input type="password" class="inf" id="pw-now1" name="pw-now1" placeholder="your actual password" required/>

              <input type="password" class="inf" id="pw-new1" name="pw-new1" placeholder="your new password" required/>
              <input type="password" class="inf" id="pw-new2" name="pw-new2" placeholder="repeat it" required/>

    	        <input type="submit" class="sel" name="submit" value="change my pw">
    	  </form>
      </div>

    </div>

  </body>
</html>
