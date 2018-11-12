<?php require_once("session.php"); ?>
<?php
	require_once("included_functions.php");
	new_header("You-Vote", "Senior_Project/readPollsStud.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

?>
<?php

	if (isset($_POST["submit"])) {
		if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
		$_POST["password"] !== "") {
//Grab posted values for email and password.

//Once we check if the email exists, does the encryption in
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
					$_SESSION["username"] = $row["Email"];
					$_SESSION["admin_id"] = $row["idUsers"];
          if($row["idPermission"] == 3){
            redirect_to("readPollsStud.php");
          } elseif ($row["idPermission"] == 2) {
            redirect_to("readPollsT.php");
          } else {
            redirect_to("readPeople.php");

          }
				}
//If the attempted password DOES NOT match the database password, outputs an error
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


?>

		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Welcome!</h3>

			<form action="index.php" method="post">
				<p>Email: <input type="text" name="username" /> </p>
				<p>Password: <input type="password" name="password" value="" /> </p>
				<input type="submit" name="submit" class="button tiny round" value="Login" />
			</form>

	</div>
	</label>

<?php  new_footer("You-Vote", $mysqli); ?>
