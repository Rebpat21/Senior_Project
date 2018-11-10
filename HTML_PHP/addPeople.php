<?php require_once("session.php");
	// verify_login();
?>
<?php
	require_once("included_functions.php");
	new_header("Database Users", "");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	echo "<h3>Add User to You-Vote Database</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["FirstName"]) && $_POST["FirstName"] !== "") && (isset($_POST["LastName"]) && $_POST["LastName"] !== "") &&(isset($_POST["Password"]) && $_POST["Password"] !== "") &&(isset($_POST["Email"]) && $_POST["Email"] !== "") &&(isset($_POST["GradYear"]) && $_POST["GradYear"] !== "") &&(isset($_POST["idPermission"]) && $_POST["idPermission"] !== "") ) {
			$query = "INSERT INTO YV_Users ";
			$query .= "(FName, LName, Password, Email, GradYear, idPermission) ";
			$query .= "VALUES (";
			$query .= "'".$_POST["FirstName"]."', ";
			$query .= "'".$_POST["LastName"]."', ";
			$query .= "'".$_POST["Password"]."', ";
			$query .= "'".$_POST["Email"]."', ";
			$query .= "'".$_POST["GradYear"]."', ";
			$query .= "'".$_POST["idPermission"]."') ";
			$result = $mysqli -> query($query);

			if($result) {

			$_SESSION["message"] = $_POST["FirstName"]." ".$_POST["LastName"]." has been added";
				header("Location: readPeople.php");
				exit;

			}
			else {

			$_SESSION["message"] = "Error! Could not change ".$_POST["FirstName"]." ".$_POST["LastName"];
			}
		}
		else {
			$_SESSION["message"] = "Unable to add person. Fill in all information!";
			header("Location: addPeople.php");
			exit;
		}
	}
	else {
						echo '<form action = "addPeople.php" method = "post">';
						echo '<p>First Name:<input type="text" name="FirstName">';
						echo '<p>Last Name:<input type="text" name="LastName">';
						echo '<p>Password:<input type="text" name="Password">';
						echo '<p>Email:<input type="text" name="Email">';
						echo '<p>GradYear:<input type="text" name="GradYear">';
						echo "Permissions: <select name = 'idPermissions'>";
						echo "<option></option>";

            		$query = "SELECT * FROM YV_Permissions";

                $result=$mysqli -> query($query);
                if($result&&$result -> num_rows>=1){
                  while($row=$result -> fetch_assoc()){
                    echo "<option value ='".$row['idPermissions']."'>".$row['PermissionName']."</option>";
                  }
                } else {
                  echo "<h2>No query results</h2>";
                }
            echo "</select>";

						echo '<input type="submit" name="submit" class="button tiny round" value="Add Person" />';
						echo '</form>';
	}
	echo "</label>";
	echo "</div>";
	echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";
?>


<?php new_footer("You-Vote", $mysqli); ?>
