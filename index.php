<?php require_once("session.php"); ?>
<?php 
  require_once("includedFunctions.php");
  $mysqli = db_connection();
  if (($output = message()) !== null) {
    echo $output;
  }

?>
<?php 
#LOGIN PAGE FOR THE WEBSITE
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
$_SESSION["userlevel"] = $row["userlevel"];
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
<html lang="en" style= "background-image: url('images/background.png'); background-size: cover; opacity: 50%; padding: 10px;">
<meta charset="utf-8">
  <title>Geneva Consistory</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/styles.css">
<body style="background: transparent";>
<div>
<form action="index.php" method="post">
<h3 style="color: white;">Please login to continue to the Consistory</h3>
 <p style= "color:white;">Username:  <input type="text" name="username" value="" style="width:10%;" /> </p>
 <p style= "color:white;">Password:  <input type="password" name="password" value="" style="width:10%" /> </p>
 <input type="submit" name="submit" value="Login" style="width: 200px; font-size:larger;" />
</form>
<h3 style= "color: white;">If you want access to the Geneva Consistory Biographical Database, you must apply for access. Please contact Isabella Watt at iwatt@olemiss.edu</h3>
</div>
<main></main>
</body>
</html>