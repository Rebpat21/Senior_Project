<?php require_once("session.php");
	verify_login();
	require_once("included_functions.php");
	new_header("You-Vote", "Senior_Project/readPollsT.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];
    // $pollID = $_GET["pollID"];

		$query = "UPDATE YV_Poll_Options ";
		$query .= "SET Name = '".$_POST['Name']."'";
		$query .= ", Changed = '".date("Y-m-d, H:i:s")."'";
		$query .= " WHERE id = ".$ID;
    // $query .= " AND poll_id = ".$pollID;


		$result = $mysqli->query($query);

		if($result) {
			$_SESSION["message"] = $_POST['Name']." has been changed.";
		}
		else {
			$_SESSION["message"] = "Error! Could not change Option: ".$_POST['Name'];
		}

    $ID = $_GET["id"];
    // $pollID = $_GET["pollID"];

		header("Location: editOptions.php?id=".$pollID);
		exit;
	}
	else {

		if(isset($_GET["id"]) && $_GET["id"]!==""){
			$ID = $_GET["id"];
			$query = "SELECT * FROM YV_Poll_Options WHERE id =".$ID;
			// echo $query;
      $result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<p><form action='editOption.php?id={$ID}' method='post'>";
			echo '<p>Subject:<input type="text" name="Name" value="'.$row["Name"].'">';
      // echo "<input type='hidden' name='pollID' value='".$row['id']."'>"
			echo '<input type="submit" name="submit" class="button tiny round" value="Update" />';
			echo '</form>';

			echo "<br /><p>&laquo:<a href='readPollsT.php'>Back to Polls Page</a>";
      echo "<br /><p>&laquo:<a href='editOptions.php?id={$ID}'>Back</a>";
			echo "</label>";
			echo "</div>";

		}
		else {
			$_SESSION["message"] = "Option could not be found!";
			header("Location: readPollsT.php");
			exit;
		}
	}
}

?>
<?php  new_footer("You-Vote", $mysqli); ?>
