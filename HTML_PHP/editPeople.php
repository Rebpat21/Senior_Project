<?php require_once("session.php");
	verify_login();
 ?>
<?php
	require_once("included_functions.php");
	new_header("You-Vote", "Senior_Project/editPeople.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];

		if($row["Password"] = $_POST['Password']){
			$password = $row['Password'];
		} else {
			$password = password_encrypt($_POST["Password"]);
		}

		// UPDATES query on $ID

		$query = "UPDATE YV_Users ";
		$query .= "SET FName = '".$_POST['FName']."'";
		$query .= ", LName = '".$_POST['LName']."'";
		$query .= ", Password = '".$password."'";
		$query .= ", Email = '".$_POST['Email']."'";
		$query .= ", GradYear = '".$_POST['GradYear']."'";
		$query .= ", idPermission = '".$_POST['idP']."'";
		$query .= " WHERE PersonID =".$ID;


		//Outputs query results and returns to readPeople.php
		$result = $mysqli->query($query);

		if($result) {
			$_SESSION["message"] = $_POST["FName"]." ".$_POST["LName"]." has been changed";
		}
		else {
			$_SESSION["message"] = "Error! Could not change ".$_POST["FName"]." ".$_POST["LName"];
		}

		//Once the Edit has been completed, redirects to the readPeople.php webpage
		header("Location: readPeople.php");
		exit;
	}
	else {

		if(isset($_GET["id"]) && $_GET["id"]!==""){
			$ID = $_GET["id"];
			$query = "SELECT * FROM YV_Users WHERE idUsers =".$ID;
			echo $query;
		}

		$result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<h3>".$row["FName"]." ".$row["LName"]."'s Profile</h3>";

			// Creates form with inputs for each field in people table
			echo "<p><form action='editPeople.php?id={$ID}' method='post'>";
			echo '<p>First Name:<input type="text" name="FirstName" value="'.$row["FName"].'">';
			echo '<p>Last Name:<input type="text" name="LastName" value="'.$row["LName"].'">';
			echo '<p>Password:<input type="text" name="Password" value="'.$row["Password"].'">';
			echo '<p>Email:<input type="text" name="Email" value="'.$row["Email"].'">';
			echo '<p>GradYear:<input type="text" name="GradYear" value="'.$row["GradYear"].'">';
			echo 'Permission: <select name="idP">';
			echo "<option>""</option>";

					$query = "SELECT idPermissions, PermissionName FROM YV_Permissions";

					$result=$mysqli -> query($query);
					if($result&&$result -> num_rows>=1){
						while($row=$result -> fetch_assoc()){
							echo "<option value ='".$row['idPermissions']."'>".$row['PermissionName']."</option>";
						}
					} else {
						echo "<h2>No query results</h2>";
					}
			echo "</select>";
			echo '<input type="submit" name="submit" class="button tiny round" value="Update User" />';
			echo '</form>';

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
<?php  new_footer("You-Vote", $mysqli); ?>
