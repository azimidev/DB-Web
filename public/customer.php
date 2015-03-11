<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_signed_in() ?>
<?php $cart_set = find_cart_for_customer($_SESSION["customer_id"]); ?>
<?php $booking_set = find_booking_for_customer($_SESSION["customer_id"]); ?>
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
			<a class="navbar-brand" href="customer.php">Welcome <?php echo $_SESSION["customer_name"]; ?>!</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="customer.php">Home</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Productions
						<span class="caret"></span></a>
					<?php
					find_selected_performance();
					echo member_navigation($current_production, $current_performance);
					?>
				</li>
				<?php if(mysqli_num_rows($booking_set) == 0): ?>
					<li>
						<a href="" data-toggle="modal" data-target=".nobooking">Bookings</a>
					</li>
				<?php else: ?>
					<li><a href="customer_bookings.php">Bookings</a></li>
				<?php endif; ?>
			</ul>
			<form action="search.php" method="get" class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search production" name="q" maxlength="50">
				</div>
			</form>
			<ul class="nav navbar-nav pull-right">
				<?php if(mysqli_num_rows($cart_set) == 0): ?>
					<li>
						<a href="" data-toggle="modal" data-target=".emptycart"><span class="glyphicon glyphicon-shopping-cart"></span>
							Your Cart</a>
					</li>
				<?php else: ?>
					<li><a href="customer_cart.php">
							<span class="glyphicon glyphicon-shopping-cart"></span>
							Your Cart</a>
					</li>
				<?php endif; ?>
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
		<?php if($current_performance): ?>
			<section class="main col-lg-12">
				<?php $performance = find_performance_by_id($current_performance["performance_id"]); ?>
				<div class="well">
					<h4>Performance Information:</h4>
					<dl class="dl-horizontal">
						<dt>Name:</dt>
						<dd><?php echo $performance["performance_name"]; ?></dd>
						<dt>Details:</dt>
						<dd><?php echo nl2br($performance["details"]); ?></dd>
						<dt>Add to cart</dt>
						<dd>
							<a href="../includes/layouts/add_to_cart.php?performance=<?php echo urldecode($performance["performance_id"]); ?>" class="btn btn-success btn-sm">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</dd>
					</dl>
				</div>
			</section>
		<?php else: ?>
			<div class="row">
				<div class="jumbotron" style="border: 2px solid #000;">
					<div class="container">
						<h2>Hello <?php echo $_SESSION["customer_name"]; ?>!</h2>
						<p>Invite your friends to get 10% discount from us.</p>
						<a style="border: 1px solid black;" href="#" class="btn btn-success">Learn more</a>
					</div>
				</div>
			</div>
			<section class="main col-lg-8">
				<h5>List of the things you can do:</h5>
				<ul>
					<li>Search productions:
						<ul>
							<li>You can see list of the matched productions.</li>
							<li>Under every production you will see the list of the performances related to it.</li>
							<li>You can select the performance too add it to your cart and book it.</li>
						</ul>
					</li>
					<li>Browse through the productions:
						<ul>
							<li>You can see the list of the performances by drop-down menu.</li>
							<li>By selecting the performance you can view the details of it.</li>
							<li>You also can add it to you cart.</li>
							<li>You can book the performance.</li>
							<li>You can pay for the ticket.</li>
						</ul>
					</li>
					<li>Add performances to your cart.</li>
					<li>Book performances.</li>
					<li>Pay for performances.</li>
					<li>View your ticket details.</li>
					<li>Print your ticket details.</li>
				</ul>
				<h6>and more ...</h6>
			</section>
			<section class="main col-lg-4">
				<h4>News</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto doloribus eveniet itaque iusto nesciunt officia quasi, unde. Adipisci atque delectus doloremque dolores eos incidunt nesciunt perspiciatis quam vel. Repudiandae, vero!</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, laborum, quae. Asperiores delectus, esse eveniet impedit laboriosam maiores minus nesciunt odit perspiciatis placeat quaerat quidem, quisquam, recusandae reiciendis saepe sint!</p>
			</section>
		<?php endif; ?>
	</div>
</section>
<?php include("../includes/layouts/empty_cart.php"); ?>
<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
