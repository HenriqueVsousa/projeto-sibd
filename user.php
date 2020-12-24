<?php
  ob_start();
  session_start();
  require_once ('db_connection.php');
	require_once ('footler_auxfunc.php');

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

        <?php
  			if(isset($_SESSION['newusername'])){
  				echo "New identity set with sucess";
  				unset($_SESSION['newusername']);
  			}
        if(isset($_SESSION['sameusername'])){
  				echo "Thats already your username duh";
  				unset($_SESSION['sameusername']);
  			}
				if(isset($_SESSION['errornewusername'])){
					echo "Username is already in existence";
					unset($_SESSION['errornewusername']);
				}
        if(isset($_SESSION['errorpw'])){
          echo "That's not your password";
          unset($_SESSION['errorpw']);
        }
  			?>

        <form action="footler_user.php" method="POST">
              <input type="username" class="inf" id="user-new" name="user-new" placeholder="your new username" required/>
              <input type="password" class="inf" id="pw-now" name="pw-now" placeholder="your password to verify identity" required/>
              <input type="submit" class="sel" name="submit" value="change my username">

        </form>


      </div>

      <div class="email_box">
        <h1>EMAIL </h1>

        <?php
        if(isset($_SESSION['pwerror'])){
          echo "That's not your password";
          unset($_SESSION['pwerror']);
        }
        if(isset($_SESSION['emailnowerror'])){
          echo "That isn't your current email";
          unset($_SESSION['emailnowerror']);
        }
        if(isset($_SESSION['emailsame'])){
          echo "That's already your email duh";
          unset($_SESSION['emailsame']);
        }
        if(isset($_SESSION['emailerror'])){
          echo "Email is already in existence";
          unset($_SESSION['emailerror']);
        }
        if(isset($_SESSION['newemail'])){
          echo "New identity set with sucess";
          unset($_SESSION['newemail']);
        }
        ?>

          <form action="footler_user.php" method="POST">
            <input type="email" class="inf" id="email-now" name="email-now" placeholder="your actual email" required/>
            <input type="email" class="inf" id="email-new" name="email-new" placeholder="your new email" required/>
            <input type="password" class="inf" id="pw" name="pw" placeholder="your password to verify identity" required/>

            <input type="submit" class="sel" name="submit" value="change my email">
          </form>
      </div>

      <div class="pw_box">
        <h1>PASSWORD CHANGE</h1>

        <?php
        if(isset($_SESSION['nowpwerror'])){
          echo "That isn't your password";
          unset($_SESSION['nowpwerror']);
        }
        if(isset($_SESSION['newpwmatcherror'])){
          echo "New passwords aren't matching";
          unset($_SESSION['newpwmatcherror']);
        }
        if(isset($_SESSION['allpwsame'])){
          echo "You aren't changing anything :)";
          unset($_SESSION['allpwsame']);
        }
        if(isset($_SESSION['newpw'])){
          echo "New password set with sucess";
          unset($_SESSION['newpw']);
        }
        ?>

        <form action="footler_user.php" method="POST">
    	        <input type="password" class="inf" id="pw-now" name="pw-now" placeholder="your actual password" required/>
              <input type="password" class="inf" id="pw-new1" name="pw-new1" placeholder="your new password" required/>
              <input type="password" class="inf" id="pw-new2" name="pw-new2" placeholder="repeat it" required/>

    	        <input type="submit" class="sel" name="submit" value="change my pw">
    	  </form>
        <form action="delete-account.php" method="get">
        <div class="delete-button">
          <p>
            <button id="delete" value="Delete your account">
              <span id="text">Delete your account</span>
            </button>
          </p>

          <div class="delete-confirmation">
            <p>Are you sure?</p>
          </div>
        </div>
      </form>



  </body>
</html>
