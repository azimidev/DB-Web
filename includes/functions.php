<?php

function redirect_to($new_location) {
	header("Location: " . "$new_location");
	exit;
}

function refresh($reserved_page) {
	if(isset($_SERVER["HTTP_REFERER"])) {
		redirect_to($_SERVER["HTTP_REFERER"]);
	} else {
		redirect_to($reserved_page);
	}
}

function datetime_to_text($datetime = "") {
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function mysql_prep($string) {
	global $connection;
	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}

function confirm_query($result_set) {
	if(!$result_set) {
		die("Database query failed.");
	}
}

function form_errors($errors = array()) {
	$output = "";
	if(!empty($errors)) {
		$output = "<div class='alert alert-warning alert-dismissible' role='alert'>";
		$output .= "<button type='button' class='close' data-dismiss='alert'>";
		$output .= "<span aria-hidden='true'>&times;</span>";
		$output .= "<span class='sr-only'></span>";
		$output .= "</button>";
		$output .= "<ul style='list-style-type: square;'>";
		foreach($errors as $key => $error) {
			$output .= "<li>";
			$output .= htmlentities($error);
			$output .= "</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}

function find_all_productions() {
	global $connection;
	$query          = "SELECT * FROM Production ORDER BY production_id ASC";
	$production_set = mysqli_query($connection, $query);
	confirm_query($production_set);
	return $production_set;
}

function delete_all_bookings() {
	global $connection;
	$query = "DELETE FROM Booking";
	$set   = mysqli_query($connection, $query);
	confirm_query($set);
	return $set;
}

function find_performances_for_production($production_id) {
	global $connection;
	$safe_production_id = mysqli_real_escape_string($connection, $production_id);
	$query              = "SELECT * FROM Performance WHERE production_id = {$safe_production_id} ORDER BY performance_name ASC";
	$performance_set    = mysqli_query($connection, $query);
	confirm_query($performance_set);
	return $performance_set;
}

function find_production_by_id($production_id) {
	global $connection;
	$safe_production_id = mysqli_real_escape_string($connection, $production_id);
	$query              = "SELECT * FROM Production WHERE production_id = {$safe_production_id} LIMIT 1";
	$production_set     = mysqli_query($connection, $query);
	confirm_query($production_set);
	if($production = mysqli_fetch_assoc($production_set)) {
		return $production;
	} else {
		return NULL;
	}
}

function find_performance_by_id($performance_id) {
	global $connection;
	$safe_performance_id = mysqli_real_escape_string($connection, $performance_id);
	$query               = "SELECT * FROM Performance WHERE performance_id = {$safe_performance_id} LIMIT 1";
	$performance_set     = mysqli_query($connection, $query);
	confirm_query($performance_set);
	if($performance = mysqli_fetch_assoc($performance_set)) {
		return $performance;
	} else {
		return NULL;
	}
}

function find_cart_for_customer($customer_id) {
	global $connection;
	$safe_customer_id = mysqli_real_escape_string($connection, $customer_id);
	$query            = "SELECT * FROM Cart WHERE customer_id = {$safe_customer_id} ORDER BY id ASC";
	$cart_set         = mysqli_query($connection, $query);
	confirm_query($cart_set);
	return $cart_set;
}

function find_cart_by_id($id) {
	global $connection;
	$safe_id  = mysqli_real_escape_string($connection, $id);
	$query    = "SELECT * FROM Cart WHERE id = {$safe_id} LIMIT 1";
	$cart_set = mysqli_query($connection, $query);
	confirm_query($cart_set);
	if($cart = mysqli_fetch_assoc($cart_set)) {
		return $cart;
	} else {
		return NULL;
	}
}

function find_cart_by_customer_id($customer_id) {
	global $connection;
	$safe_id  = mysqli_real_escape_string($connection, $customer_id);
	$query    = "SELECT * FROM Cart WHERE customer_id = {$safe_id}";
	$cart_set = mysqli_query($connection, $query);
	confirm_query($cart_set);
	if($cart = mysqli_fetch_assoc($cart_set)) {
		return $cart;
	} else {
		return NULL;
	}
}

function search_production($search = "") {
	global $connection;
	$safe_search = mysqli_real_escape_string($connection, $search);
	$query       = "SELECT * FROM Production WHERE production_name LIKE '%{$safe_search}%'";
	$search_set  = mysqli_query($connection, $query);
	confirm_query($search_set);
	return $search_set;
}

function find_booking_for_customer($customer_id) {
	global $connection;
	$safe_customer_id = mysqli_real_escape_string($connection, $customer_id);
	$query            = "SELECT * FROM Booking WHERE customer_id = {$safe_customer_id} ORDER BY booking_date ASC";
	$booking_set      = mysqli_query($connection, $query);
	confirm_query($booking_set);
	return $booking_set;
}

function find_booking_by_id($id) {
	global $connection;
	$safe_id     = mysqli_real_escape_string($connection, $id);
	$query       = "SELECT * FROM Booking WHERE booking_id = {$safe_id} LIMIT 1";
	$booking_set = mysqli_query($connection, $query);
	confirm_query($booking_set);
	if($booking = mysqli_fetch_assoc($booking_set)) {
		return $booking;
	} else {
		return NULL;
	}
}

function find_all_bookings() {
	global $connection;
	$query       = "SELECT * FROM Booking ORDER BY status ASC";
	$booking_set = mysqli_query($connection, $query);
	confirm_query($booking_set);
	return $booking_set;
}

function find_seat_by_id($id) {
	global $connection;
	$safe_id  = mysqli_real_escape_string($connection, $id);
	$query    = "SELECT * FROM Seat WHERE seat_id = {$safe_id} LIMIT 1";
	$seat_set = mysqli_query($connection, $query);
	confirm_query($seat_set);
	if($seat = mysqli_fetch_assoc($seat_set)) {
		return $seat;
	} else {
		return NULL;
	}
}

function find_all_seats() {
	global $connection;
	$query    = "SELECT * FROM Seat ORDER BY seat_id ASC";
	$seat_set = mysqli_query($connection, $query);
	confirm_query($seat_set);
	return $seat_set;
}

function find_ticket_by_booking_id($booking_id) {
	global $connection;
	$safe_id    = mysqli_real_escape_string($connection, $booking_id);
	$query      = "SELECT * FROM Ticket WHERE booking_id = {$safe_id} LIMIT 1";
	$ticket_set = mysqli_query($connection, $query);
	confirm_query($ticket_set);
	if($ticket = mysqli_fetch_assoc($ticket_set)) {
		return $ticket;
	} else {
		return NULL;
	}
}

function member_navigation($production_array, $performance_array) {
	$output         = "<ul class='dropdown-menu' role='menu'>";
	$production_set = find_all_productions();
	while($production = mysqli_fetch_assoc($production_set)) {
		$output .= "<li";
		if($production_array && $production["production_id"] == $production_array["production_id"]) {
			$output .= " class='active'";
		}
		$output .= ">";
		$output .= "<a ";
		$performance_set = find_performances_for_production($production["production_id"]);
		if(mysqli_num_rows($performance_set) != 0) {
			$output .= " class='trigger right-caret'";
		} else {
			// if you want to link Production to a PHP page
			//$output .= " href='index.php?production=" . urlencode($production["production_id"]) . "'";
			$output .= " href='#' ";
			$output .= "  data-toggle='modal' data-target='.noProduction' ";
		}
		$output .= ">";
		$output .= htmlentities($production["production_name"]);
		$output .= "</a>";
		$output .= "<ul class='dropdown-menu sub-menu'>";
		while($performance = mysqli_fetch_assoc($performance_set)) {
			$output .= "<li";
			if($performance_array && $performance["performance_id"] == $performance_array["performance_id"]) {
				$output .= " class='active'";
			}
			$output .= ">";
			$output .= "<a href='customer.php?performance=";
			$output .= urlencode($performance["performance_id"]);
			$output .= "'>";
			$output .= htmlentities($performance["performance_name"]);
			$output .= "</a></li>";
		}
		$output .= "</ul>";
		mysqli_free_result($performance_set);
		$output .= "</li>"; // end of the production li
	}
	mysqli_free_result($production_set);
	$output .= "</ul>";
	return $output;
}

function navigation($production_array, $performance_array) {
	$output         = "<ul class='list-unstyled'>";
	$production_set = find_all_productions();
	while($production = mysqli_fetch_assoc($production_set)) {
		$output .= "<li";
		if($production_array && $production["production_id"] == $production_array["production_id"]) {
			$output .= " class='selected alert-success'";
		}
		$output .= ">";
		$output .= "<a href='manage_content.php?production=";
		$output .= urlencode($production["production_id"]);
		$output .= "'>";
		$output .= htmlentities($production["production_name"]);
		$output .= "</a>";
		$performance_set = find_performances_for_production($production["production_id"]);
		$output .= "<ul>";
		while($performance = mysqli_fetch_assoc($performance_set)) {
			$output .= "<li";
			if($performance_array && $performance["performance_id"] == $performance_array["performance_id"]) {
				$output .= " class='selected alert-success'";
			}
			$output .= ">";
			$output .= "<a href='manage_content.php?performance=";
			$output .= urlencode($performance["performance_id"]);
			$output .= "'>";
			$output .= htmlentities($performance["performance_name"]);
			$output .= "</a></li>";
		}
		mysqli_free_result($performance_set);
		$output .= "</ul></li>";
	}
	mysqli_free_result($production_set);
	$output .= "</ul>";
	return $output;
}

function find_selected_performance() {
	global $current_production;
	global $current_performance;
	if(isset($_GET["production"])) {
		$current_production  = find_production_by_id($_GET["production"]);
		$current_performance = NULL;
	} elseif(isset($_GET["performance"])) {
		$current_production  = NULL;
		$current_performance = find_performance_by_id($_GET["performance"]);
	} else {
		$current_production  = NULL;
		$current_performance = NULL;
	}
}

function find_member_by_id($id) {
	global $connection;
	$safe_id    = mysqli_real_escape_string($connection, $id);
	$query      = "SELECT * FROM Customers WHERE customer_id = '{$safe_id}' LIMIT 1";
	$member_set = mysqli_query($connection, $query);
	confirm_query($member_set);
	if($member = mysqli_fetch_assoc($member_set)) {
		return $member;
	} else {
		return NULL;
	}
}

function find_member_by_username($username) {
	global $connection;
	$safe_username = mysqli_real_escape_string($connection, $username);
	$query         = "SELECT * FROM Customers WHERE username = '{$safe_username}' LIMIT 1";
	$member_set    = mysqli_query($connection, $query);
	confirm_query($member_set);
	if($member = mysqli_fetch_assoc($member_set)) {
		return $member;
	} else {
		return NULL;
	}
}

function generate_salt($length) {
	// Not 100% unique, not 100% random, but good enough for a salt
	// MD5 returns 32 characters
	$unique_random_string = md5(uniqid(mt_rand(), true));

	// Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);

	// But not '+' which is valid in base64 encoding
	$modified_base64_string = str_replace('+', '.', $base64_string);

	// Truncate string to the correct length
	$salt = substr($modified_base64_string, 0, $length);

	return $salt;
}

function password_encrypt($password) {
	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
	$salt_length = 22;   // Blowfish salts should be 22-characters or more
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
}

function password_check($password, $existing_hash) {
	// existing hash contains format and salt at start
	$hash = crypt($password, $existing_hash);
	if ($hash === $existing_hash) {
		return true;
	} else {
		return false;
	}
}

function authenticate($username, $password) {
	$member = find_member_by_username($username);
	if($member) {
		// password_verify() needs PHP v5.5+
		if(password_check($password, $member["password"])) {
			return $member;
		} else {
			return FALSE;
		}
	} else {
		return FALSE;
	}
}

function signed_in() {
	return isset($_SESSION['customer_id']);
}

function confirm_signed_in() {
	if(!signed_in()) {
		//$_SESSION["errors"] = "You do not have any account. You need to create an account!";
		redirect_to("../../public/register.php");
		if(isset($_SERVER["HTTP_REFERER"])) {
			redirect_to($_SERVER["HTTP_REFERER"]);
		} else {
			redirect_to("../../public/index.php");
		}
	}
}

function staff_signed_in() {
	return isset($_SESSION['admin']);
}

function confirm_staff_signed_in() {
	if(!staff_signed_in()) {
		redirect_to("index.php");
	}
}

function public_navigation($production_array, $performance_array) {
	$output         = "<ul class='dropdown-menu' role='menu'>";
	$production_set = find_all_productions();
	while($production = mysqli_fetch_assoc($production_set)) {
		$output .= "<li";
		if($production_array && $production["production_id"] == $production_array["production_id"]) {
			$output .= " class='active'";
		}
		$output .= ">";
		$output .= "<a ";
		$performance_set = find_performances_for_production($production["production_id"]);
		if(mysqli_num_rows($performance_set) != 0) {
			$output .= " class='trigger right-caret'";
		} else {
			// if you want to link Production to a PHP page
			//$output .= " href='index.php?production=" . urlencode($production["production_id"]) . "'";
			$output .= " href='#' ";
			$output .= "  data-toggle='modal' data-target='.noProduction' ";
		}
		$output .= ">";
		$output .= htmlentities($production["production_name"]);
		$output .= "</a>";
		$output .= "<ul class='dropdown-menu sub-menu'>";
		while($performance = mysqli_fetch_assoc($performance_set)) {
			$output .= "<li";
			if($performance_array && $performance["performance_id"] == $performance_array["performance_id"]) {
				$output .= " class='active'";
			}
			$output .= ">";
			$output .= "<a href='production.php?performance=";
			$output .= urlencode($performance["performance_id"]);
			$output .= "'>";
			$output .= htmlentities($performance["performance_name"]);
			$output .= "</a></li>";
		}
		$output .= "</ul>";
		mysqli_free_result($performance_set);
		$output .= "</li>"; // end of the production li
	}
	mysqli_free_result($production_set);
	$output .= "</ul>";
	return $output;
}

function find_performance(array $cart) {
	global $connection;
	$whereIn         = implode(", ", $cart);
	$query           = "SELECT * FROM Performance WHERE performance_id IN ({$whereIn})";
	$performance_set = mysqli_query($connection, $query);
	confirm_query($performance_set);
	return $performance_set;
}