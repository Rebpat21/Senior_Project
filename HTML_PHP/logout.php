<?php require_once("session.php"); ?>
<?php require_once("final_functions.php"); 

new_header(); 
$mysqli = db_connection();
if (($output = message()) !== null) {
	echo $output;
}
if(!isset($_SESSION["username"])) {
	$_SESSION["message"] = "You must login in first!";
	header("Location: index2018.php");
	exit;
}
if (($output = message()) !== null) {
	echo $output;
}

 $_SESSION["username"] = NULL;
 header("Location: index2018.php");
 exit;
 ?>
