<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_signed_in() ?>
<?php $member = find_member_by_id($_SESSION["customer_id"]); ?>
<?php $cart_set = find_cart_for_customer($_SESSION["customer_id"]); ?>
<?php $booking_set = find_booking_for_customer($_SESSION["customer_id"]); ?>
<?php
if(!$member) {
	redirect_to($_SERVER["HTTP_REFERER"]);
}
if(mysqli_num_rows($booking_set) == 0) {
	redirect_to("customer.php");
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
					<li class="active">
						<a href="" data-toggle="modal" data-target=".nobooking">Bookings</a>
					</li>
				<?php else: ?>
					<li class="active"><a href="customer_bookings.php">Bookings</a></li>
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
	<section class="main col-lg-9">
		<h3>Your Bookings History</h3>
		<table class="table table-hover">
			<thead>
			<tr>
				<th>Booking ID</th>
				<th>Performance Name</th>
				<th>Ticket</th>
			</tr>
			</thead>
			<tbody>
			<?php while($booking = mysqli_fetch_assoc($booking_set)): ?>
				<?php $performance_id = find_performance_by_id($booking["performance_id"]); ?>
				<tr>
					<td><?php echo htmlentities($booking["booking_id"]); ?></td>
					<td><?php echo htmlentities($performance_id["performance_name"]); ?></td>
					<td>
						<?php if(!$booking["purchased"]): ?>
							<?php if($booking["status"]): ?>
								<a href="buy_ticket.php?booking=<?php echo urldecode($booking["booking_id"]); ?>&performance=<?php echo urldecode($booking["performance_id"]); ?>" class="btn btn-success btn-xs">
									Choose your seat
								</a>
								<!--<form action="buy_ticket.php?booking=--><?php //echo urldecode($booking["booking_id"]); ?><!--&performance=--><?php //echo urldecode($booking["performance_id"]); ?><!--" method="POST">-->
								<!--	<script-->
								<!--		src="https://checkout.stripe.com/checkout.js" class="stripe-button"-->
								<!--		data-key="pk_test_4VsTjgOsN0s7xNKrpJrTUHx9"-->
								<!--		data-image="img/favicon.ico"-->
								<!--		data-name="picadillytheatre.com"-->
								<!--		data-label="Buy Ticket"-->
								<!--		data-email="--><?php //echo $member['email']; ?><!--"-->
								<!--		data-allow-remember-me="false"-->
								<!--		data-description="Buy Ticket"-->
								<!--		data-currency="gbp"-->
								<!--		data-amount="1599">-->
								<!--	</script>-->
								<!--</form>-->
								&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="small text-success">Approved</span>
							<?php else: ?>
								<a href="scripts/cancel_booking_item.php?id=<?php echo urldecode($booking["booking_id"]); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to cancel booking for <?php echo htmlentities($performance_id["performance_name"]); ?>?')">
									Cancel
								</a>&nbsp;&nbsp;&nbsp;&nbsp;
								<span class="small text-muted">Needs Approval</span>
							<?php endif; ?>
						<?php else: ?>
							<?php $ticket = find_ticket_by_booking_id($booking["booking_id"]); ?>
							<span class="text-info">TN: <?php echo htmlentities($ticket["ticket_id"]); ?></span><br/>
						<?php endif ?>
					</td>
				</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
	</section>
	<section class="sidebar col-lg-3">
		<h3>How to Buy</h3>
		<p>Please note that after booking your place, a member of staff needs to approve it and accept your booking
		   before you be able to buy the ticket.</p>
		<p>Please make sure you click on the green button to buy your ticket for performance you have chosen. You can
		   also click on the red button to remove item from your booking list before any of the staff members approve
		   it.</p>
	</section>
</section>

<?php include("../includes/layouts/empty_cart.php"); ?>
<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
