<?php
session_start();
// Store messages into the session
function message() {
	if(isset($_SESSION["message"])) {
		$output = "<div class='alert alert-info alert-dismissible' role='alert'>";
		$output .= "<button type='button' class='close' data-dismiss='alert'>";
		$output .= "<span aria-hidden='true'>&times;</span>";
		$output .= "<span class='sr-only'></span>";
		$output .= "</button>";
		$output .= "<span class='glyphicon glyphicon-info-sign'></span>";
		$output .= " <strong>" . htmlentities($_SESSION["message"]) . "</strong>";
		$output .= "</div>";
		// clear message after use
		$_SESSION["message"] = NULL;
		return $output;
	}
}

// Store errors into the session
function errors() {
	if(isset($_SESSION["errors"])) {
		$errors = "<div class='alert alert-danger alert-dismissible' role='alert'>";
		$errors .= "<button type='button' class='close' data-dismiss='alert'>";
		$errors .= "<span aria-hidden='true'>&times;</span>";
		$errors .= "<span class='sr-only'></span>";
		$errors .= "</button>";
		$errors .= "<span class='glyphicon glyphicon-remove-circle'></span>";
		$errors .= " <strong>" . htmlentities($_SESSION["errors"]) . "</strong>";
		$errors .= "</div>";
		// clear error after use
		$_SESSION["errors"] = NULL;
		return $errors;
	}
}

?>