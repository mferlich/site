<!-- Includes the session functions> -->
<?php require_once("session.php"); ?>
<?php 
  #THIS PAGE CONFIRMS PASSWORD CHANGES
  #establishes DB connection and includes various global functions
  verify_login();
  require_once("includedFunctions.php"); 
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }



$username = $_SESSION["username"];
$oldPass = $_POST["oldPassword"];
$newPass = $_POST["newPassword"];
$newPass2 = $_POST["newPassword2"];

if($newPass == $newPass2){
	 $query = "SELECT * FROM ";
	 $query .= "users WHERE ";
	 $query .= "username = '".$username."' ";
	 $query .= "LIMIT 1";
	 $result = $mysqli->query($query);
}
else{
	$_SESSION["message"] = "New password did not match";
	redirect_to("home.php");
}

if ($result && $result->num_rows > 0) {
 $row = $result->fetch_assoc();}
if (password_check($oldPass, $row["password"])) {
 	$password = password_encrypt($newPass);
 	$query = "UPDATE users ";
	$query .= "SET password ='".$password."'";
	$query .= " WHERE username = '".$_SESSION["username"]."'";
	$result = $mysqli->query($query);
	if ($result) {
	$_SESSION["message"] = "Password successfully changed";
	redirect_to("home.php");
	}
	else {
	$_SESSION["message"] = "Could not change password";
	redirect_to("addLogin.php");
	}
 }


?>