<?php
  ob_start();
  session_start();
?>

<html>
  <head>
    <meta charset="utf-8">
    <link href="css/user-style.css" rel="stylesheet"></link>
  </head>
  <body>
    <h2 id="user-header">User space</h2>
    <div class="boxes">
      <form action="checkbox-form.php" method="post">
        <div class="reminder-box">
          <label>Show reminder tab</label>
          <input type="checkbox" name="reminder-checkbox" value="yes">
        </div>
        <div class="graph-box">
          <label>show graph tab</label>
          <input type="checkbox" name="graph-checkbox" value="yes">
        </div>
      <div>
    </form>
  </body>
</html>
