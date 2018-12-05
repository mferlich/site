<?php require_once("session.php"); ?>
<?php 
	require_once("includedFunctions.php");
	
	$mysqli = db_connection();

	if (($output = message()) !== null) {
		echo $output;
	}

#delete login
	
$ID = $_GET["id"];
$query = "DELETE FROM users ";
$query .= "WHERE user_id = ".$ID;
$result = $mysqli->query($query);
if($result) {
$_SESSION["message"] = "User deleted";
}
else {
$_SESSION["message"] = "Unable to delete user";
}


	redirect_to("addLogin.php");	
?>