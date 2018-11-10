<?php
require_once("session.php");
// checks to see if a user is logged in.
	verify_login();
?>
<?php
// Allows access to functions in included_functions.php
	require_once("included_functions.php");
	new_header("Admin - Add New User", "addUser.php");
	$mysqli = db_connection();

	if (($output = message()) !== null) {
		echo $output;
	}

	if (isset($_POST["submit"])) {
		// checks to make sure that the email and password text boxes are not empty and assigns the email and password to the corresponding variables.
		if (isset(isset(($_POST["email"] $$ $_POST["email"] !== "") && (($_POST["password"]) && $_POST["password"] !== "")) {
			$email = $_POST["email"];
			// assignes password to variable and encrypts.
			$password = password_encrypt($_POST["password"]);
			//Checks to make sure user email does not already exist.
			$query = "SELECT * FROM ";
			$query .= "YV_Users WHERE ";
			$query .= "email = '".$email."' ";
			$query .= "LIMIT 1";
			$result = $mysqli->query($query);

// User exists so output that the user already exists
		if ($result && $result->num_rows > 0) {
			$_SESSION["message"] = "The user already exists";
			redirect_to("addUser.php");
		}
//User does not already exist so add to YV_User table
		else {
			$query = "INSERT INTO YV_Users ";
			$query .= "(LName, FName, password, Email, GradYear, idSchool, idPermission) ";
			$query .= "VALUES ('LName', 'FName', '".$password."', '".$email."' 'GradYear', idPermission)";
			$result = $mysqli->query($query);
			if ($result) {
				$_SESSION["message"] = "User successfully added";
				redirect_to("addUser.php");
			}
			else {
				$_SESSION["message"] = "Could not add user!";
				redirect_to("addUser.php");
			}
		}
	}
}

?>

		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Add an administrator to You-Vote</h3>

<!-- information boxes for new administrator user -->
	<form action="addUser.php" method="post">
		<p>First Name: <input type="text" name="FName" /> </p>
		<p>LName: <input type="text" name="LName" value="" /> </p>
		<p>Last Name: <input type="text" name="LName" /> </p>
		<p>Password: <input type="password" name="password" value="" /> </p>
		<p>Email: <input type="text" name="Email" /> </p>
		<p>Password: <input type="password" name="password" value="" /> </p>
		<p>Permission Level: <input type="text" name="idPermission" value="" /> </p>
		<input type="submit" name="submit" class="button tiny round" value="Add Administrator" />
	</form>


			<p><br /><br /><hr />
			<h2>Current Admins</h2>

 <!-- Displays current Administrators.   -->

<?php
	$query = "SELECT * from YV_Users ";
	$query .= "WHERE idPermission = 1"
	$result = $mysqli->query($query);
	if ($result && $result->num_rows > 0) {
		echo "<table>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["email"]."</td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='deleteLogin.php?id=".$row["id"]."'>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table><hr /><br /><br />";
		}
?>

<!-- Link back to view Users -->
  	  <?php echo "<br /><p>&laquo:<a href='readPeople.php'>Back to View Users</a>"; ?>

	</div>
	</label>

<?php  new_footer("You-Vote", $mysqli); ?>
