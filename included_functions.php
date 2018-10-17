
<?php

function db_connection(){
  require_once("/home/ptfreel/DBfreel.php");

  $mysqli = new mysqli(DBHOST, USERNAME, PASSWORD, DBNAME);

  if($mysqli -> connect_errno){
    die("Could not connect to server!");
  } else {
  echo "Successful connection to ".DBNAME."<hr />";
  }
  return $mysqli;
}

	function password_encrypt($password) {
	  $hash_format = "$2y$10$";
	  $salt_length = 22;
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
	  return $hash;
	}

	function generate_salt($length) {
	  $unique_random_string = md5(uniqid(mt_rand(), true));

	  $base64_string = base64_encode($unique_random_string);

	  $modified_base64_string = str_replace('+', '.', $base64_string);

	  $salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}

	function password_check($password, $existing_hash) {
	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  }
	  else {
	    return false;
	  }
	}

	function redirect_to($new_location) {
		header("Location: " . $new_location);
		exit;
	}

	// function new_header($name="Default", $urlLink="") {
	// 	echo "<head>";
	// 	echo "	<title>$name</title>";
	// 	echo "	<link rel='stylesheet' href='css/normalize.css'>";
	// 	echo "	<link rel='stylesheet' href='css/foundation.css'>";
  //
	// 	echo "	<script src='js/vendor/modernizr.js'></script>";
	// 	echo "</head>";
	// 	echo "<body>";
	// 	echo "<div class='contain-to-grid sticky'>";
	// 	echo "<nav class='top-bar' data-topbar data-options='sticky_on: large'>";
	// 	echo "<ul class='title-area'>";
	// 	echo "<li class='name'>";
	// 	echo "  <h1 align='left'><a href='/~ptfreel/".$urlLink."'>$name</a></h1>";
	// 	echo "</li>";
	// 	echo "</ul>";
	// 	echo "</nav>";
	// 	echo "</div>";
	// 	echo "<body>";
	// }

	function new_footer($name="Default", $mysqli){
		echo "<br /><br /><br />";
	    echo "<h4><div class='text-center'><small>Copyright ".date("M Y").", ".$name."</small></div></h4>";
		echo "</body>";
		echo "</html>";
		$mysqli -> close;
	}

	function print_alert($name="") {
		echo "<br />";
		echo "<div class='row'>";
		echo "<div data-alert class='alert-box info round'>".$name;

		echo "</div>";
		echo "</div>";

	}

?>
