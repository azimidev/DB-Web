<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_signed_in();
$member      = find_member_by_id($_SESSION["customer_id"]);
$cart_set    = find_cart_for_customer($_SESSION["customer_id"]);
$booking_set = find_booking_for_customer($_SESSION["customer_id"]);
if(isset($_GET["q"]) && !empty($_GET["q"]) && $_GET["q"] != " ") {
	$result = search_production($_GET["q"]);
} else {
	$_SESSION["errors"] = "You did not search anything.";
	redirect_to($_SERVER["HTTP_REFERER"]);
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
					<input type="text" class="form-control" placeholder="Search production" name="q" size="25" maxlength="50">
				</div>
			</form>
			<ul class="nav navbar-nav pull-right">
				<?php if(mysqli_num_rows($cart_set) == 0): ?>
					<li>
						<a href="" data-toggle="modal" data-target=".emptycart"><span class="glyphicon glyphicon-shopping-cart"></span>
							Your Cart
						</a>
					</li>
				<?php else: ?>
					<li><a href="customer_cart.php">
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
	<div class="row">
		<section class="col-lg-6">
			<h4><span class="glyphicon glyphicon-search"></span> Search Results For Production:
			</h4>
			<hr/>
			<div class="well">
				<?php while($production = mysqli_fetch_assoc($result)): ?>
					<ul class="list-unstyled">
						<li class="lead">
							<?php echo $production["production_name"]; ?>
							<?php $performance_set = find_performances_for_production($production["production_id"]); ?>
							<?php while($performance = mysqli_fetch_assoc($performance_set)): ?>
								<?php if(mysqli_num_rows($performance_set) > 0): ?>
									<ul>
										<li>
											<a href="customer.php?performance=<?php echo urlencode($performance["performance_id"]); ?>"><?php echo $performance["performance_name"]; ?></a>
										</li>
									</ul>
								<?php endif; ?>
							<?php endwhile; ?>
						</li>
					</ul>
				<?php endwhile; ?>
			</div>
		</section>
	</div>
</section>

<?php include("../includes/layouts/empty_cart.php"); ?>
<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>
