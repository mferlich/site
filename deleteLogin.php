<?php require_once("session.php"); ?>
<?php 
	require_once("includedFunctions.php");
	
	new_header("Here is Who's who!", ""); 
	$mysqli = db_connection();
///////////////////////////////////////////////////////////////////////////////////
//  Step 9  -  invoke verify_login
//				Will redirect to index.php if there is not a SESSION admin_id set


///////////////////////////////////////////////////////////////////////////////////

	if (($output = message()) !== null) {
		echo $output;
	}
///////////////////////////////////////////////////////////////////////////////////
// Step 5.  Get this admins ID and delete from the database
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

// Execute query

//////////////////////////////////////////////////////////////////////////////////




	redirect_to("addLogin.php");	
?>