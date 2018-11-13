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



<!DOCTYPE html>
<html>
<body>
<title>
	<?php
	echo $ID.": ".$firstName." ".$lastName;
	?>
</title>
<h1>Showing record <?php echo $thisRow; ?> out of <?php echo $count;?></h1>
<h2><?php echo $ID.": ".$firstName." ".$lastName."'s Record"; ?></h2>
<h2>Next Record:</h2>
	<?php
	echo '<form action = "person.php" method ="post" id= "next-result">';
	echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
	echo '<input type="hidden" name="count" value='.$count.'>';
	echo '<input type="submit" name="next" value="Next">';
	echo '</form>';
	?>

<h2>Previous Record:</h2>
	<?php
	echo '<form action = "person.php" method ="post" id= "prev-result">';
	echo '<input type="hidden" name="thisRow" value='.$row["rn"].'>';
	echo '<input type="hidden" name="count" value='.$count.'>';
	echo '<input type="submit" name="prev" value="Previous">';
	echo '</form>';
	?>
<h2>Back to results:</h2>

	<?php
	echo '<form action = "results.php" method ="post" id= "prev-result">';
	echo '<input type="submit" name="Back to Results" value=Back To Results>';
	echo '</form>';
	?>


</body>
</html>