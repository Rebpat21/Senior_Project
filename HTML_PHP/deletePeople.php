<?php require_once("session.php");
	verify_login();
?>
<?php
	require_once("included_functions.php");
	new_header("YouVote", "Senior_Project/readPeople.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

  	if (isset($_GET["id"]) && $_GET["id"] !== "") {
 		$ID = $_GET["id"];
		// Query to delete this id from persons
		$query = "DELETE FROM YV_Users WHERE idUsers =".$ID;

		// Execute query
		$result = $mysqli->query($query);

		if ($result && $mysqli->affected_rows === 1) {
			$_SESSION["message"] = "User successfully deleted!";
			$output = message();
			echo $output;
			echo "<br /><br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";

		}
		else {
		$_SESSION["message"] = "Person could not be deleted!";
		redirect_to("readPeople.php");
		exit;
		}
	}
	else {
		$_SESSION["message"] = "Person could not be found!";
		redirect_to("readPeople.php");
		exit;
	}



?>

<?php  new_footer("You-Vote", $mysqli); ?>
