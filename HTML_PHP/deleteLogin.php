<?php require_once("session.php");
	verify_login();
 ?>
<?php
	require_once("included_functions.php");

	new_header("Users:", "");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	$ID = $_GET["id"];
	$query = "DELETE FROM YV_Users ";
	$query .= "WHERE idUsers = ".$ID;
	$result = $mysqli->query($query);
	if($result) {
		$_SESSION["message"] = "User deleted";
	}
	else {
		$_SESSION["message"] = "Unable to delete user";
	}

	redirect_to("addLogin.php");
?>
