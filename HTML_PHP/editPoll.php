<?php require_once("session.php");
	verify_login();
 ?>
<?php
	require_once("included_functions.php");
	new_header("You-Vote", "Senior_Project/editPoll.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];

		// UPDATES query on $ID

		$query = "UPDATE YV_Polls ";
		$query .= "SET subject = '".$_POST['subject']."'";
		$query .= ", Changed = '".date("Y-m-d, H:i:s")."'";
		// $query .= ", Password = '".$password."'";
		// $query .= ", Email = '".$_POST['Email']."'";
		// $query .= ", GradYear = '".$_POST['GradYear']."'";
		// $query .= ", idPermission = '".$_POST['idPermission']."'";
		$query .= " WHERE id =".$ID;


		//Outputs query results and returns to readPeople.php
		$result = $mysqli->query($query);

		if($result) {
			$_SESSION["message"] = $_POST["subject"]." has been changed";
		}
		else {
			$_SESSION["message"] = "Error! Could not change ".$_POST["subject"];
		}

		//Once the Edit has been completed, redirects to the readPeople.php
    $ID = $_GET["id"];
		header("Location: editPoll.php?id=".$ID);
		exit;
	}
	else {

		if(isset($_GET["id"]) && $_GET["id"]!==""){
			$ID = $_GET["id"];
			$query = "SELECT * FROM YV_Polls WHERE id =".$ID;
			// echo $query;
		}

		$result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<h3>".$row["subject"]."</h3>";

			// Creates form with inputs for each field in people table
			echo "<p><form action='editPoll.php?id={$ID}' method='post'>";
			echo '<p>Subject:<input type="text" name="subject" value="'.$row["subject"].'">';
			echo '<input type="submit" name="submit" class="button tiny round" value="Update Subject" />';
			echo '</form>';

			echo "<br /><p>&laquo:<a href='readPollsT.php'>Back to Polls Page</a>";
      echo "<br /><p>&laquo:<a href='editOptions.php?id={$ID}'>Edit Poll Options</a>";
			echo "</label>";
			echo "</div>";

		}
		//Query failed to exit. Returns to readPeople.php and output error
		else {
			$_SESSION["message"] = "Poll could not be found!";
			header("Location: readPollsT.php");
			exit;
		}
	}

?>
<?php  new_footer("You-Vote", $mysqli); ?>
