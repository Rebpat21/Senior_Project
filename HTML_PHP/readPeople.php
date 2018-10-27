<?php
	require_once("session.php");
	require_once("included_functions.php");
	verify_login();
	new_header("Here is Who's Who!");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}


	//****************  Add Query
	//  Query people to select PersonID, FirstName, and LastName, sorting in ascending order by LastName
$query = "SELECT PersonID, FirstName, LastName ";
$query .= "FROM people ORDER BY LastName ASC";

	//  Execute query
$result = $mysqli -> query($query);
// print_r($result);

// /********************    Uncomment Once Code Completed  **************************
	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Here is Who's Who</h2>";
		echo "<table>";
		echo "<tr><th>Name</th><th></th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
  		echo "<td style='text-align:center'>"." ".$row['FirstName']." ".$row['LastName']."</td>";
			echo "<td>&nbsp;<a href = 'editPeople.php?id=".urlencode($row["PersonID"])."'>Edit</a>&nbsp;&nbsp;</td>";
			echo "<td>&nbsp;<a href = 'deletePeople.php?id=".urlencode($row["PersonID"])." ' onclick='return confirm('Are you sure?');'>Delete</a>&nbsp;&nbsp;</td>";






			//Create an Edit and Delete link
			//Edit should direct to editPeople.php, sending PersonID in URL
			//Delete should direct to deletePeople.php, sending PersonID in URL - include onclick to confirm delete


			echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br /><a href='addPeople.php'>Add a person</a> | <a href='addLogin.php'>Add an admin</a> | <a href='logout.php'>Logout</a>";
		echo "</center>";
		echo "</div>";
	}
// /************       Uncomment Once Code Completed For This Section  ********************/
?>

<?php  new_footer("Who's Who", $mysqli); ?>
