<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require_once("../includes/PHPMailer/class.phpmailer.php"); ?>
<?php require_once("../includes/PHPMailer/class.smtp.php"); ?>
<?php require_once("../includes/PHPMailer/phpmailer.lang-en.php"); ?>
<?php
if(isset($_POST["submit"])) {
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->IsHTML(TRUE);
	$mail->Host       = "smtp.mail.yahoo.com";
	$mail->SMTPSecure = 'tls';
	$mail->Port       = 587;
	$mail->SMTPAuth   = TRUE;
	$mail->Username   = "info_sia0@yahoo.co.uk";
	$mail->Password   = "1234ASdf";
	$mail->FromName   = $_POST["name"];
	$mail->From       = "info_sia0@yahoo.co.uk";
	$mail->Subject    = "New Enquiry from " . $_POST["name"];
	$mail->AddAddress("persian.loyal@yahoo.com", "Do not reply Piccadilly Theatre");
	$mail->Body = <<<EMAILBODY
<body style="background-color:#FFFFC0">

<h2>A new email has been received from the theatre website as follows:</h2>

<p>--------------------------------------------<br>
Name: {$_POST["name"]}<br>
Email: {$_POST["email"]}<br>
--------------------------------------------</p>

<h3>Message:</h3>

	<p style="padding:10px;border:2px solid red; border-radius:5px;">{$_POST["message"]}</p>

<hr />
EMAILBODY;
	$result     = $mail->Send();
	if($result) {
		$_SESSION["message"] = "Thank you your email has been sent.";
	} else {
		$_SESSION["message"] = "Error on sending your message!";
	}
}
?>
<?php include("../includes/layouts/header.php") ?>
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
					<li class="active"><a href="contact.php">Contact</a></li>
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
		<?php echo message(); ?><?php echo errors(); ?> <?php echo form_errors($errors); ?>
		<div class="row">
			<section class="main col-lg-8">
				<article>
					<h2>Contact Us</h2>

					<form action="" method="POST" class="form-horizontal" role="form">
						<div class="form-group">
							<legend>Please contact us using this form</legend>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<label for="name">Full Name</label>
								<input type="text" name="name" class="form-control" id="name" placeholder="please enter your name" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<label for="email">Email</label>
								<input type="text" name="email" class="form-control" id="email" placeholder="please enter your email" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<label for="message">Message</label>
								<textarea class="form-control" name="message" id="message" rows="10" placeholder="Please write your message"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" name="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</form>
				</article>
			</section>
			<!--main-->
			<section class="sidebar col-lg-4">
				<article class="panel panel-default">
					<div class="panel-body">
						<h3>Address</h3>
						<address>
							<strong>The Piccadilly Theatre.</strong><br/>
							16 Denman Street<br/>
							London, Piccadilly,<br/>
							W1D 7DY<br/>
							<abbr title="Phone">Bookings:</abbr> 0844 871 7627
						</address>
						<address><strong>Email</strong><br/>
							<a href="mailto:info.sia@yahoo.com">info.sia@yahoo.com</a>
						</address>
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1241.5695308665006!2d-0.135601!3d51.5106647!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa14df20866754e24!2sPiccadilly+Theatre!5e0!3m2!1sen!2s!4v1425676334867" width="100%" height="500" frameborder="0"></iframe>
					</div>
				</article>
			</section>
			<!--sidebar-->
		</div>
	</section><!-- container -->

<?php include("../includes/layouts/no_booking.php"); ?>
<?php include("../includes/layouts/no_performance.php"); ?>
<?php include("../includes/layouts/login.php"); ?>
<?php include("../includes/layouts/footer.php"); ?>