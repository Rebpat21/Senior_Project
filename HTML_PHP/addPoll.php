<?php require_once("session.php");
	verify_login();
?>
<?php
	require_once("included_functions.php");
	new_header("You-Vote", "Senior_Project/readPollsT.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	echo "<h3>Add Poll to You-Vote Database</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["subject"]) && $_POST["subject"] !== "") ) {

			$query = "INSERT INTO YV_Polls ";
			$query .= "(subject, idTeacher, Created, Changed, Status) ";
			$query .= "VALUES (";
			$query .= "'".$_POST["subject"]."', ";
			$query .= "'".$_SESSION['admin_id']."', ";
			$query .= "'".date("Y-m-d, H:i:s")."', ";
			$query .= "'".date("Y-m-d, H:i:s")."', ";
			$query .= "'1') ";
			$result = $mysqli -> query($query);
			if($result) {

			$_SESSION["message"] = "New Poll has been created!";
				header("Location: readPollsT.php");
				exit;

			}
			else {

			$_SESSION["message"] = "Error! Could not add Poll";
			}
		}
		else {
			$_SESSION["message"] = "Unable to add Poll. Fill in all information!";
			header("Location: addPoll.php");
			exit;
		}
	}
	else {
						echo '<form action = "addPoll.php" method = "post">';
						echo '<p>Poll Title/Subject:<input type="text" name="subject">';
						// echo "<h4>Add Options</h4>";
						// echo '<p>Poll Title/Subject:<input type="text" name="Name">';

						echo '<input type="submit" name="submit" class="button tiny round" value="Submit" />';
						echo '</form>';
	}
	echo "</label>";
	echo "</div>";
	echo "<br /><p>&laquo:<a href='readPollsT.php'>Back to Polls Page</a>";
?>


<?php new_footer("You-Vote", $mysqli); ?>
