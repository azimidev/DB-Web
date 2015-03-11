<?php require_once("../session.php"); ?>
<?php require_once("../db_connection.php"); ?>
<?php require_once("../functions.php"); ?>
<?php confirm_signed_in() ?>
<?php
$booking = find_booking_by_id($_GET["id"]);
if(!$booking) {
	$_SESSION["errors"] = "Could not find booking to cancel!";
	redirect_to($_SERVER["HTTP_REFERER"]);
}
$id     = $booking["booking_id"];
$query  = "DELETE FROM Booking WHERE booking_id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);
if($result && mysqli_affected_rows($connection) == 1) {
	// Success
	$_SESSION["message"] = "Booking was canceled.";
	redirect_to($_SERVER["HTTP_REFERER"]);
} else {
	// Failure
	$_SESSION["errors"] = "Booking cancellation was failed.";
	redirect_to($_SERVER["HTTP_REFERER"]);
}
?>