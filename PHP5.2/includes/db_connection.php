<?php
define("DB_SERVER", "studentnet.kingston.ac.uk");
define("DB_USER", "k1221692");
define("DB_PASS", "1234-asdf");
define("DB_NAME", "db_k1221692");

$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
	die("Database connection failed: " .
	    mysqli_connect_error() .
	    " (" . mysqli_connect_errno() . ")"
	);
}
?>