<?php
	require_once("session.php");
	require_once("included_functions.php");
	verify_login();
	new_header("You-Vote", "Senior_Project/readPeople.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}


$query = "SELECT * FROM YV_Users NATURAL JOIN YV_Permissions ";
$query .= " WHERE idPermission = idPermissions ORDER BY LName ASC";

	//  Executes query
$result = $mysqli -> query($query);
// print_r($result);

	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Here is the Existing User Database</h2>";
		echo "<table>";
		echo "<tr><th>Name</th><th>Permission</th><th>Graduation Year</th><th></th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
  		echo "<td style='text-align:center'>"." ".$row['FName']." ".$row['LName']."</td>";
			echo "<td style='text-align:center'>"." ".$row['PermissionName']."</td>";
			echo "<td style='text-align:center'>"." ".$row['GradYear']."</td>";
			echo "<td>&nbsp;<a href = 'editPeople.php?id=".urlencode($row["idUsers"])."'>Edit</a>&nbsp;&nbsp;</td>";
			echo "<td>&nbsp;<a href = 'deletePeople.php?id=".urlencode($row["idUsers"])." ' onclick='return confirm('Are you sure?');'>Delete</a>&nbsp;&nbsp;</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br /><a href='addPeople.php'>Add a person</a> | <a href='addLogin.php'>Add an admin</a> | <a href = 'readPollsA.php'>View All Polls</a> | <a href='logout.php'>Logout</a>";
		echo "</center>";
		echo "</div>";
	}
?>

<?php  new_footer("You-Vote", $mysqli); ?>
