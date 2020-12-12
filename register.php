<html >
<head>
  <meta charset="utf-8">
  <title>Fav Lanch</title>
  <!-- <link href="css/styles_common.css" rel="stylesheet"> -->
  <link href="css/styles_log_reg.css" rel="stylesheet">
</head>

<!--<video poster="visual/black.png" id="video" playsinline autoplay muted loop>
<source src="visual/launchpad.mp4" type="video/mp4">
</video> -->

<body>
  <div class="register_box">
    <h1 >PREPARE YOUR LAUNCH</h1>

		<?php
		if(isset($_SESSION['USER'])){
		    echo 'Enter another username';
		    unset($_SESSION['USER']);
		}
		if(isset($_SESSION['EMAIL'])){
		    echo 'Enter another email';
		    unset($_SESSION['EMAIL']);
		}
		if(isset($_SESSION['USEREMAIL'])){
		    echo 'Enter another username and email';
		    unset($_SESSION['USEREMAIL']);
		}
		?>

		<!--acrescentar oninput="return passwordValidation(this.value)" tanto para o user/mail e password como tinha antes no launchcom script e tal -->
			<form action="reg_footler.php" method="POST">
		        <input type="input" class="inf" id="username" name="username" placeholder="Username" required/>
				<input type="email" class="inf" id="email" name="email" placeholder="Email" required/>
		        <input type="password" class="inf" id="password" name="password" placeholder="Password"  required/>
           	 	<input type="input" class="inf" id="space-name" name="space-name" placeholder="Space name" required/>
		        <input type="input" class="inf" id="location" name="location" placeholder="Location(Optional)">

		        <input type="submit" name="submit" class="sel" class="sel" value="Welcome Aboard">
		        <input type="button" class="sel" value="Back to Login" onclick="window.location='index.php';">
		    </form>
	</div>
</body>
</html>
