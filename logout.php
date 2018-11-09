<?php require_once("session.php"); ?>
<?php 
	require_once("includedFunctions.php");
	verify_login();
	new_header("Who's Who Login", ""); 
	$mysqli = db_connection();

if(!isset($_SESSION["user_id"])) {
	$_SESSION["message"] = "You must login in first!";
	redirect_to("index.php");
}
if (($output = message()) !== null) {
	echo $output;
}
/////////////////////////////////////////////////////////////////////////////////////////
// Step 10.  Kill the session by setting the username and admin_id to null
$_SESSION["username"] = NULL;
$_SESSION["user_id"] = NULL;

////////////////////////////////////////////////////////////////////////////////////////


 redirect_to("index.php");
 new_footer("Who's Who", $mysqli);
  ?>