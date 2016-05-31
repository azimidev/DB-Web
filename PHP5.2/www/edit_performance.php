<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_staff_signed_in() ?>
<?php find_selected_performance(); ?>
<?php
// performance ID was missing or invalid or performance couldn't be found in database
if(!$current_performance) {
	redirect_to("manage_content.php");
}
if(isset($_POST['submit'])) {
	$id                  = $current_performance["performance_id"];
	$performance_name    = mysql_prep($_POST["name"]);
	$performance_details = mysql_prep($_POST["details"]);
	// validations
	$required_fields = array("name", "details",);
	validate_presences($required_fields);
	$fields_with_max_lengths = array("name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	if(empty($errors)) {
		$query  = "UPDATE Performance SET
				   	performance_name = '{$performance_name}',
			       	details = '{$performance_details}'
		           	WHERE performance_id = {$id} LIMIT 1";
		$result = mysqli_query($connection, $query);
		if($result && mysqli_affected_rows($connection) >= 0) {
			$_SESSION["message"] = "Performance updated.";
			redirect_to("manage_content.php?performance=" . $current_performance["performance_id"]);
		} else {
			$_SESSION["errors"] = "Performance update failed.";
		}
	}
} else {
} // end: if (isset($_POST['submit']))
?>
<?php include("../includes/layouts/header.php"); ?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<section class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="staff.php">Staff Area</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="staff.php">Home</a></li>
					<li class="active"><a href="manage_content.php">Manage Productions</a></li>
					<li><a href="bookings.php">Bookings</a></li>
					<li><a href="logout.php">Logout</a></li>
			</div>
		</section>
	</nav>
	<section class="container">
		<div class="row">
			<?php echo message(); ?><?php $errors = errors(); ?><?php echo form_errors($errors); ?>
		</div>
		<section class="main col-lg-8">
			<h3>Edit Production</h3>

			<form action="edit_performance.php?performance=<?php echo urldecode($current_performance["performance_id"]) ?>" method="POST" role="form">
				<fieldset class="col-lg-8">
					<legend>Current Details:</legend>
					<div class="form-group">
						<label for="name">Performance Name</label>
						<input type="text" class="form-control" name="name" id="name" value="<?php echo htmlentities($current_performance["performance_name"]); ?>" placeholder="Production Name" maxlength="50" required>
					</div>
					<div class="form-group">
						<label for="details">Performance Details</label>
						<textarea class="form-control" name="details" id="details" cols="30" rows="10" placeholder="Performance Details"><?php echo htmlentities($current_performance["details"]); ?></textarea>
					</div>
					<a href="manage_content.php?performance=<?php echo urldecode($current_performance["performance_id"]); ?>" class="btn btn-default">Cancel</a>
					<a href="delete_performance.php?performance=<?php echo urldecode($current_performance["performance_id"]); ?>" class="btn btn-danger">Delete</a>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</fieldset>
			</form>
		</section>
		<section class="sidebar col-lg-4">
			<h3>Productions</h3>
			<?php echo navigation($current_performance, $current_performance); ?>
		</section>
	</section>
<?php include("../includes/layouts/footer.php"); ?>