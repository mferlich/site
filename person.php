<?php 
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

  $query0 = "SET @row_number=0";
  $mysqli ->query($query0);

  if (isset($_POST["submit"])){
  	$query = "SELECT * FROM result WHERE id = ".$_POST["submit"];
  	$result = $mysqli->query($query);
  	$row= $result -> fetch_assoc();
  	$ID = $row["id"];
  	$firstName= $row["firstname"];
  	$lastName= $row["lastname"];
  	$nickName= $row["nickname"];
  	$gender= $row["gender"];
  	$job= $row["occupation"];
  	$spouse= $row["spouse"];
  	$parents= $row["parents"];
  	$children= $row["children"];
  	$relative= $row["relations"];
  	$birthDay= $row["birthdate"];
  	$deathDay= $row["deathdate"];
  	$origin= $row["origin"];
  	$residence= $row["residence"];
  	$modedBy= $row["modified_by"];
  	$modDate= $row["modified_date"];
  	$note = $row["annotation"];
  	$count = $_POST["count"];
  	$thisRow = $_POST["thisRow"];
  	$field = $_POST["field"];
  	$name = $_POST["prevSearch"];
  	$result = $_POST["result"];
  }

  if (isset($_POST["next"])){
  	$query = "SELECT * FROM result WHERE rn = ".$_POST["thisRow"]."+1";
  	$result = $mysqli->query($query);
  	$row= $result -> fetch_assoc();
  	echo $thisRow;
  	$ID = $row["id"];
  	$firstName= $row["firstname"];
  	$lastName= $row["lastname"];
  	$nickName= $row["nickname"];
  	$gender= $row["gender"];
  	$job= $row["occupation"];
  	$spouse= $row["spouse"];
  	$parents= $row["parents"];
  	$children= $row["children"];
  	$relative= $row["relations"];
  	$birthDay= $row["birthdate"];
  	$deathDay= $row["deathdate"];
  	$origin= $row["origin"];
  	$residence= $row["residence"];
  	$modedBy= $row["modified_by"];
  	$modDate= $row["modified_date"];
  	$note = $row["annotation"];
  	$thisRow = $_POST["thisRow"]+1;
  	$count = $_POST["count"];
  	// $field = $_POST["ogField"];
  	// $name = $_POST["ogSearch"];
  	$result = $_POST["result"];
  }

  if (isset($_POST["prev"])){
  	$query = "SELECT * FROM result WHERE rn = ".$_POST["thisRow"]."-1";
  	$result = $mysqli->query($query);
  	$row= $result -> fetch_assoc();
  	echo $thisRow;
  	$ID = $row["id"];
  	$firstName= $row["firstname"];
  	$lastName= $row["lastname"];
  	$nickName= $row["nickname"];
  	$gender= $row["gender"];
  	$job= $row["occupation"];
  	$spouse= $row["spouse"];
  	$parents= $row["parents"];
  	$children= $row["children"];
  	$relative= $row["relations"];
  	$birthDay= $row["birthdate"];
  	$deathDay= $row["deathdate"];
  	$origin= $row["origin"];
  	$residence= $row["residence"];
  	$modedBy= $row["modified_by"];
  	$modDate= $row["modified_date"];
  	$note = $row["annotation"];
  	$thisRow = $_POST["thisRow"]-1;
  	$count = $_POST["count"];
  	// $field = $_POST["ogField"];
  	// $name = $_POST["ogSearch"];
  	$result = $_POST["result"];
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
          <li><a  class="name" href = "results.php">Back To Results</li>
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

    <main class="flex">
      <div class="card">
        <h2 class="card-title"><?php echo "Record ID: ".$ID; ?></h2>
        <h2>General Information:<h2>
        <ul>
          <?php
          echo "<li style='font-weight:normal'>First Name:
            <input type='text' name='fname' value=".$firstName.">
          </li>";
          echo '<li style="font-weight:normal">Last Name:
            <input type="text" name="lname" value="'.$lastName.'">
          </li>';
          echo '<li style="font-weight:normal">Occupation:
            <input type="text" name="fname" value="'.$job.'">
          </li>';
          echo '<li style="font-weight:normal">Birth:
            <input type="text" name="fname" value="'.$birthDay.'">
          </li>';
          echo '<li style="font-weight:normal">Death:
            <input type="text" name="fname" value="'.$deathDay.'">
          </li>';
          echo '<li style="font-weight:normal">Origin:
            <input type="text" name="fname" value="'.$origin.'">
          </li>';
          echo '<li style="font-weight:normal">Residence:
            <input type="text" name="fname" value="'.$residence.'">
          </li>';
          echo '<li style="font-weight:normal">Spouse:
            <input type="text" name="fname" value="'.$spouse.'">
          </li>';
          echo '<li style="font-weight:normal">Parents:
            <input type="text" name="fname" value="'.$parents.'">
          </li>';
          echo '<li style="font-weight:normal">Children:
            <input type="text" name="fname" value="'.$children.'">
          </li>';
          echo '<li style="font-weight:normal">Other Relatives:
            <input type="text" name="fname" value="'.$relative.'">
          </li>';

          ?> 
        </ul>
      </div>
      <div class="card">
        <h2 class = "card-title">Annotation</h2>
        <textarea> <?php echo $note; ?></textarea>
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