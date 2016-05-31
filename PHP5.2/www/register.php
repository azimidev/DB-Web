<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
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
					<li class="dropdown">
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
		<?php echo message(); ?><?php echo errors(); ?> <?php echo form_errors($errors); ?>
		<div class="row">
			<div class="col-md-8">
				<h4>Register</h4>

				<form class="form-horizontal" role="form" action="scripts/register_scripts.php" method="post">
					<div class="form-group">
						<label for="username" class="col-lg-2 control-label">Username*</label>
						<div class="col-lg-10">
							<input type="text" name="username" class="form-control" id="username" placeholder="Username" maxlength="30" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="col-lg-2 control-label">Password*</label>
						<div class="col-lg-10">
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" maxlength="20" required>
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="col-lg-2 control-label">Full Name*</label>
						<div class="col-lg-10">
							<input type="text" name="full_name" class="form-control" id="name" placeholder="Full Name" required>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-lg-2 control-label">Email*</label>
						<div class="col-lg-10">
							<input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
						</div>
					</div>
					<div class="form-group">
						<label for="street" class="col-lg-2 control-label">Street</label>
						<div class="col-lg-10">
							<input type="text" name="street" class="form-control" id="street" placeholder="Street">
						</div>
					</div>
					<div class="form-group">
						<label for="town" class="col-lg-2 control-label">Town</label>
						<div class="col-lg-10">
							<input type="text" name="town" class="form-control" id="town" placeholder="Town">
						</div>
					</div>
					<div class="form-group">
						<label for="post_code" class="col-lg-2 control-label">Post Code</label>
						<div class="col-lg-10">
							<input type="text" name="town" class="form-control" id="post_code" placeholder="Post Code">
						</div>
					</div>
					<div class="form-group">
						<label for="phone" class="col-lg-2 control-label">Phone Number</label>
						<div class="col-lg-10">
							<input type="tel" name="phone" class="form-control" id="phone" placeholder="Phone Number">
						</div>
					</div>
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-10">
							<button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/login.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>