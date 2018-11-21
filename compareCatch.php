<?php 
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
  if(isset($_POST["oldCompare"])){
  $currentNote = $_POST["note"];
  $currentModDate = $_POST["currentModDate"];
  $query = "SELECT * FROM versions WHERE modified_date ='".$_POST["oldCompare"]."'";
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
 <main>
  <?php 
  $content = '<table style="margin: 0px 100px 0px 100px; text-align:center;">
    <th><td style= "width: 50%; font-weight: bold;">Older Version: '.$modDate.'</td></th><th><td style="font-weight:bold;">Current Version: '.$currentModDate.'</td></th>';
      // $content .='<tr><td class="colHeader">NOTES<br /> <span class="helpNote">Shows only <strong>lines that have changed</strong> with 2 additional lines for context.</span></td><td colspan="2"><table>';
        $oa = explode( "\n", str_replace( "\r\n", "\n", $note) );
        $ca = explode( "\n", str_replace( "\r\n", "\n", $currentNote) );
        $diffs = new Diff( $oa, $ca );
        $formatter = new TableDiffFormatter();
        $content .= $formatter->format( $diffs );
        $content .= "</td></tr></table>";
    $#content .= "</table>";
    $content = '<div class="versionCompare"> ' . $content . '</div>';
    echo $content;
  ?>   
  </main>
   </body>
  </html>
