<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_staff_signed_in() ?>

<?php
$current_production = find_production_by_id($_GET["production"]);
if (!$current_production) {
	// production ID was missing or invalid or
	// production couldn't be found in database
	redirect_to("manage_content.php");
}

$performance_set = find_performances_for_production($current_production["production_id"]);
if (mysqli_num_rows($performance_set) > 0) {
	$_SESSION["errors"] = "Can't delete a production with performance.";
	redirect_to("manage_content.php?production={$current_production["production_id"]}");
}

$id = $current_production["production_id"];
$query = "DELETE FROM Production WHERE production_id = {$id} LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
	// Success
	$_SESSION["message"] = "Production deleted.";
	redirect_to("manage_content.php");
} else {
	// Failure
	$_SESSION["errors"] = "Production deletion failed.";
	redirect_to("manage_content.php?production={$id}");
}
?>
