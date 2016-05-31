<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_staff_signed_in() ?>
<?php
$current_performance = find_performance_by_id($_GET["performance"]);
if (!$current_performance) {
	// performance ID was missing or invalid or
	// performance couldn't be found in database
	redirect_to("manage_content.php");
}

$id = $current_performance["performance_id"];
$query = "DELETE FROM Performance WHERE performance_id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
	// Success
	$_SESSION["message"] = "Performance deleted.";
	redirect_to("manage_content.php");
} else {
	// Failure
	$_SESSION["errors"] = "Performance deletion failed.";
	redirect_to("manage_content.php?performance={$id}");
}
?>
