<?php require_once("session.php"); ?>
<?php
	require_once("included_functions.php");
	new_header("You-Vote", "");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

?>
<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//     Step 7.  Check email and password.  If all is good then set $_SESSION and log in
//				NOTE:  some of your code may be taken from addLogin.php step for, but you
//					   will need to be sure and set the $_SESSION variables

	if (isset($_POST["submit"])) {
		if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
		$_POST["password"] !== "") {
//Grab posted values for email and password.
//IMPORTANT CHANGE: Unlike in addLogin.php, you will NOT encrypt password
//Once we check if the email exists, we will do the encryption in
//the function password_check, which returns true if the passwords match
		$username = $_POST["username"];
		$password = $_POST["password"];
//Check whether the user is in the database
		$query = "SELECT * FROM ";
			$query .= "YV_Users WHERE ";
			$query .= "Email = '".$username."' ";
			$query .= "LIMIT 1";
			$result = $mysqli->query($query);
			if ($result && $result->num_rows > 0) {
				$row = $result->fetch_assoc();
				if (password_check($password, $row["Password"])) {
					$_SESSION["username"] = $row["username"];
					$_SESSION["admin_id"] = $row["idUsers"];
          if($row["idPermission"] = 3){
            redirect_to("readPollsStud.php");
          } elseif ($row["idPermission"] = 2) {
            redirect_to("readPollsT.php");
          } else {
            redirect_to("readPeople.php");

          }
				}
//If the attempted password DOES NOT match the database password, output an error
				else {
					$_SESSION["message"] = "Email/Password not found";
					redirect_to("index.php");
				}
			}
			else {
				$_SESSION["message"] = "Email/Password not found";
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

<?php  new_footer("You-Vote", $mysqli); ?>
