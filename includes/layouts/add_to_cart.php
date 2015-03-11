<?php require_once("../session.php"); ?>
<?php require_once("../db_connection.php"); ?>
<?php require_once("../functions.php"); ?>
<?php confirm_signed_in() ?>
<?php
//if(empty($_SESSION["cart"])) {
//	$_SESSION["cart"] = array();
//}
//array_push($_SESSION["cart"], $_GET["id"]);
//$_SESSION["message"] = "Performance was added to your cart!";
//redirect_to($_SERVER["HTTP_REFERER"]);
?>
<?php
$customer_id    = $_SESSION["customer_id"];
$performance_id = $_GET["performance"];
if(!$performance_id) {
	$_SESSION["errors"] = "No performance was found!";
	if(isset($_SERVER["HTTP_REFERER"])) {
		redirect_to($_SERVER["HTTP_REFERER"]);
	} else {
		redirect_to("customer.php");
	}
} else {
	$query  = "INSERT INTO Cart (customer_id, performance_id) VALUES ({$customer_id}, {$performance_id})";
	$result = mysqli_query($connection, $query);
	if($result) {
		// Success
		$_SESSION["message"] = "Performance was added to your cart!";
		if(isset($_SERVER["HTTP_REFERER"])) {
			redirect_to($_SERVER["HTTP_REFERER"]);
		} else {
			redirect_to("customer.php");
		}
	} else {
		// Failure
		$_SESSION["errors"] = "Could not add performance to your cart!";
		if(isset($_SERVER["HTTP_REFERER"])) {
			redirect_to($_SERVER["HTTP_REFERER"]);
		} else {
			redirect_to("customer.php");
		}
	}
}
?>
