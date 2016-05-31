<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/db_connection.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php require_once("../../includes/validation_functions.php"); ?>
<?php
if(isset($_POST['submit'])) {
	// Process the form
	// validations
	$required_fields = array("username", "password", "full_name");
	validate_presences($required_fields);
	if(empty($errors)) {
		// Attempt Login
		$username  = mysql_prep(trim($_POST["username"]));
		$password  = mysql_prep($_POST["password"]);
		$full_name = mysql_prep(trim($_POST["full_name"]));
		$email 	   = mysql_prep(trim($_POST["email"]));
		$street    = mysql_prep(trim($_POST["street"]));
		$town      = mysql_prep(trim($_POST["town"]));
		$post_code = mysql_prep(trim($_POST["post_code"]));
		$phone     = mysql_prep(trim($_POST["phone"]));
		$query     = "INSERT INTO Customers (
					  username, password, customer_name, email, street, town, post_code, phone_number
					  ) VALUES (
					  '{$username}', '{$password}', '{$full_name}','{$email}', '{$street}', '{$town}', '{$post_code}', '{$phone}')";
		$result    = mysqli_query($connection, $query);
		if($result) {
			$_SESSION["message"] = "Registration compelete!";
			if(isset($_SERVER["HTTP_REFERER"])) {
				redirect_to($_SERVER["HTTP_REFERER"]);
			}
		} else {
			$_SESSION["message"] = "Registration failed!";
			if(isset($_SERVER["HTTP_REFERER"])) {
				redirect_to($_SERVER["HTTP_REFERER"]);
			}
		}
	}
} else {
	$username = "";
}
?>