<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_staff_signed_in(); ?>
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
				<li class="active"><a href="staff.php">Home</a></li>
				<li><a href="manage_content.php">Manage Productions</a></li>
				<li><a href="bookings.php">Bookings</a></li>
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</section>
</nav>
<section class="container">
	<div class="row">
		<?php echo message(); ?><?php echo errors(); ?>
	</div>
	<div class="row">
		<div class="jumbotron" style="border: 2px solid #000;">
			<div class="container">
				<h2>Welcome to staff area.</h2>
				<p>You can create, read, update and delete any production and performance.</p>
			</div>
		</div>
	</div>
	<div class="col-lg-8">
		<h3>Your Responsibilities</h3>
		<ul>
			<li>Manage productions and performances by:
				<ul>
					<li>Create, read, update and delete productions.</li>
					<li>Create, read, update and delete performances.</li>
				</ul>
			</li>
			<li>Manage bookings by:
				<ul>
					<li>Approve bookings.</li>
					<li>Clear all the bookings after the performances are finished.</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="col-lg-4"></div>
</section>

<?php include("../includes/layouts/footer.php"); ?>
