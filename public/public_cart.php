<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if(isset($_POST["clear"])) {
	$_SESSION["cart"]    = NULL;
	$_SESSION["message"] = "You have successfully emptied your cart";
	redirect_to("public_cart.php");
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
		<div class="row"><?php echo message(); ?><?php echo errors(); ?></div>
		<div class="row">
			<section class="main col-lg-8">
				<?php
				if(isset($_SESSION["cart"])): ?>
					<h3>Your Cart</h3>
					<?php $performance_set = find_performance($_SESSION["cart"]); ?>
					<table class="table table-hover">
						<thead>
						<tr>
							<th>Performance ID</th>
							<th>Performance Name</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php while($performance = mysqli_fetch_assoc($performance_set)): ?>
							<tr>
								<td><?php echo $performance["performance_id"]; ?></td>
								<td><?php echo $performance["performance_name"]; ?></td>
								<td>
									<a href="../includes/layouts/add_to_booking.php?performance=<?php echo urldecode($performance["performance_id"]); ?>" class="btn btn-success btn-xs">
										Book
									</a>
								</td>
							</tr>
						<?php endwhile; ?>
						</tbody>
					</table>
				<?php else: ?>
					<div class="container">
						<div class="col-lg-8"><h3>Your cart is empty</h3><br/>
							<blockquote>Please register with us to use our full service and buy ticket using our booking
							            system. <br/>
							            You can add items to this temporary cart. <br/>
							            However, to book the ticket which needs approval, you need to register with us.
								<br/><br/>
							            - <i>Thank You</i>
							</blockquote>
						</div>
						<div class="col-lg-4">
							<h1 style="font-size:150px;" class="pull-right glyphicon glyphicon-shopping-cart"></h1>
						</div>
					</div>
				<?php endif; ?>
				<?php //if(isset($_SESSION['cart'])){var_dump($_SESSION['cart']);} ?>
			</section>
			<section class="sidebar col-lg-4">
				<?php if(isset($_SESSION["cart"])): ?>
					<h3>Empty Your Basket</h3>
					<form action="public_cart.php" method="post">
						<button type="submit" name="clear" class="btn btn-danger">Empty Your Basket</button>
					</form>
				<?php endif; ?>
			</section>
		</div>
	</section>

<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/login.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>