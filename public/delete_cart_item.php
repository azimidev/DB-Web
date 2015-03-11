<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_signed_in() ?>
<?php
$cart = find_cart_by_id($_GET["id"]);
if(!$cart) {
	$_SESSION["errors"] = "Could not find item to delete!";
	redirect_to($_SERVER["HTTP_REFERER"]);
}
$id     = $cart["id"];
$query  = "DELETE FROM Cart WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);
if($result && mysqli_affected_rows($connection) == 1) {
	// Success
	$_SESSION["message"] = "Performance deleted.";
	redirect_to($_SERVER["HTTP_REFERER"]);
} else {
	// Failure
	$_SESSION["errors"] = "Performance deletion failed.";
	redirect_to($_SERVER["HTTP_REFERER"]);
}
?>