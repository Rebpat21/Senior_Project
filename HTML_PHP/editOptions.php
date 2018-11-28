<?php
	require_once("session.php");
	require_once("included_functions.php");
	verify_login();
	new_header("You-Vote", "Senior_Project/readPollsT.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	$ID = $_GET['id'];
	$query = "SELECT * FROM YV_Poll_Options WHERE poll_id =".$ID;

	$result = $mysqli -> query($query);
	// print_r($result);

	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Options</h2>";
		echo "<table>";
		echo "<tr><th>Option</th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
			echo "<td style='text-align:center'>"." ".$row['Name']."</td>";
			echo "<td>&nbsp;<a href = 'editOption.php?id=".urlencode($row["id"])."'>Edit</a>&nbsp;&nbsp;</td>";
			echo "</tr>";
		}
		echo "<table>";
	}

	echo "<br /><p>&laquo:<a href='readPollsT.php'>Back to Polls</a>";

?>
<?php  new_footer("You-Vote", $mysqli); ?>
