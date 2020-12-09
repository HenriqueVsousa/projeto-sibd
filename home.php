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
		<!-- <link href="css/styles_reminder.css" rel="stylesheet"> -->
		<link href="css/styles_reminder2.css" rel="stylesheet">
		<link href="css/styles_favsite.css" rel="stylesheet">
		<!--<link href="css/styles_favurl.css" rel="stylesheet">-->
	<!--	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
	</head>

	<body>

<!-- TOP HEADER SECTION -->
		<div class="topnav">
			<input type="submit" class="left" value= "<?= $_SESSION['account-username'] ?>" onclick="window.location='user-page.php';">
			<input type="button" class="center" value="<?= $_SESSION['space-name'] ?>" onclick="window.location='graph.php';">
			<input type="submit" class="right" value="Logout" onclick="window.location='index.php';">
		</div>




<!-- reminder
	<ul contenteditable="true">
	  <li>Here is a fairly large bunch of words. If you want, you can edit me! Seriously, try it. Click me and type. It's pretty easy!</li>
	</ul>

reminder classic
 	<div class="note">

			<div class="title">
				<input type="input" class="inf" placeholder="Note" value=""/>

				</div>

			<div class="note-text">
			<textarea name="" id="" rows="10" class="textarea"></textarea>

			</div>
		</div>
-->

<!-- REMINDER SECTION -->
		<form action="footler_note.php" method="POST">
			<div draggable="true" class="sticker1">
				<div class="bar" ></div>
					<input type="checkbox" id="show-note">
					<label for="show-note"></label>
					<!--<button type="submit" id="save-button"><i class="fa fa-floppy-o"></i></button>-->
					<button type="submit" id="save-button">Save</button>
					<textarea name="reminder"></textarea>
			</div>
		</form>
<!-- FAV SITES SECTION -->
		<form action="footler_favsite.php" method="POST">
			<div class="sticker2">
				<div class="bar2"></div>
					<!--<button type="submit" id="save-button"><i class="fa fa-floppy-o"></i></button>-->
					<button type="submit" id="save-button2">Save</button>
					<label>Insert your favourite websites</label>
					<input type="text" id="theme" name="theme" placeholder="theme (optional)">
					<input type="url" id="url" name="url" placeholder="url">
					<div class="website-reminder">
					<textarea name="website" placeholder="Reminder(Optional)"></textarea>
					</div>
			</div>
		</form>






<!-- FAVOURITES SITE SECTION

<div class="container">

  <div class="row">
    <div class="col-md-12">
      <br>
      <button class="btn btn-default pull-right add-row"><i class="fa fa-plus"></i>&nbsp;&nbsp; Add Row</button>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered" id="editableTable">
        <thead>
          <tr>
            <th>Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Sex</th>
            <th>Edit</th>
          </tr>
        </thead>
        <tbody>
          <tr data-id="1">
            <td data-field="name">Dave Gamache</td>
            <td data-field="birthday">May 19, 2015</td>
            <td data-field="age">26</td>
            <td data-field="sex">Male</td>
            <td>
              <a class="button button-small edit" title="Edit">
                <i class="fa fa-pencil"></i>
              </a>

              <a class="button button-small edit" title="Delete">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
          <tr data-id="2">
            <td data-field="name">Dwayne Johnson</td>
            <td data-field="birthday">May 19, 2015</td>
            <td data-field="age">42</td>
            <td data-field="sex">Male</td>
            <td>
              <a class="button button-small edit" title="Edit">
                <i class="fa fa-pencil"></i>
              </a> <a class="button button-small edit" title="Delete">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
          <tr data-id="3">
            <td data-field="name">Halyna Nadia</td>
            <td data-field="birthday">May 25, 2015</td>
            <td data-field="age">22</td>
            <td data-field="sex">Female</td>
            <td>
              <a class="button button-small edit" title="Edit">
                <i class="fa fa-pencil"></i>
              </a> <a class="button button-small" title="Delete">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

-->
	</body>
</html>
