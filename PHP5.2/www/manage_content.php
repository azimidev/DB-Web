<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_staff_signed_in(); ?>
<?php find_selected_performance(); ?>
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
			</ul>
		</div>
	</section>
</nav>
<section class="container">
	<div class="row">
		<?php echo message(); ?><?php echo errors(); ?>
	</div>
	<section class="main col-lg-8">
		<?php if($current_production) { ?>
			<h2>Manage Production:</h2>
			<dl class="dl-horizontal">
				<dt>Production Name:</dt>
				<dd><?php echo htmlentities($current_production["production_name"]); ?></dd>
				<dt>Production Type:</dt>
				<dd><?php echo htmlentities($current_production["production_type"]); ?></dd>
				<dt>&nbsp;</dt>
				<dd>
					<a href="edit_production.php?production=<?php echo urlencode($current_production["production_id"]); ?>" class="btn btn-primary btn-xs">Edit</a>
				</dd>
			</dl>
			<hr/>
			<h4>Performances for this production:</h4>
			<ul class="list-unstyled">
				<?php
				$production_performance = find_performances_for_production($current_production["production_id"]);
				while($performance = mysqli_fetch_assoc($production_performance)) {
					echo "<li>";
					$safe_performance_id = urlencode($performance["performance_id"]);
					echo "<a href='manage_content.php?performance={$safe_performance_id}'>";
					echo htmlentities($performance["performance_name"]);
					echo "</a>";
					echo "</li>";
				} ?>
			</ul>
			<br/>
			<a href="new_performance.php?production=<?php echo urlencode($current_production["production_id"]); ?>" class="btn btn-primary">
				+ Add new performance
			</a>
		<?php } elseif($current_performance) { ?>
			<h2>Manage Performance:</h2>
			<dl class="dl-horizontal">
				<dt>Performance Name:</dt>
				<dd><?php echo htmlentities($current_performance["performance_name"]); ?></dd>
				<dt>Details:</dt>
				<dd><?php echo nl2br($current_performance["details"]); ?></dd>
				<dt>&nbsp;</dt>
				<dd>
					<a href="edit_performance.php?performance=<?php echo urlencode($current_performance['performance_id']); ?>" class="btn btn-primary">Edit</a>
				</dd>
			</dl>
		<?php } else { ?>
			<h3>Please select a production or a performance.</h3>
		<?php } ?>
	</section>
	<section class="sidebar col-lg-4">
		<h3>Productions <a href="new_production.php" class="btn btn-danger pull-right">+ Add</a></h3>
		<?php echo navigation($current_production, $current_performance); ?>
	</section>
</section>

<?php include("../includes/layouts/footer.php"); ?>
