<?php
// Last edited: 12/10/12, 8:17pm EST by Taylor Coffelt

/* SUMMARY:
	This file is for logging people in and out of the system.
	It may be upgraded at a later date to use the oAuth protocol,
	so that people can log in using their Google or Facebook
	profiles.
*/

include('../butler_db_fns.php');
db_connect();

if(isset($_POST['ajaxlogin'])){
	$loggedIn = standardLogin();
	if($loggedIn){
		$data = Array();
		$data['loggedIn'] 	= true;
		$data['UserID']		= $_SESSION['UserID'];
		$data['Name']		= $_SESSION['Name'];
		$data['Gender']		= $_SESSION['Gender'];
		$data['Codename']	= $_SESSION['Codename'];
		
		// Send a personal greeting.
		$data['html'] = "Good afternoon, ".$_SESSION['Name'].".<br>Please wait while I get ready for you.";
		$data['html'] = "<script>document.location = document.location;</script>";
		// echo a JSON array of data
		echo json_encode($data);
	}
	else{
		$data = Array();
		$data['loggedIn']	= false;

		// echo a JSON array of data
		echo json_encode($data);
	}
}
elseif (isset($_GET['logout'])) {
	# code for logging out...
	$_SESSION = Array(); // Just for good measure.
	unset($_SESSION);
	session_destroy();

	header('Location: index.php');
	exit();
}
else{
	echo "<b>Error.</b> You do not have access to this page.";
}

// Functions
function standardLogin(){
	// Check to see if they're already logged in
	if (isset($_SESSION['UserID'])) {
		// if they are, return True.
		return true;
	}
	else{
		// if not, attempt to log them in

		// Always trim and escape strings going into a database
		$username = mysql_escape_string(trim($_POST['username']));
		$password = mysql_escape_string(trim($_POST['password'])); # Don't allow spaces in password

		// Encrypt the password to match the stored version
		$password = sha1($password);

		// We're only going to pull important info from the database. No need to get
		// their encrypted password.
		$query = "SELECT ID, Name, Codename, Gender FROM `users` WHERE `Codename` = '$username' AND `password`='$password' LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());

		$num = mysql_num_rows($result);
		if ($num < 1) {
			// There's no match in the database.
			return false;
		}
		else{
			// Get the record from the database
			$user = mysql_fetch_array($result);
			// Setup the SESSION variables.
			$_SESSION['UserID']	=	$user['ID'];
			$_SESSION['Name']	=	$user['Name'];
			$_SESSION['Codename'] =	$user['Codename'];
			$_SESSION['Gender']	=	$user['Gender'];

			return True;
		}
	}
}
// ---------
?>
