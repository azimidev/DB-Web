<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_staff_signed_in() ?>
<?php
$booking_id = $_GET["id"];
$booking    = find_booking_by_id($booking_id);
if(isset($_POST["submit"])) {
	$booking_status = (int)$_POST["status"];
	$row            = mysql_prep($_POST["row"]);
	$number         = (int)$_POST["number"];
	$price          = (double)$_POST["price"];
	$query          = "UPDATE Booking SET status = {$booking_status} WHERE booking_id = {$booking_id} LIMIT 1";
	$result         = mysqli_query($connection, $query);
	if($result && mysqli_affected_rows($connection) == 1) {
		$_SESSION["message"] = "Booking number {$booking_id} was updated.";
		redirect_to("bookings.php");
	} else {
		$_SESSION["errors"] = "Nothing has changed for this booking!";
		redirect_to("approvals.php?id=" . urldecode($booking["booking_id"]));
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
				<a class="navbar-brand" href="staff.php">Staff Area</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="staff.php">Home</a></li>
					<li><a href="manage_content.php">Manage Productions</a></li>
					<li class="active"><a href="bookings.php">Bookings</a></li>
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
			<section class="col-lg-12">
				<a href="bookings.php" class="btn btn-default">&laquo; Back</a>

				<h3>Booking Details:</h3>
				<dl class="dl-horizontal">
					<dt>Booking ID:</dt>
					<dd><?php echo $booking["booking_id"]; ?></dd>
					<dt>Booking Date:</dt>
					<dd><?php echo datetime_to_text($booking["booking_date"]); ?></dd>
					<dt>Customer Name:</dt>
					<dd><?php echo find_member_by_id($booking["customer_id"])["customer_name"]; ?></dd>
					<dt>Performance Name:</dt>
					<dd><?php echo find_performance_by_id($booking["performance_id"])["performance_name"]; ?></dd>
					<form action="approvals.php?id=<?php echo urldecode($booking["booking_id"]); ?>" method="POST" role="form">
						<dt>Approved:</dt>
						<dd>
							<div class="controls">
								<input type="radio" name="status" value="1"
									<?php if($booking["status"]) {
										echo "checked";
									} ?> /> Yes
								            &nbsp;&nbsp;&nbsp;
								<input type="radio" name="status" value="0"
									<?php if(!$booking["status"]) {
										echo "checked";
									} ?> /> No
							</div>
						</dd>
						&nbsp;
						<dt>&nbsp;</dt>
						<dd>
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</dd>
					</form>
				</dl>
			</section>
		</div>
	</section>

<?php include("../includes/layouts/footer.php"); ?>