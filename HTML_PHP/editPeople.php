<?php require_once("session.php");
	verify_login();
 ?>
<?php
	require_once("included_functions.php");
	new_header("Here is Who's who!", "CRUD/editPeople.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];
////////////////////////////////////////////////////////////////////////////////////////////
	    // STEP 4.
		// UPDATE query on $ID

		$query = "UPDATE people ";
		$query .= "SET FirstName = '".$_POST['FirstName']."'";
		$query .= ", LastName = '".$_POST['LastName']."'";
		$query .= ", Birthdate = '".$_POST['Birthdate']."'";
		$query .= ", BirthCity = '".$_POST['BirthCity']."'";
		$query .= ", BirthState = '".$_POST['BirthState']."'";
		$query .= ", Region = '".$_POST['Region']."'";
		$query .= " WHERE PersonID =".$ID.";";


///////////////////////////////////////////////////////////////////////////////////////////
		//Output query results and return to readPeople.php
		$result = $mysqli->query($query);

		//NOTE that we only check that $result was successful and DO NOT expect any rows to change
		if($result) {
			$_SESSION["message"] = $_POST["FirstName"]." ".$_POST["LastName"]." has been changed";
		}
		else {
			$_SESSION["message"] = "Error! Could not change ".$_POST["FirstName"]." ".$_POST["LastName"];
		}

		//Once the Edit has been completed (CHANGE button clicked)
		//redirect to the readPeople.php webpage
		header("Location: readPeople.php");
		exit;
	}
	else {
///////////////////////////////////////////////////////////////////////////////////////////
	  // STEP 1.
	  // GET id and create a query to SELECT * on the id

		if(isset($_GET["id"]) && $_GET["id"]!==""){
			$ID = $_GET["id"];
			$query = "SELECT * FROM people WHERE PersonID =".$ID.";";
			echo $query;
		}


///////////////////////////////////////////////////////////////////////////////////////////
		$result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<h3>".$row["FirstName"]." ".$row["LastName"]."'s Profile</h3>";

///////////////////////////////////////////////////////////////////////////////////////////
			// STEP 2.
			// Create form with inputs for each field in people table
			echo "<p><form action='editPeople.php?id={$ID}' method='post'>";
			echo '<p>First Name:<input type="text" name="FirstName" value="'.$row["FirstName"].'">';
			echo '<p>Last Name:<input type="text" name="LastName" value="'.$row["LastName"].'">';
			echo '<p>Birthdate (YYYY, MM, DD):<input type="text" name="Birthdate" value="'.$row["Birthdate"].'">';
			echo '<p>Birth City:<input type="text" name="BirthCity" value="'.$row["BirthCity"].'">';
			echo '<p>Birth State:<input type="text" name="BirthState" value="'.$row["BirthState"].'">';
			echo '<p>Region:<input type="text" name="Region" value="'.$row["Region"].'">';

			echo '<input type="submit" name="submit" class="button tiny round" value="Update Person" />';
			echo '</form>';

			// STEP 3.
			//Create input tags for each field in the person's table





///////////////////////////////////////////////////////////////////////////////////////////


			echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";
			echo "</label>";
			echo "</div>";

		}
		//Query failed to exit. Return to readPeople.php and output error
		else {
			$_SESSION["message"] = "Person could not be found!";
			header("Location: readPeople.php");
			exit;
		}
	}

?>
<?php  new_footer("Who's Who", $mysqli); ?>
