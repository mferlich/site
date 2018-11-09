<?php require_once("session.php"); ?>
<?php 
  require_once("includedFunctions.php");
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }

?>
<?php 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Check username and password.  If all is good then set $_SESSION and log in



      //Grab posted values for username and password.  
    //Once we check if the username exists, we will do the encryption in 
    //the function password_check, which returns true if the passwords match
if (isset($_POST["submit"])) {
if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
$_POST["password"] !== "") {
 //Grab posted values for username and password.
 //Once we check if the username exists, we will do the encryption in
 //the function password_check, which returns true if the passwords match

 $username = $_POST["username"];
 $password = $_POST["password"];

 //Check whether the user is in the database
 $query = "SELECT * FROM ";
 $query .= "users WHERE ";
 $query .= "username = '".$username."' ";
 $query .= "LIMIT 1";
 $result = $mysqli->query($query);
 //First check just the Username. If it’s found, then check password
 //If the attempted password matches the database password then set two $_SESSION variables
 //$_SESSION["username"] & $_SESSION[admin_id"]
if ($result && $result->num_rows > 0) {
 $row = $result->fetch_assoc();
 if (password_check($password, $row["password"])) {
$_SESSION["username"] = $row["username"];
$_SESSION["user_id"] = $row["user_id"];
redirect_to("home.php");
 }
//If the attempted password DOES NOT match the database password, output an error 
 else {
$_SESSION["message"] = "Incorrect Username or Password";
redirect_to("index.php");
 }
 } //closes second if-statement
 }
 } //closes first if-statement

///////////////////////////////////////////////////////////////////////////////////////////////////////

?>

<!doctype html>
<html lang="en">
		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Please login to continue to the Consistory</h3>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    		Create a form with textboxes for adding both a username and password -->
<form action="index.php" method="post">
 <p>Username:<input type="text" name="username" value="" /> </p>
 <p>Password: <input type="password" name="password" value="" /> </p>
 <input type="submit" name="submit" value="Login" />
</form>
