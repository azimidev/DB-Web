<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/db_connection.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php confirm_signed_in(); ?>
<?php
$customer_id    = $_SESSION["customer_id"];
$performance_id = $_GET["performance"];
$cart_id        = $_GET["cart"];
$query          = "INSERT INTO Booking (customer_id, performance_id) VALUES ({$customer_id}, {$performance_id})";
$result         = mysqli_query($connection, $query);
if($result) {
	if(isset($cart_id)) { // if cart exist then delete it
		$del       = "DELETE FROM Cart WHERE id = {$cart_id}";
		$delResult = mysqli_query($connection, $del);
		if($delResult) {
			$_SESSION["message"] = "You have successfully booked this performance.";
			refresh("customer.php");
		} else {
			$_SESSION["errors"] = "Could not delete the item from your cart!";
			refresh("customer.php");
		}
	} elseif(isset($_SESSION['cart'])) { // if there is anything in the public cart
		// find the performance id by array_search
		if(($key = array_search($performance_id, $_SESSION['cart'])) !== FALSE) {
			// unset the key
			unset($_SESSION['cart'][$key]);
			// now check if the $_SESSION['cart'] is empty
			if(empty($_SESSION['cart'])) {
				// if it is empty then assign it to NULL
				$_SESSION['cart'] = NULL;
				header("Location: ../../public/public_cart.php");
			}
			// send the message to the user
			$_SESSION["message"] = "You have successfully booked the performance selected.";
			refresh("customer.php");
		}
	}
	$_SESSION["message"] = "You have successfully booked.";
	if(isset($_SESSION["cart"])) {
		$_SESSION["message"] = "You have successfully booked this performance. After booking all performances in this cart, you can empty it.";
	}
	refresh("customer.php");
} else {
	$_SESSION["errors"] = "Could not add to the booking list!";
	refresh("customer.php");
}
?>
