<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/Stripe/vendor/autoload.php"); ?>
<?php confirm_signed_in() ?>
<?php $member = find_member_by_id($_SESSION["customer_id"]); ?>
<?php $cart_set = find_cart_for_customer($_SESSION["customer_id"]); ?>
<?php $booking_set = find_booking_for_customer($_SESSION["customer_id"]); ?>
<?php
$booking_id     = $_GET["booking"];
$performance_id = $_GET["performance"];
$booking        = find_booking_by_id($booking_id);
$performance    = find_performance_by_id($performance_id);
$seat_set       = find_all_seats();
if(!$member || !$booking_id || !$performance_id) {
	$_SESSION["errors"] = "Something went wrong fining booking or performance for this booking!";
	redirect_to($_SERVER["HTTP_REFERER"]);
}
if($booking["purchased"]) {
	$_SESSION["errors"] = "Booking ticket is purchased already and cannot be modified!";
	redirect_to("customer_bookings.php");
}
\Stripe\Stripe::setApiKey('sk_test_4VsTZFhhh6wpCIWulEVQTqXp');
if(isset($_POST['stripeToken'])) {
	try {
		\Stripe\Charge::create(array(
			                       "amount"      => 1599,
			                       "currency"    => "gbp",
			                       "source"      => $_POST['stripeToken'],
			                       "description" => "Charge for Piccadilly Theater"
		                       ));
		//$_SESSION["message"] = "Thank you for your payment.";
		//redirect_to("buy_ticket.php?booking=". urldecode($booking["booking_id"]). "&performance=".urldecode($booking["performance_id"]));
		//} elseif(isset($_POST["submit"])) {
		$seat_id        = (int)$_POST["seat"];
		$ticket_query   = "INSERT INTO Ticket (performance_id, seat_id, booking_id) VALUES ({$performance_id}, {$seat_id}, {$booking_id})";
		$seat_query     = "UPDATE Seat SET status = 1 WHERE seat_id = {$seat_id}";
		$booking_query  = "UPDATE Booking SET purchased = 1 WHERE booking_id = {$booking_id}";
		$ticket_result  = mysqli_query($connection, $ticket_query);
		$seat_result    = mysqli_query($connection, $seat_query);
		$booking_result = mysqli_query($connection, $booking_query);
		if($ticket_result && $seat_result && $booking_result && mysqli_affected_rows($connection) == 1) {
			$_SESSION["message"] = "You have purchased the ticket. Please remember to print your ticket details as follow. You can only see this page once.";
			$_SESSION["booking"] = $booking_id;
			redirect_to("ticket_info.php");
		} else {
			$_SESSION["errors"] = "Could not insert into the ticket table!";
			redirect_to("buy_ticket.php?booking=" . urldecode($booking["booking_id"]) . "&performance=" . urldecode($performance["performance_id"]));
		}
	} catch(\Stripe\Error\Card $e) {
		$errors = $e->getMessage();
	}
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
			<form action="search.php" method="get" class="navbar-form navbar-left" role="search" name="q" size="30" maxlength="50">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
			</form>
			<ul class="nav navbar-nav pull-right">
				<?php if(mysqli_num_rows($cart_set) == 0): ?>
					<li>
						<a href="" data-toggle="modal" data-target=".emptycart"><span class="glyphicon glyphicon-shopping-cart"></span>
							Your Cart</a>
					</li>
				<?php else: ?>
					<li><a href="customer_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Your Cart</a>
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
		<h4>Details:</h4>

		<section class="main col-lg-5">
			<dl class="dl-horizontal">
				<dt>Booking Date:</dt>
				<dd><?php echo datetime_to_text(htmlentities($booking["booking_date"])); ?></dd>
				<dt>Performance Name:</dt>
				<dd><?php echo htmlentities($performance["performance_name"]); ?></dd>
				<dt>Seat Number:</dt>
				<dd>
					<form action="buy_ticket.php?booking=<?php echo urldecode($booking["booking_id"]); ?>&performance=<?php echo urldecode($performance["performance_id"]); ?>" method="POST" role="form">
						<div class="form-group">
							<label for="seat">Choose your seat:</label>
							<select name="seat" id="seat" class="form-control" required>
								<option value="" disabled selected>--Please Select--</option>
								<?php while($seat = mysqli_fetch_assoc($seat_set)): ?>
									<option value="<?php echo $seat['seat_id']; ?>">
										<?php echo "Row: " . $seat["seat_row"] . " Number: " . $seat["seat_number"] . " Price: £" . $seat["price"]; ?>
									</option>
								<?php endwhile; ?>
							</select>
						</div>
						<a class="btn btn-danger btn-sm" href="customer_bookings.php">Cancel</a>
						<script
							src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="pk_test_4VsTjgOsN0s7xNKrpJrTUHx9"
							data-image="img/favicon.ico"
							data-name="picadillytheatre.com"
							data-label="Buy Ticket"
							data-email="<?php echo $member['email']; ?>"
							data-allow-remember-me="false"
							data-description="Buy Ticket"
							data-currency="gbp"
							data-amount="1599">
						</script>
					</form>
				</dd>
			</dl>
		</section>
	</div>
</section>

<?php include("../includes/layouts/empty_cart.php"); ?>
<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
