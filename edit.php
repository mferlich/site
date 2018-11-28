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

 if (isset($_POST["edit"])){
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

 	<main class="flex" style="padding-top:0px;">
      <div class="card">
        <h2 class="card-title"><?php echo "Record ID: ".$ID; ?></h2>
        <h2>General Information:<h2>
        <ul>
        <?php
        echo '<form action = "person.php" name = "edit-page" method ="post" id= "edit-page">';
        echo '<li style="font-weight:normal">First Name:
            <input type="text" name="fname" value="'.$firstName.'">
          </li>';
          echo '<li style="font-weight:normal">Last Name:
            <input type="text" name="lname" value="'.$lastName.'">
          </li>';
          echo '<li style="font-weight:normal">Nickname:
            <input type="text" name="nickname" value="'.$nickName.'">
          </li>';
          echo '<li style="font-weight:normal">Gender:
            <input type="text" name="gender" value="'.$gender.'">
          </li>';
          echo '<li style="font-weight:normal">Occupation:
            <input type="text" name="occupation" value="'.$job.'">
          </li>';
          echo '<li style="font-weight:normal">Birth:
            <input type="text" name="birthday" value="'.$birthDay.'">
          </li>';
          echo '<li style="font-weight:normal">Death:
            <input type="text" name="deathday" value="'.$deathDay.'">
          </li>';
          echo '<li style="font-weight:normal">Origin:
            <input type="text" name="origin" value="'.$origin.'">
          </li>';
          echo '<li style="font-weight:normal">Residence:
            <input type="text" name="residence" value="'.$residence.'">
          </li>';
          echo '<li style="font-weight:normal">Spouse:
            <input type="text" name="spouse" value="'.$spouse.'">
          </li>';
          echo '<li style="font-weight:normal">Parents:
            <input type="text" name="parents" value="'.$parents.'">
          </li>';
          echo '<li style="font-weight:normal">Children:
            <input type="text" name="children" value="'.$children.'">
          </li>';
          echo '<li style="font-weight:normal">Other Relatives:
            <input type="text" name="relatives" value="'.$relative.'">
          </li></ul>';
          echo '<input type="hidden" name="id" value='.$ID.'>';
          echo '<input type="hidden" name="count" value='.$count.'>';
          echo '<input type="hidden" name="rowNum" value='.$rowNum.'>';
          echo '<input type="submit" name="submitEdit" value="Confirm Changes" style="font-size: larger; padding: 0px 100px 0px 100px; color: red;">';
          ?>
          </ul>
          </div>
          <div class="card">
        <h2 class = "card-title">Annotation</h2>
        <textarea name= "note" form='edit-page'> <?php
         echo $note;
         echo "</textarea>";
         echo '</form>';
         ?>
      </div> 
    </main>

    </body>
    </html>