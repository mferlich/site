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

  if (isset($_POST["submitEdit"])){
    $newNote = htmlspecialchars($_POST["note"], ENT_QUOTES);
    $query = "UPDATE result set gender ='".$_POST["gender"]."'";
    $query .= ", firstname='".$_POST["fname"]."'";
    $query .= ", lastname='".$_POST["lname"]."'";
    $query .= ", nickname='".$_POST["nickname"]."'";
    $query .= ", occupation='".$_POST["occupation"]."'";
    $query .= ", spouse='".$_POST["spouse"]."'";
    $query .= ", parents='".$_POST["parents"]."'";
    $query .= ", children='".$_POST["children"]."'";
    $query .= ", relations='".$_POST["relatives"]."'";
    $query .= ", birthdate='".$_POST["birthday"]."'";
    $query .= ", deathdate='".$_POST["deathday"]."'";
    $query .= ", origin='".$_POST["origin"]."'";
    $query .= ", residence='".$_POST["residence"]."'";
    $query .= ", annotation='".$newNote."'";
    $query .=" WHERE id ='".$_POST["id"]."'";
    $mysqli->query($query);
    $query = "SELECT * FROM result WHERE id = ".$_POST["id"];
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
  <header style="min-height: 100px; background:none; padding top: 100px;">
  <div class = "button-container">
  <h2>Record <?php echo $row["rn"]." out of ".$count; ?></h2>
  <?php
  if($row["rn"]== ($count-$count)+1){
  }
  else{
  echo '<form action = "person.php" method ="post" id= "back">';
  echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
  echo '<input type="hidden" name="count" value='.$count.'>';
  echo '<input type="submit" name="prev" value="Previous Record" style="font-size: larger">';
  echo '</form>';
  }

  echo '<form action = "results.php" method ="post" id= "prev-result" style="margin-right: 215px">';
  echo '<input type="submit" name="Back to Results" value="Back To Results" style="font-size: larger">';
  echo '</form>';

  if($row["rn"] == ($count)){
  }
  else{
  echo '<form action = "person.php" method ="post" id= "next-result">';
  echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
  echo '<input type="hidden" name="count" value='.$count.'>';
  echo '<input type="submit" name="next" value="Next Record" style="font-size: larger">';
  echo '</form>';
  }
  ?>
  </div>
  </header>
    <main class="flex" style="padding-top:0px;">
      <div class="card">
        <h2 class="card-title"><?php echo "Record ID: ".$ID; ?></h2>
        <h2>General Information:<h2>
        <ul>
          <?php
          echo '<li style="font-weight:normal; display: inline;">First Name: <h4>'.$firstName.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Last Name: <h4>'.$lastName.'</h4></li><br /><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Nickname: <h4>'.$nickName.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Gender: <h4>'.$gender.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Occupation: <h4>'.$job.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Birth: <h4>'.$birthDay.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Death: <h4>'.$deathDay.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Origin: <h4>'.$origin.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Residence: <h4>'.$residence.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Spouse: <h4>'.$spouse.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Parents: <h4>'.$parents.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Children: <h4>'.$children.'</h4></li><br/><div style="height:10px;font-size:1px;">&nbsp;</div>';
          echo '<li style="font-weight:normal; display: inline;">Other Relatives: <h4>'.$relative.'</h4></li><br/><br />';
          ?> 
        </ul>
        <?php
        if($_SESSION["userlevel"] == 0 || $_SESSION["userlevel"] == 1 || $_SESSION["userlevel"] == 2 ){}
          else{
            echo '<form action = "edit.php" method ="post" id= "edit-page">';
            echo '<input type="hidden" name="id" value='.$ID.'>';
            echo '<input type="hidden" name="count" value='.$count.'>';
            echo '<input type="submit" name="edit" value="Edit This Record" style="font-size: larger; padding: 0px 100px 0px 100px; color: red;">';
            echo '</form>';
          }
          ?>
      </div>
      <div class="card">
        <h2 class = "card-title">Annotation</h2>
        <textarea readonly> <?php echo $note; ?></textarea>
      </div> 
    </main>
    <div class = "button-container">
  <h2>Record <?php echo $row["rn"]." out of ".$count; ?></h2>
  <?php
  if($row["rn"]== ($count-$count)+1){
  }
  else{
  echo '<form action = "person.php" method ="post" id= "back">';
  echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
  echo '<input type="hidden" name="count" value='.$count.'>';
  echo '<input type="submit" name="prev" value="Previous Record" style="font-size: larger">';
  echo '</form>';
  }

  echo '<form action = "results.php" method ="post" id= "prev-result" style="margin-right: 215px">';
  echo '<input type="submit" name="Back to Results" value="Back To Results" style="font-size: larger">';
  echo '</form>';

  if($row["rn"] == ($count)){
  }
  else{
  echo '<form action = "person.php" method ="post" id= "next-result">';
  echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
  echo '<input type="hidden" name="count" value='.$count.'>';
  echo '<input type="submit" name="next" value="Next Record" style="font-size: larger">';
  echo '</form>';
  }
  ?>
  </div>
    <footer>
      <ul>
        <li><a href="http://olemiss.edu" target="_blank" class="social olemiss"> Ole Miss</a></li>
      </ul>
      <p class="copyright">Copyright 2018, Ole Miss</p>
    </footer>
  </body>
  </html>