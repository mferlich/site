<!-- <! This is the Home Page for the Geneva Consistory>
<!Includes the session functions> -->
<?php require_once("session.php"); ?>
<?php 
  #establishes DB connection and includes various global functions
  verify_login();
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }

?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Geneva Consistory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  <body>
    <div class="main-nav">
        <ul class="nav">
          <li class="name">Ole Miss Geneva Consistory</li>
          <li><a href="#">Home</a></li>
          <?php
          if($_SESSION["userlevel"]==3){
          echo "<li><a href='addLogin.php'>Add User</a></li>";
          } 
          ?>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="#">Contact Support</a></li>
        </ul>
    </div>

    <header>
      <h1 class="tag name">Welcome to the Geneva Consistory!</h1>
    </header>

    <main class="flex">
      <div class="card">
        <h2 class="card-title"><a href = "search.php">Record View</a></h2>
        <p>Click here to view records</p>
      </div> 

      <div class="card">
        <h2 class = "card-title"><a href = "prefs.html">Preferences</a></h2>
        <p>Click here to update your preferences</p> 
      </div> 

    </main>
    <footer>
      <ul>
        <li><a href="http://olemiss.edu" target="_blank" class="social olemiss"> Ole Miss</a></li>
      </ul>
      <p class="copyright">Copyright 2018, Ole Miss</p>
    </footer>
  </body>
  </html>