
<!-- Includes the session functions> -->
<?php require_once("session.php"); ?>
<?php 
  #THIS PAGE ALLOWS USERS TO CHANGE THEIR PASSWORDS
  #establishes DB connection and includes various global functions
  verify_login();
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <title>Your Preferences</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  </head>
  <body>
  <div class="main-nav">
        <ul class="nav">
          <li class="name">Ole Miss Geneva Consistory</li>
          <li><a href="home.php">Home</a></li>
          <?php
          if($_SESSION["userlevel"]==3){
          echo "<li><a href='addLogin.php'>Add User</a></li>";
          } 
          ?>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="search.php">Search</a></li>
          <li><a href="#">Contact Support</a></li>
        </ul>
    </div>

     <header style = "min-height: 0px; background:none;">
    </header>


    <h1>Preferences</h1>
    <h2 class="section-title">Change your preferences below</h2>

     <main class="flex">
      <div class="card">
        <h2 class="section-title">Account Information</h2>
        <p>Username: <?php echo $_SESSION["username"];?></p>
        <p>Userlevel: <?php echo $_SESSION["userlevel"];
        if($_SESSION["userlevel"]==0){
          echo "<br>Read Only Privileges";
        }
        else{
          echo "<br>Admin User";
        }
        ?></p>
        <p></p>

      </div> 

      <div class="card">
        <h2 class = "section-title">Change Password</h2>
        <form action = "changePassword.php" method= "post">
        <p>Current:  <input type="password" name="oldPassword" value="" style="width:50%; margin-left: 40px;" /> </p>
        <p>New:  <input type="password" name="newPassword" value="" style="width:50%; margin-left: 60px;" /> </p>
        <p>Confirm New:  <input type="password" name="newPassword2" value="" style="width:50%" /> </p> 
        <input type="submit" name="changePass" value="Change Password" style="width: 200px; font-size:larger;" />
        </form>
      </div> 
    </main>
  </body>
</html>