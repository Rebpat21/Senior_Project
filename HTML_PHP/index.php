<?php require_once("session.php"); ?>
<?php
	require_once("included_functions.php");
	new_header("Who's Who Login", "");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

?>
<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//     Step 7.  Check username and password.  If all is good then set $_SESSION and log in
//				NOTE:  some of your code may be taken from addLogin.php step for, but you
//					   will need to be sure and set the $_SESSION variables

	if (isset($_POST["submit"])) {
		if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
		$_POST["password"] !== "") {
//Grab posted values for username and password.
//IMPORTANT CHANGE: Unlike in addLogin.php, you will NOT encrypt password
//Once we check if the username exists, we will do the encryption in
//the function password_check, which returns true if the passwords match
		$username = $_POST["username"];
		$password = $_POST["password"];
//Check whether the user is in the database
		$query = "SELECT * FROM ";
			$query .= "YV_Users WHERE ";
			$query .= "email = '".$username."' ";
			$query .= "LIMIT 1";
			$result = $mysqli->query($query);
//NOTE: This part differs from addLogin.php
//First check just the Username. If it’s found, then check password
//If the attempted password matches the database password then set two $_SESSION variables
//$_SESSION["username"] & $_SESSION[admin_id"]
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				if (password_check($password, $row["hashed_password"])) {
					$_SESSION["username"] = $row["username"];
					$_SESSION["admin_id"] = $row["id"];
					redirect_to("readPeople.php");
				}
//If the attempted password DOES NOT match the database password, output an error
				else {
					$_SESSION["message"] = "Username/Password not found";
					redirect_to("index.php");
				}
			}
			else {
				$_SESSION["message"] = "Username/Password not found";
				redirect_to("index.php");
			}
		} //closes second if-statement
	} //closes first if-statement



///////////////////////////////////////////////////////////////////////////////////////////////////////

?>

		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Welcome!</h3>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    Step 6. Create textboxes for Login -->
<!--            Note:  you can copy and paste from addLogin.php part 1b.  just be sure to change -->
<!--                   action = "addLogin.php"    to action = "index.php"  -->

			<form action="index.php" method="post">
				<p>Email: <input type="text" name="username" /> </p>
				<p>Password: <input type="password" name="password" value="" /> </p>
				<input type="submit" name="submit" class="button tiny round" value="Login" />
			</form>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->

	</div>
	</label>

<?php  new_footer("Who's Who", $mysqli); ?>
