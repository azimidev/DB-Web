<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_staff_signed_in() ?>
<?php find_selected_performance(); ?>
<?php
// production ID was missing or invalid or production couldn't be found in database
if(!$current_production) {
	redirect_to("manage_content.php");
}
if(isset($_POST['submit'])) {
	// validations
	$required_fields = array("name", "type",);
	validate_presences($required_fields);
	$fields_with_max_lengths = array("name" => 30);
	validate_max_lengths($fields_with_max_lengths);
	if(empty($errors)) {
		$id              = $current_production["production_id"];
		$production_name = mysql_prep($_POST["name"]);
		$production_type = mysql_prep($_POST["type"]);
		$query           = "UPDATE Production SET
							production_name = '{$production_name}',
							production_type = '{$production_type}'
							WHERE production_id = {$id} LIMIT 1";
		$result          = mysqli_query($connection, $query);
		if($result && mysqli_affected_rows($connection) >= 0) {
			$_SESSION["message"] = "Production updated.";
			redirect_to("manage_content.php?production=" . $current_production["production_id"]);
		} else {
			$_SESSION["errors"] = "Production update failed.";
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

			<form action="edit_production.php?production=<?php echo urldecode($current_production["production_id"]) ?>" method="POST" role="form">
				<fieldset class="col-lg-8">
					<legend>Current Details:</legend>
					<div class="form-group">
						<label for="name">Production Name</label>
						<input type="text" class="form-control" name="name" id="name" value="<?php echo htmlentities($current_production["production_name"]); ?>" placeholder="Production Name" maxlength="50" required>
					</div>
					<div class="form-group">
						<label for="type">Production Type</label>
						<input type="text" class="form-control" name="type" id="type" value="<?php echo htmlentities($current_production["production_type"]); ?>" placeholder="Production Type" maxlength="50" required>
					</div>
					<a href="manage_content.php" class="btn btn-default">Cancel</a>
					<a href="delete_production.php?production=<?php echo urldecode($current_production["production_id"]); ?>" class="btn btn-danger">Delete</a>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</fieldset>
			</form>
		</section>
		<section class="sidebar col-lg-4">
			<h3>Productions</h3>
			<?php echo navigation($current_production, $current_performance); ?>
		</section>
	</section>
<?php include("../includes/layouts/footer.php"); ?>