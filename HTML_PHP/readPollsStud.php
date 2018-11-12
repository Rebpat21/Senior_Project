<?php
	require_once("session.php");
	require_once("included_functions.php");
	verify_login();
	new_header("You-Vote", "readPollsStud.php");
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

$query = "SELECT * ";
$query .= "FROM YV_Polls NATURAL JOIN YV_Users ";
$query .= "WHERE idTeacher = idUsers";

$result = $mysqli -> query($query);
// print_r($result);

	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Polls</h2>";
		echo "<table>";
		echo "<tr><th>Poll</th><th>Teacher</th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
  		echo "<td style='text-align:center'>"." ".$row['subject']."</td>";
			echo "<td style='text-align:center'>"." ".$row['LName']."</td>";
			echo "<td>&nbsp;<a href = 'vote.php?id=".urlencode($row["id"])."'>Vote</a>&nbsp;&nbsp;</td>";
			echo "</tr>";
		}
	}

?>
<a href='logout.php'>Logout</a>
<?php  new_footer("You-Vote", $mysqli); ?>
