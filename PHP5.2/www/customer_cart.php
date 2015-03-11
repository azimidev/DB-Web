<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_signed_in() ?>
<?php $member = find_member_by_id($_SESSION["customer_id"]); ?>
<?php $cart_set = find_cart_for_customer($_SESSION["customer_id"]); ?>
<?php $booking_set = find_booking_for_customer($_SESSION["customer_id"]); ?>
<?php
if(!$member) {
	if(isset($_SERVER["HTTP_REFERER"])) {
		redirect_to($_SERVER["HTTP_REFERER"]);
	} else {
		redirect_to("customer.php");
	}
}
if(mysqli_num_rows($cart_set) == 0) {
	redirect_to("customer.php");
}
if(isset($_SESSION["cart"])) {

}
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
			<a class="navbar-brand" href="customer.php">Welcome <?php echo $_SESSION["customer_name"]; ?>!</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="customer.php">Home</a></li>
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
					<li class="active">
						<a href="" data-toggle="modal" data-target=".emptycart">
							<span class="glyphicon glyphicon-shopping-cart"></span>
							Your Cart</a>
					</li>
				<?php else: ?>
					<li class="active">
						<a href="customer_cart.php">
							<span class="glyphicon glyphicon-shopping-cart"></span>
							Your Cart
						</a>
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
	<section class="main col-lg-8">
		<h3>Your Cart</h3>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Performance Name</th>
				<th colspan="2">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php while($cart = mysqli_fetch_assoc($cart_set)): ?>
				<?php $performance_id = find_performance_by_id($cart["performance_id"]); ?>
				<tr>
					<td><?php echo htmlentities($performance_id["performance_name"]); ?></td>
					<td>
						<a href="scripts/add_to_booking.php?performance=<?php echo urldecode($performance_id["performance_id"]); ?>&cart=<?php echo urldecode($cart["id"]); ?>" class="btn btn-success btn-xs">
							<span class="glyphicon glyphicon-plus"></span>
						</a>
						<a href="delete_cart_item.php?id=<?php echo urldecode($cart["id"]); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to cancel booking for <?php echo htmlentities($performance_id["performance_name"]); ?> performance?')">
							<span class="glyphicon glyphicon-remove"></span>
						</a>
					</td>
				</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
	</section>
	<section class="sidebar col-lg-4">
		<h3>How to Book</h3>
		<p>Please make sure you click on the green button to book your place for performance you have chosen. You can
		   also click on the red button to remove item from your cart.</p>
		<p>Please note that after booking your place, a member of staff needs to confirm it and accept your booking
		   to
		   issue a ticket for you before you to be able to join the event.</p>
	</section>
</section>

<?php include("../includes/layouts/empty_cart.php"); ?>
<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
