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

  if (isset($_POST["versions"])){
    $currentNote = $_POST["note"];
    $currentModDate = $_POST["currentModDate"];
    $query = "SELECT * FROM versions WHERE recordId = ".$_POST["id"];
    $result = $mysqli->query($query);
    $row= $result -> fetch_assoc();
    $versionID = $row["versionId"];
    $ID = $_POST["id"];
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
      <?php
      echo '<form action = "person.php" method ="post" id= "prev-result" style="margin-right: 150px;">';
      echo  '<input type="button" value="Back to Record" onclick="history.back()" style= "margin-bottom: 0px; margin-top: 30px;">';
      echo '</form>'; 
      ?>
      </div>
<main class="flex">
      <div class="card" style="margin-top:0px;">
        <h2 class="card-title"><?php echo "Versions for ID: ".$ID; ?></h2>
        <ol>
          <?php
          if($result && $result ->num_rows >0){
            while($row = $result -> fetch_assoc()){
              echo '<form action="versionCatch.php" method= "post" id="next-version">';
              echo "<li>";
              echo '<input type="hidden" name="note" value="'.htmlspecialchars($currentNote).'">';
              echo '<input type="hidden" name="currentModDate" value='.$currentModDate.'>';
              echo '<input type="submit" name="oldVersion" value="'.$row["modified_date"].'" style="font-size: large;">';
              echo "</li>"; 
              echo "</form>";
            }
          }
          ?>          
        </ol>
      </div>
  </header>
  </main>
   <div class = "button-container">
      <?php
      echo '<form action = "person.php" method ="post" id= "prev-result" style="margin-right: 150px">';
      echo  '<input type="button" value="Back to Record" onclick="history.back()">';
      echo '</form>'; 
      ?>
      </div>
</html>

