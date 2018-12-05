<?php 
#THIS PAGE PULLS THE CLICKED ON VERSION FROM THE VERSION.PHP PAGE
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works 
require_once("session.php");
include('cl_DifferenceEngine.php');
 ?>
<?php 
  #establishes DB connection and includes various global functions
  verify_login();
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }
	if(isset($_POST["oldVersion"])){;
	$currentNote = $_POST["note"];
	$currentModDate = $_POST["currentModDate"];
	$query = "SELECT * FROM versions WHERE modified_date ='".$_POST["oldVersion"]."'";
	$result = $mysqli->query($query);
	$row= $result -> fetch_assoc();
	$versionID = $row["versionId"];
    $ID = $row["recordId"];
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
 
  echo '<form action = "results.php" method ="post" id= "prev-result" style="margin-right: 190px">';
  echo '<input type="submit" name="Back to Results" value="Back To Results" style="font-size: larger">';
  echo '</form>';
  echo '<form action = "person.php" method ="post" id= "prev-result" style="margin-right: 150px;">';
  echo  '<input type="button" value="Back to Versions" onclick="history.back()" style= "margin-bottom: 0px; margin-top: 30px;">';
  echo '</form>'; 
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
        </div>
      <div class="card">
        <h2 class = "card-title">Annotation</h2>
        <textarea readonly> <?php echo $note; ?></textarea>
        </div>
   </body>
  </html>