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

		$query2 = "SELECT Password FROM YV_Users WHERE idUsers =".$ID;
		$result2 = $mysqli->query($query2);
		$row2 = $result2->fetch_assoc();

		if(password_check($_POST['Password'], $row2['Password'])){
			$password = $row2['Password'];
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
		$query .= ", idPermission = '".$_POST['idPermission']."'";
		$query .= " WHERE idUsers =".$ID;


		//Outputs query results and returns to readPeople.php
		$result = $mysqli->query($query);

		if($result) {
			$_SESSION["message"] = $_POST["FName"]." ".$_POST["LName"]." has been changed";
		}
		else {
			$_SESSION["message"] = "Error! Could not change ".$_POST["FName"]." ".$_POST["LName"];
		}

		//Once the Edit has been completed, redirects to the readPeople.php
		header("Location: readPeople.php");
		exit;
	}
	else {

		if(isset($_GET["id"]) && $_GET["id"]!==""){
			$ID = $_GET["id"];
			$query = "SELECT * FROM YV_Users NATURAL JOIN YV_Permissions WHERE idUsers =".$ID;
			// echo $query;
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
			echo '<p>First Name:<input type="text" name="FName" value="'.$row["FName"].'">';
			echo '<p>Last Name:<input type="text" name="LName" value="'.$row["LName"].'">';
			echo '<p>Password:<input type="text" name="Password" value="'.$row["Password"].'">';
			echo '<p>Email:<input type="text" name="Email" value="'.$row["Email"].'">';
			echo '<p>GradYear:<input type="text" name="GradYear" value="'.$row["GradYear"].'">';
			echo "Permissions: <select name='idPermission'>";
						$query = "SELECT * FROM YV_Permissions NATURAL JOIN YV_Users ";
						$query .= "WHERE idPermissions = idPermission AND {$ID} = idUsers";

						$result=$mysqli -> query($query);
						$SR = $result->fetch_assoc();
						echo "<option value = '".$SR['idPermissions']."'>".$SR['PermissionName']."</option>";

								$query = "SELECT * FROM YV_Permissions WHERE idPermissions !=".$SR['idPermissions'];

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
		//Query failed to exit. Returns to readPeople.php and output error
		else {
			$_SESSION["message"] = "Person could not be found!";
			header("Location: readPeople.php");
			exit;
		}
	}

?>
<?php  new_footer("You-Vote", $mysqli); ?>
