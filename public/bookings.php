<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_staff_signed_in() ?>
<?php $booking_set = find_all_bookings(); ?>
<?php
if(isset($_POST["clear"])) {
	$result = delete_all_bookings();
	if($result) {
		$_SESSION["message"] = "Booking is cleared";
		redirect_to("bookings.php");
	} else {
		$_SESSION["errors"] = "Error!";
		redirect_to("bookings.php");
	}
} else {
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
			<!--<ul class="nav navbar-nav pull-right">-->
			<!--	<li><a href="../includes/layouts/clear_seat_status.php">Clear Sear Status</a></li>-->
			<!--</ul>-->
		</div>
	</section>
</nav>
<section class="container">
	<div class="row">
		<?php echo message(); ?><?php echo errors(); ?>
	</div>
	<?php if(mysqli_num_rows($booking_set) > 0): ?>
		<div class="row">
			<section class="main col-lg-12">
				<table class="table table-hover">
					<thead>
					<tr>
						<th>Booking ID</th>
						<th>Customer Name</th>
						<th>Performance Name</th>
						<th>Booking Date</th>
						<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php while($booking = mysqli_fetch_assoc($booking_set)): ?>
						<tr>
							<td><?php echo htmlentities($booking["booking_id"]); ?></td>
							<td><?php echo htmlentities(find_member_by_id($booking["customer_id"])["customer_name"]); ?></td>
							<td><?php echo htmlentities(find_performance_by_id($booking["performance_id"])["performance_name"]); ?></td>
							<td><?php echo datetime_to_text(htmlentities($booking["booking_date"])); ?></td>
							<td><?php if($booking["status"]): ?>
									<a href="approvals.php?id=<?php echo urldecode($booking["booking_id"]); ?>" class='btn btn-success btn-xs'>
										Approved
									</a>
								<?php else: ?>
									<a href="approvals.php?id=<?php echo urldecode($booking["booking_id"]); ?>" class='btn btn-danger btn-xs'>
										Needs Approval
									</a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</section>
		</div>
		<hr/>
		<form method="post" action="bookings.php">
			<button class="btn btn-default" name="clear" type="submit" onclick="return confirm('Are you sure?')">Clear
			                                                                                                     History
			</button>
		</form>
	<?php else: ?>
		<h2>No Booking Yet</h2>
	<?php endif; ?>
	<br/><br/>
</section>

<?php include("../includes/layouts/footer.php"); ?>
