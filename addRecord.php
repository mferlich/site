<?php 
#THIS PAGE ALLOWS USERS TO ADD NEW RECORDS TO THE DATABASE
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works 
require_once("session.php");
 ?>
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
  <title>Add a Record</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  <body>
    <div class="main-nav">
        <ul class="nav">
          <li><a  class="name" href = "home.php">Ole Miss Geneva Consistory</li>
          <li><a href="home.php">Home</a></li>
          <?php
          if($_SESSION["userlevel"]==3){
          echo "<li><a href='addLogin.php'>Add User</a></li>";
          } 
          ?>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="search.php">Search</a></li>
        </ul>
     </div>

 	<main class="flex" style="padding-top:0px;">
      <div class="card">
        <h2 class="card-title"><?php echo "New Record"; ?></h2>
        <h2>General Information:<h2>
        <ul>
        <?php
        echo '<form action = "addRecordConfirm.php" name = "new-record" method ="post" id= "new-record">';
        echo '<li style="font-weight:normal">First Name:
            <input type="text" name="firstname" value="">
          </li>';
          echo '<li style="font-weight:normal">Last Name:
            <input type="text" name="lastname" value="">
          </li>';
          echo '<li style="font-weight:normal">Nickname:
            <input type="text" name="nickname" value="">
          </li>';
          echo '<li style="font-weight:normal">Gender:
            <input type="text" name="gender" value="">
          </li>';
          echo '<li style="font-weight:normal">Occupation:
            <input type="text" name="occupation" value="">
          </li>';
          echo '<li style="font-weight:normal">Birth:
            <input type="text" name="birthday" value="">
          </li>';
          echo '<li style="font-weight:normal">Death:
            <input type="text" name="deathday" value="">
          </li>';
          echo '<li style="font-weight:normal">Origin:
            <input type="text" name="origin" value="">
          </li>';
          echo '<li style="font-weight:normal">Residence:
            <input type="text" name="residence" value="">
          </li>';
          echo '<li style="font-weight:normal">Spouse:
            <input type="text" name="spouse" value="">
          </li>';
          echo '<li style="font-weight:normal">Parents:
            <input type="text" name="parents" value="">
          </li>';
          echo '<li style="font-weight:normal">Children:
            <input type="text" name="children" value="">
          </li>';
          echo '<li style="font-weight:normal">Other Relatives:
            <input type="text" name="relatives" value="">
          </li></ul>';
          echo '<input type="submit" name="createRecord" value="Create Record" style="font-size: larger; padding: 0px 100px 0px 100px; color: red; margin-left: 35px;">';
          ?>
          </ul>
          </div>
          <div class="card">
        <h2 class = "card-title">Annotation</h2>
        <textarea name= "note" form='new-record'> <?php
         echo "</textarea>";
         echo '</form>';
         ?>
      </div> 
    </main>

    </body>
    </html>