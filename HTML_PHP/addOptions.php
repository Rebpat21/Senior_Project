<?php
require_once("session.php");
verify_login();
// include 'styles/voteCSS.css';
require_once("included_functions.php");
?>

<?php

$mysqli = db_connection();
$ID = $_GET["id"];

if (($output = message()) !== null) {
  echo $output;

}
if (isset($_POST["submit"])) {
  if( (isset($_POST["Name"]) && $_POST["Name"] !== "") ) {

    $query = "INSERT INTO YV_Poll_Options (poll_id, Name, Created, Changed, Status) ";
    $query .= "VALUES (";
    $query .= "'".$ID."', ";
    $query .= "'".$_POST['Name']."', ";
    $query .= "'".date("Y-m-d, H:i:s")."', ";
    $query .= "'".date("Y-m-d, H:i:s")."', ";
    $query .= "'1')";
    $result = $mysqli -> query($query);
    if($result) {

      $_SESSION["message"] = "New poll option has been added!";
      header("Location: addOptions.php?id=".$ID);
      exit;

    }
    else {

      $_SESSION["message"] = "Error! Could not add poll option";
      header("Location: addOptions.php?id=".$ID);
    }
  }
  else {
    $_SESSION["message"] = "Unable to add poll option. Please fill in all information!";
    header("Location: addOptions.php?id=".$ID);
    exit;
  }
}
else {
  echo "<p><form action='addOptions.php?id={$ID}' method='post'>";
  echo '<p>Poll Option:<input type="text" name="Name">';

  echo '<input type="submit" name="submit" class="button tiny round" value="Add" />';
  echo '</form>';
}
echo "<br /><p>&laquo:<a href='readPollsT.php'>Back to Polls Page</a>";

echo "</label>";
echo "</div>";
?>

<?php new_footer("You-Vote", $mysqli); ?>
