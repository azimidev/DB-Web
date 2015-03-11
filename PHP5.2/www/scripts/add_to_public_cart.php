<?php require_once("../../includes/session.php"); ?>
<?php require_once("../../includes/db_connection.php"); ?>
<?php require_once("../../includes/functions.php"); ?>
<?php
if(empty($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}
array_push($_SESSION["cart"], $_GET["performance"]);
$_SESSION["message"] = "Performance was added to your cart!";
if(isset($_SERVER["HTTP_REFERER"])) {
	redirect_to($_SERVER["HTTP_REFERER"]);
} else {
	redirect_to("index.php");
}
?>
