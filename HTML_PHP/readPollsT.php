<?php
	require_once("session.php");
	require_once("included_functions.php");
	verify_login();
	new_header("You-Vote", "readPollsT.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}


	//****************  Add Query
	//  Query people to select PersonID, FirstName, and LastName, sorting in ascending order by LastName
$query = "SELECT * ";
$query .= "FROM YV_Polls";

	//  Execute query
$result = $mysqli -> query($query);
// print_r($result);

// /********************    Uncomment Once Code Completed  **************************
	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Here are the Polls you've created</h2>";
		echo "<table>";
		echo "<tr><th>Poll</th><th></th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
  		echo "<td style='text-align:center'>"." ".$row['PollName']."</td>";
			echo "<td>&nbsp;<a href = 'editPeople.php?id=".urlencode($row["id"])."'>Edit</a>&nbsp;&nbsp;</td>";
			echo "<td>&nbsp;<a href = 'deletePeople.php?id=".urlencode($row["id"])." ' onclick='return confirm('Are you sure?');'>Delete</a>&nbsp;&nbsp;</td>";

			echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br /><a href='addPoll.php'>Create a New Poll</a> | <a href='logout.php'>Logout</a>";
		echo "</center>";
		echo "</div>";
	}
?>

<?php  new_footer("You-Vote", $mysqli); ?>
