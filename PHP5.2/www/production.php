<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
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
			<a class="navbar-brand" href="index.php">Theatre Company</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li class="dropdown active">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productions
						<span class="caret"></span></a>
					<?php
					find_selected_performance();
					echo public_navigation($current_production, $current_performance);
					?>
				</li>
			</ul>
			<?php if(!isset($_SESSION["customer_id"])): ?>
				<ul class="nav navbar-nav pull-right">
					<li><a href="public_cart.php">
							<span class="glyphicon glyphicon-shopping-cart"></span> Your Cart
						</a></li>
					<li><a href="" data-toggle="modal" data-target=".loginPage">Login</a></li>
				</ul>
			<?php else: ?>
				<ul class="nav navbar-nav pull-right">
					<?php $booking_set = find_booking_for_customer($_SESSION["customer_id"]); ?>
					<?php if(mysqli_num_rows($booking_set) == 0): ?>
						<li>
							<a href="" data-toggle="modal" data-target=".nobooking">Bookings</a>
						</li>
					<?php else: ?>
						<li><a href="customer_bookings.php">Bookings</a></li>
					<?php endif; ?>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			<?php endif; ?>
		</div>
	</section>
</nav>
<section class="container">
	<div class="row"><?php echo message(); ?><?php echo errors(); ?></div>
	<div class="row">
		<section class="main col-lg-12">
			<?php if($current_performance): ?>
				<?php $performance = find_performance_by_id($current_performance["performance_id"]) ?>
				<div class="alert alert-success">
					<h4>Performance Information:</h4>
					<dl class="dl-horizontal">
						<dt>Name:</dt>
						<dd><?php echo $performance["performance_name"]; ?></dd>
						<dt>Details:</dt>
						<dd><?php echo nl2br($performance["details"]); ?></dd>
						<dt>Add to cart</dt>
						<dd>
							<a href="scripts/add_to_public_cart.php?performance=<?php echo urlencode($performance["performance_id"]); ?>" class="btn btn-danger">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</dd>
					</dl>
				</div>
			<?php endif; ?>
		</section>
		<!--main-->
	</div>
</section><!-- container -->

<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/login.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
