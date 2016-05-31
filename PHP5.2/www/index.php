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
				<li class="active"><a href="index.php">Home</a></li>
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
<?php include("../includes/layouts/carousel.php"); ?>
<section class="container">
	<div class="row"><?php echo message(); ?><?php echo errors(); ?><?php echo form_errors($errors); ?></div>
	<div class="col-lg-8">
		<h3>RSS FeedBurner</h3>
		<form class="form-inline" action="http://feedburner.google.com/fb/a/mailverify" method="POST" role="form" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=parsclick/HGms', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<fieldset>
				<legend>Please subscribe to our RSS:</legend>
				<div class="form-group has-success">
					<label for="email">Email Address:</label>
					<input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" size="50">
				</div>
				<input type="hidden" value="parsclick/HGms" name="uri"/>
				<input type="hidden" name="loc" value="en_UK"/>
				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</fieldset>
		</form>
		<hr/>
		<h4>The Picadilly Theatre</h4>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis deserunt minima quaerat repellendus.
		Accusamus asperiores ea error fugit minus, obcaecati quibusdam repellat? Adipisci eaque, eos ex pariatur sit
		tempora vitae.</p>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum ipsum nam nisi, nulla officiis optio
		reprehenderit suscipit velit veniam vero. Aspernatur autem, consequuntur debitis itaque laboriosam maiores
		reiciendis similique tempore!</p>
	</div>
	<div class="col-lg-4">
		<h5>Register Today</h5>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis deserunt minima quaerat repellendus.
		   Accusamus asperiores ea error fugit minus, obcaecati quibusdam repellat? Adipisci eaque, eos ex pariatur sit
		   tempora vitae.</p>
		<a class="btn btn-lg btn-danger" href="register.php">Register Today</a>
	</div>
</section><!-- container -->

<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/login.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
