<?php require_once("session.php");
	verify_login();
?>
<?php
	require_once("included_functions.php");
	new_header("You-Vote", "Senior_Project/readPeople.php");
	$mysqli = db_connection();
// Redirects to index.php if there is not a SESSION admin_id set


	if (($output = message()) !== null) {
		echo $output;
	}

//  Checks to see if username and password text boxes are filled in.
//  If they are, then checks to see if the username already exists
//  If the username does not exist, adds the username and their hashed password
//  to the YV_Users table in database

	if (isset($_POST["submit"])) {
		if (isset($_POST["FName"]) && $_POST["FName"] !== "" && isset($_POST["LName"]) && $_POST["LName"] !== "" && isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
			$_POST["password"] !== "") {
//Grabs values for username and password. Encrypts the password so that
// it is set up to compare with the encrypted password in the database. Uses password_encrypt
			$username = $_POST["username"];
			$password = password_encrypt($_POST["password"]);
// Checks to make sure user does not already exist
			$query = "SELECT * FROM ";
			$query .= "YV_Users WHERE ";
			$query .= "username = '".$username."' ";
			$query .= "LIMIT 1";
			$result = $mysqli->query($query);

//User exists so output that the user already exists
		if ($result && $result->num_rows > 0) {
			$_SESSION["message"] = "The username already exists";
			redirect_to("addLogin.php");
		}
//User does not already exist so add to Users table
		else {
			$query = "INSERT INTO YV_Users (FName, LName, Password, Email, GradYear, idPermission) ";
			$query .= "VALUES (";
			$query .= "'".$_POST["FName"]."', ";
			$query .= "'".$_POST["LName"]."', ";
			$query .= "'".$password."', ";
			$query .= "'".$username."', ";
			$query .= "'NA', '1')";

			$result = $mysqli->query($query);
			if ($result) {
				$_SESSION["message"] = "User successfully added";
				redirect_to("addLogin.php");
			}
			else {
				$_SESSION["message"] = "Could not add user!";
				redirect_to("addLogin.php");
			}
		}
	}
}

?>

		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Add an administrator to You-Vote</h3>

<!-- Creates a form with textboxes for adding FName, LName, username and password -->

	<form action="addLogin.php" method="post">
		<p>First Name: <input type="text" name="FName" /> </p>
		<p>Last Name: <input type="text" name="LName" /> </p>
		<p>Email: <input type="text" name="username" /> </p>
		<p>Password: <input type="password" name="password" value="" /> </p>
		<input type="submit" name="submit" class="button tiny round" value="Add Administrator" />
	</form>

			<p><br /><br /><hr />
			<h2>Current Admins</h2>

<!-- Displays current Administrators. Also provides a link next to each person that allows admin to delete them from database -->
<?php
	$query = "SELECT * from YV_Users ";
	$query .= "WHERE idPermission = 1 ";
	$query .= "ORDER BY LName ASC";
	$result = $mysqli->query($query);
	if ($result && $result->num_rows > 0) {
		echo "<table>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["FName"]." ".$row["LName"]."</td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='deleteLogin.php?id=".$row["id"]."'>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table><hr /><br /><br />";
		}
?>

  	  <?php echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>"; ?>

	</div>
	</label>

<?php  new_footer("You-Vote", $mysqli); ?>
