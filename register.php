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
		/*if($page_messages){ temporario-->estava me a dar warning
			foreach($page_messages as $txt){
				echo "<p>".$txt."</p>";
			}
		}*/
		?>

		<!--acrescentar oninput="return passwordValidation(this.value)" tanto para o user/mail e password como tinha antes no launchcom script e tal -->
				<form action="reg_footler.php" method="POST">
		        <input type="input" class="inf" id="username" name="username" placeholder="Username" required/>
						<input type="email" class="inf" id="email" name="email" placeholder="Email" required/>
		        <input type="password" class="inf" id="password" name="password" placeholder="Password"  required/>
            <input type="input" class="inf" id="space-name" name="space-name" placeholder="Space name" required/>
		        <input type="text" class="inf" id="location" name="location" placeholder="Location(Optional)">

		        <input type="submit" name="submit" class="sel" class="sel" value="Welcome Aboard">
		        <input type="button" class="sel" value="Back to Login" onclick="window.location='index.php';">
		    </form>
	</div>
</body>
</html>
