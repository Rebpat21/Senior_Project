<?php

	session_start();

	function message() {
		if (isset($_SESSION["message"])) {

			$output = "<div class='row'>";
			$output .= "<div data-alert class='alert-box info round'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";

			$_SESSION["message"] = null;

			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];

			$_SESSION["errors"] = null;

			return $errors;
		}
	}

	function verify_login() {
		if(!isset($_SESSION["admin_id"])&& $_SESSION["admin_id"] === NULL) {
			$_SESSION["message"] = "You must login in first!";
			header("Location: index.php");
			exit;
		}
	}

?>
