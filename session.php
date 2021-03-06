<?php
#THIS PAGE ESTABLISHES THE CURRENT USER SESSION AND MAKES SURE THE USER IS LOGGED IN
	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			
			$output = "<div class='row'>";
			$output .= "<div data-alert class='alert-box info round'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
	#makes sure user is a verified user in the database and logged in 
	function verify_login() {
		if(!isset($_SESSION["user_id"])&& $_SESSION["user_id"] === NULL) {
			$_SESSION["message"] = "You must login in first!";
			header("Location: index.php");
			exit;
		}
	}

	
?>