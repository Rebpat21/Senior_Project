<?php require_once("session.php");
	verify_login();
?>
<?php
	require_once("included_functions.php");
	new_header("Admin - Add New User", "addUser.php");
	$mysqli = db_connection();
///////////////////////////////////////////////////////////////////////////////////
//  Step 9  -  invoke verify_login
//				Will redirect to index.php if there is not a SESSION admin_id set


///////////////////////////////////////////////////////////////////////////////////

	if (($output = message()) !== null) {
		echo $output;
	}

///////////////////////////////////////////////////////////////////////////////////////////////
//  Step 4.  Check to see if username and password text boxes are filled in.
//           If they are, then first check to see if the username already exists
//           If the user name does not exist, then add the username and their hashed password
//               to the admins table in your database

	if (isset($_POST["submit"])) {
		if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
			$_POST["password"] !== "") {
//Grab posted values for username and password. Immediately encrypt the password so that
// it is set up to compare with the encrypted password in the database Use password_encrypt
			$username = $_POST["username"];
			$password = password_encrypt($_POST["password"]);
//Check to make sure user does not already exist
			$query = "SELECT * FROM ";
			$query .= "YV_Users WHERE ";
			$query .= "username = '".$username."' ";
			$query .= "LIMIT 1";
			$result = $mysqli->query($query);

//User exists so output that the user already exists
		if ($result && $result->num_rows > 0) {
			$_SESSION["message"] = "The username already exists";
			redirect_to("addUser.php");
		}
//User does not already exist so add to admins table
		else {
			$query = "INSERT INTO YV_Users ";
			$query .= "(LName, FName, hashed_password, GradYear, idSchool, idPermission) ";
			$query .= "VALUES ('".$username."', '".$password."')";
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

////////////////////////////////////////////////////////////////////////////////////////////////
?>

		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Add an administrator to Who's Who!</h3>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    Step 2. Create a form with textboxes for adding both a username and password -->

	<form action="addUser.php" method="post">
		<p>Username: <input type="text" name="username" /> </p>
		<p>Password: <input type="password" name="password" value="" /> </p>
		<input type="submit" name="submit" class="button tiny round" value="Add Administrator" />
	</form>



<!--///////////////////////////////////////////////////////////////////////////////////////////////// -->


			<p><br /><br /><hr />
			<h2>Current Admins</h2>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    Step 3. Display current Administrators.  Also provide a link next to each person that allows you to delete -->
<!--            them from your database This requires including their id # in the query string -->

<?php
	$query = "SELECT * from admins";
	$result = $mysqli->query($query);
	if ($result && $result->num_rows > 0) {
		echo "<table>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$row["username"]."</td>";
			echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href='deleteLogin.php?id=".$row["id"]."'>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table><hr /><br /><br />";
		}
?>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->

  	  <?php echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>"; ?>

	</div>
	</label>

<?php  new_footer("Who's Who", $mysqli); ?>
