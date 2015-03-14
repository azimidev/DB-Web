<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php

// v1: simple logout
// session_start();
$_SESSION["admin"] = null;
$_SESSION["customer_id"] = null;
$_SESSION["customer_name"] = null;
// we can use function below to destroy the session completely
// but since customer might have performances into the cart session
// we don't use it. To use them just uncomment them:
//session_destroy();
//session_unset();
redirect_to("index.php");
?>
