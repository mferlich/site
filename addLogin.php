<?php require_once("session.php"); ?>
<?php 
	require_once("includedFunctions.php");
	verify_login();
	$mysqli = db_connection();
///////////////////////////////////////////////////////////////////////////////////
//				Will redirect to index.php if there is not a SESSION admin_id set


/////////////////////////////////////////////////////////////////////////////////// 

	if (($output = message()) !== null) {
		echo $output;
	}

	  
	  
///////////////////////////////////////////////////////////////////////////////////////////////
//           Check to see if username and password text boxes are filled in.
//           If they are, then first check to see if the username already exists
//           If the user name does not exist, then add the username and their hashed password
//               to the admins table in your database 
if (isset($_POST["submit"])) {
if (isset($_POST["username"]) && $_POST["username"] !== "" &&
isset($_POST["password"]) && $_POST["password"] !== "") {
 //Grab posted values for username and password - encrypt the password
 $username = $_POST["username"];
 $password = password_encrypt($_POST["password"]);
 //Check to make sure user does not already exist
 $query = "SELECT * FROM ";
 $query .= "users WHERE ";
 $query .= "username = '".$username."' ";
 $query .= "LIMIT 1";
$result = $mysqli->query($query);
//User exists so output that the user already exists
if ($result && $result->num_rows > 0) {
$_SESSION["message"] = "The username already exists";
redirect_to("addLogin.php");
}
//User does not already exist so add to admins table
else {
$query = "INSERT INTO users ";
$query .= "(username, password) ";
$query .= "VALUES ('".$username."', '".$password."')";
$result = $mysqli->query($query);
if ($result) {
$_SESSION["message"] = "User successfully added";
redirect_to("index.php");
}
else {
$_SESSION["message"] = "Could not add user!";
redirect_to("addLogin.php");
}
}
}
}


	    //Grab posted values for username and password.  Immediately encrypt the password
		//so that it is set up to compare with the encrypted password in the database
		//Use password_encrypt

		
		
		//Check to make sure user does not already exist by querying database

		
		
		//User exists so output that the user already exists

		
		
		
		//User does not already exist so add to admins table

		
		

			
			
////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!doctype html>
<html lang="en">
		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Add an Admin to view Consistory</h3>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    		Create a form with textboxes for adding both a username and password -->
<form action="addLogin.php" method="post">
 <p>Username:<input type="text" name="username" value="" /> </p>
 <p>Password: <input type="password" name="password" value="" /> </p>
 <input type="submit" name="submit" value="Add Administrator" />
</form>

	
	
	
<!--///////////////////////////////////////////////////////////////////////////////////////////////// -->


			<p><br /><br /><hr />
			<h2>Current Admins</h2>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    		Display current Administrators.  Also provide a link next to each person that allows you to delete -->
<!--            them from your database This requires including their id # in the query string -->
			
<?php
$query = "SELECT * from users";
$result = $mysqli->query($query);
if ($result && $result->num_rows > 0) {
 echo "<table>";
 while($row = $result->fetch_assoc()) {
 echo "<tr>";
 echo "<td>".$row["username"]."</td>";
 echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;
<a href='deleteLogin.php?id=".$row["id"]."'>Delete</a></td>";
 echo "</tr>";
}
echo "</table><hr /><br /><br />";
}
?>	
			
			
			

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
			
  	  <?php echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>"; ?>
			
	</div>
	</label>

<?php  new_footer("Create a Form", $mysqli); ?>