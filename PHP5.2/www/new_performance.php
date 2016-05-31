<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_staff_signed_in(); ?>
<?php find_selected_performance(); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php
// Can't add a new page unless we have a subject as a parent!
if(!$current_production) {
	redirect_to("manage_content.php");
}
if(isset($_POST['submit'])) {
	$required_fields = array("name", "details");
	validate_presences($required_fields);
	$fields_with_max_lengths = array("name" => 50);
	validate_max_lengths($fields_with_max_lengths);
	if(empty($errors)) {
		$production_id       = $current_production["production_id"];
		$performance_name    = mysql_prep($_POST["name"]);
		$performance_details = mysql_prep($_POST["details"]);
		$query               = "INSERT INTO Performance (production_id, performance_name, details)
 								VALUES ({$production_id}, '{$performance_name}', '{$performance_details}')";
		$result              = mysqli_query($connection, $query);
		if($result) {
			$_SESSION["message"] = "Performance created.";
			redirect_to("manage_content.php?production=" . urlencode($current_production["production_id"]));
		} else {
			$_SESSION["errors"] = "Performance creation failed.";
			redirect_to("new_performance.php?production=" . $current_production["production_id"]);
		}
	}
} else {
}
?>
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
		<?php echo message(); ?><?php echo errors(); ?><?php echo form_errors($errors); ?>
	</div>
	<section class="main col-lg-8">
		<h3>Add New Performance</h3>

		<form action="new_performance.php?production=<?php echo urldecode($current_production["production_id"]); ?>" method="POST" role="form">
			<fieldset class="col-lg-8">
				<legend>Please fill all fields:</legend>
				<div class="form-group">
					<label for="name">Performance Name</label>
					<input type="text" class="form-control" name="name" id="name" placeholder="Production Name" maxlength="50" required>
				</div>
				<div class="form-group">
					<label for="details">Performance Details</label>
					<textarea class="form-control" name="details" id="details" cols="30" rows="6" placeholder="Production Details" required></textarea>
				</div>
				<a href="manage_content.php?production=<?php echo urlencode($current_production["production_id"]); ?>" class="btn btn-default">Cancel</a>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</fieldset>
		</form>
	</section>
	<section class="sidebar col-lg-4">
		<h3>Productions <a href="new_performance.php" class="btn btn-danger pull-right">+ Add</a></h3>
		<?php echo navigation($current_production, $current_performance); ?>
	</section>
</section>
<?php include("../includes/layouts/footer.php"); ?>
