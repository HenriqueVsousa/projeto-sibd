<?php
	ob_start();
	session_start();
?>
<html>

	<video poster="visual/black.png" id="video" playsinline autoplay muted loop>
	<source src="visual/Electron-Stage-Separation.mp4" type="video/mp4">
	</video>

	<head>
	  <meta charset="utf-8">
	  <title>Fav Launch</title>
	  <link href="css/styles_common.css" rel="stylesheet">
	  <link href="css/styles_log_reg.css" rel="stylesheet">
	</head>

	<body>
	  <div class="login_box">
	    <h1>SPACE IS THE PLACE</h1>

			<?php
			if(isset($_SESSION['account-created'])){
				echo "Sucess";
				unset($_SESSION['account-created']);
			}
				if(isset($_SESSION['ERROR'])){
					echo "Invalid username or password";
					unset($_SESSION['ERROR']);
				}
			?>

		  <form action="footler_login.php" method="POST">
		        <input type="input" class="inf" id="username" name="username" placeholder="Username" required/>
		        <input type="password" class="inf" id="password" name="password" placeholder="Password" required/>

		        <input type="submit" class="sel" name="submit" value="Lift off">
		        <input type="button" class="sel" name="join" value="Create Account" onclick="window.location='register.php';">
		  </form>

		</div>
	</body>
</html>
