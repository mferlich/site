<?php 
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works 
require_once("session.php"); // INCLUDES SESSION INFORMATION
 ?>
<?php 
  #ESTABLISHES DB CONNECTION AND INCLUDES VARIOUS GLOBAL FUNCTION
  verify_login(); #VERIFIES USER IS LOGGED IN
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }

  #GETS THE ROW COUNTER READY FOR A NEW SEARCH
  $query0 = "SET @row_number=0";
  $mysqli ->query($query0);

#GET RECORD INFO IF COMING FROM RESULTS PAGE
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

#GET RECORD INFO FOR NEXT RESULT 
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
  	$result = $_POST["result"];
  }

#get record info for previous result
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
  	$result = $_POST["result"];
  }

#get record info after making an edit to a record
  if (isset($_POST["submitEdit"])){

    #MAKES CHANGES TO TEMPORARY SEARCH RESULTS TABLE
    $newNote = htmlspecialchars($_POST["note"], ENT_QUOTES); #REPLACES QUOTES WITH HTML ENTITIES SO THAT THE ANNOTATION WILL BE UPDATED
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

    #MAKES CHANGES PERMANENT
    $query = "UPDATE genbios set gender ='".$_POST["gender"]."'";
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

    #GETS RECORD WITH NEW CHANGES
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

<!-- BEGIN HTML -->
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo "Record ID: ".$ID."; First Name: ".$firstName."; Last Name: ".$lastName; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
  <body>
  <div class="forscreen">
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

  echo '<form action = "results.php" method ="post" id= "prev-result" style="margin-right: 190px">';
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
            echo '<input type="submit" name="edit" value="Edit This Record" style="font-size: larger; padding: 0px 100px 0px 100px;">';
            echo '</form>';
          }
          ?>
      </div>
      <div class="card">
        <h2 class = "card-title"><a href="javascript:PrintTextareaContent('idtextareafield','printing_div_id')">Annotation</a></h2>
        <textarea id= "idtextareafield" readonly> <?php echo $note; ?></textarea><br />
        <?php
        $query1 = "SELECT modified_date FROM versions where recordId=".$ID;
        $result1 = $mysqli->query($query1);
        if ($result1 && $result1 ->num_rows >0){

        echo '<form action = "compare.php" method= "post" id="version-page" style= "padding: 20px 20px 0px 20px;">';
         echo '<input type="hidden" name="id" value='.$ID.'>';
         $note = htmlspecialchars($note, ENT_QUOTES);
         echo '<input type="hidden" name="note" value="'.$note.'">';
         echo '<input type="hidden" name="currentModDate" value='.$modDate.'>';
         echo '<input type="submit" name="compare" value="Compare Versions" style="font-size: larger; padding: 0px 100px 0px 100px;">';
         echo "</form>";

         echo '<form action = "version.php" method= "post" id="version-page" style= "padding: 20px;">';
         echo '<input type="hidden" name="id" value='.$ID.'>';
         $note = htmlspecialchars($note, ENT_QUOTES);
         echo '<input type="hidden" name="note" value="'.$note.'">';
         echo '<input type="hidden" name="currentModDate" value='.$modDate.'>';
         echo '<input type="submit" name="versions" value="View Past Versions" style="font-size: larger; padding: 0px 100px 0px 95px;">';
         echo "</form>";
       }
       else{}
         ?>
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
    </div>
    <div id="printing_div_id" class="forprinting" style="white-space:pre-line;"></div>
    <script type="text/javascript">
    function PrintTextareaContent(textarea_field,printing_div) {
    document.getElementById(printing_div).innerHTML = document.getElementById(textarea_field).value;
    print();
    }
    </script>

  </body>
  </html>