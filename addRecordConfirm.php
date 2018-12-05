<?php 
date_default_timezone_set('America/Chicago');
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

  #THIS PAGE CONFIRMS THE RECORD GETS ADDED TO DB BEFORE REDIRECTING BACK TO HOME 

  $date = date('Y-m-d H:i:s', time());
  $newNote = htmlspecialchars($_POST["note"], ENT_QUOTES);

  	$query = "INSERT INTO genbios ";
    $query .= "(firstname, lastname, nickname, gender, occupation, spouse, parents, children, relations, birthdate, deathdate, origin, residence, annotation, modified_date, modified_by) VALUES ";
    $query .= "('".htmlspecialchars($_POST["firstname"], ENT_QUOTES)."', '".htmlspecialchars($_POST["lastname"], ENT_QUOTES)."', '".htmlspecialchars($_POST["nickname"], ENT_QUOTES)."', '".htmlspecialchars($_POST["gender"], ENT_QUOTES)."', '".htmlspecialchars($_POST["occupation"], ENT_QUOTES)."', '".htmlspecialchars($_POST["spouse"], ENT_QUOTES)."', '".htmlspecialchars($_POST["parents"], ENT_QUOTES)."', '".htmlspecialchars($_POST["children"], ENT_QUOTES)."', '".htmlspecialchars($_POST["relatives"], ENT_QUOTES)."', '".htmlspecialchars($_POST["birthday"], ENT_QUOTES)."', '".htmlspecialchars($_POST["deathday"], ENT_QUOTES)."', '".htmlspecialchars($_POST["origin"], ENT_QUOTES)."', '".htmlspecialchars($_POST["residence"], ENT_QUOTES)."', '".$newNote."', '".$date."', '".$_SESSION["username"]."')";

  

$result = $mysqli->query($query);
if($result) {
$_SESSION["message"] = "Record Added!";
}
else {
$_SESSION["message"] = "Unable to Add Record";
}


redirect_to("search.php");
  ?>
