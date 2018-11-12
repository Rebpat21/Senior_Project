<?php
	require_once("session.php");
	require_once("included_functions.php");
	verify_login();
	new_header("You-Vote", "Senior_Project/readPollsT.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

  $query = "SELECT * ";
  $query .= "FROM YV_Polls NATURAL JOIN YV_Users ";
  $query .= "WHERE idTeacher = idUsers";
	//  Execute query
$result = $mysqli -> query($query);
// print_r($result);

	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Here are all Polls</h2>";
		echo "<table>";
		echo "<tr><th>Poll</th><th>Teacher</th><th></th><th></th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			echo "<td style='text-align:center'>"." ".$row['subject']."</td>";
      echo "<td style='text-align:center'>"." ".$row['LName']."</td>";
			echo "<td>&nbsp;<a href = 'editPoll.php?id=".urlencode($row["id"])."'>Edit</a>&nbsp;&nbsp;</td>";
			echo "<td>&nbsp;<a href = 'deletePoll.php?id=".urlencode($row["id"])." ' onclick='return confirm('Are you sure?');'>Delete</a>&nbsp;&nbsp;</td>";
			echo "<td>&nbsp;<a href = 'voteT.php?id=".urlencode($row["id"])."'>View</a>&nbsp;&nbsp;</td>";

			echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br /><a href='addPoll.php'>Create a New Poll</a> | <a href='logout.php'>Logout</a>";
		echo "</center>";
		echo "</div>";
	}
?>

<?php  new_footer("You-Vote", $mysqli); ?>
