<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_signed_in(); ?>
<?php $member = find_member_by_id($_SESSION["customer_id"]); ?>
<?php $cart_set = find_cart_for_customer($_SESSION["customer_id"]); ?>
<?php $booking_set = find_booking_for_customer($_SESSION["customer_id"]); ?>
<?php
$booking_id = $_SESSION["booking"];
if(!$booking_id) {
	redirect_to("customer_bookings.php");
}
$ticket      = find_ticket_by_booking_id($booking_id);
$performance = find_performance_by_id($ticket["performance_id"]);
$seat        = find_seat_by_id($ticket["seat_id"]);
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
						<a href="#" data-toggle="modal" data-target=".emptycart"><span class="glyphicon glyphicon-shopping-cart"></span>
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
	<br/><br class="hidden-xs"/><br class="hidden-xs"/>
	<div class="col-lg-4 col-lg-offset-4 alert alert-danger">
		<h4>Ticket Details:</h4>
		<dl class="dl-horizontal">
			<dt>Ticket Number:</dt>
			<dd>TN:<?php echo htmlentities($ticket["ticket_id"]); ?></dd>
			<dt>Performance:</dt>
			<dd><?php echo htmlentities($performance["performance_name"]); ?></dd>
			<dt>Seat Row:</dt>
			<dd><?php echo htmlentities($seat["seat_row"]); ?></dd>
			<dt>Seat Number</dt>
			<dd><?php echo htmlentities($seat["seat_number"]); ?></dd>
			<dt>Price:</dt>
			<dd>£<?php echo htmlentities($seat["price"]); ?></dd>
			<dt>&nbsp;</dt>
			<dd><button type="button" onclick="window,print();" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Print</button></dd>
		</dl>
	</div>
</section>

<?php $_SESSION["booking"] = NULL; ?>

<?php include("../includes/layouts/empty_cart.php"); ?>
<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
