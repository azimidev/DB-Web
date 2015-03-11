<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php

// v1: simple logout
// session_start();
$_SESSION["admin"] = null;
$_SESSION["customer_id"] = null;
$_SESSION["customer_name"] = null;
//session_destroy();
redirect_to("index.php");
?>
