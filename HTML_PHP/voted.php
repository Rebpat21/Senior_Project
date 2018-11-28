<?php
require_once("session.php");
verify_login();
require_once("included_functions.php");
 ?>

<?php
$mysqli = db_connection();
if (($output = message()) !== null) {
  echo $output;
}
$ID = $_GET['id'];
$pollID = $_GET['pollID'];

$query = "INSERT INTO hasVoted (idPoll, idU) VALUES ('".$pollID."', '".$ID."')";
$result = $mysqli -> query($query);

if($result) {

  header("Location: readPollsStud.php");
  exit;

}
else {

$_SESSION["message"] = "Error!";

header("Location: index.php");
exit;

}

 ?>
