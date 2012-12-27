<?php
include('../butler_db_fns.php');
db_connect();

// Sign them up for a beta invite (when we go beta)
if((isset($_POST['name'])) && (trim($_POST['name'])!="") && (isset($_POST['email'])) && (trim($_POST['email'])!="")){
	// Always trim and escape strings going into a database
	$name = mysql_escape_string(trim($_POST['name']));
	$email = mysql_escape_string(trim($_POST['email']));
	$time = time();

	$query = "INSERT INTO `betasignup` (`Name`, `Email`, `Time`) VALUES ('$name', '$email', '$time')";
	$result = mysql_query($query) or die(json_encode(mysql_error()));

	$data = Array();
	$data['html'] 	= <<<EOT
	<div class="signTitle">
		Thank You!
		<div class="subtitle">We'll let you know right when Butler is ready for you. ;)</div>
	</div>
EOT;
	echo json_encode($data);
}
else{
	$data = Array();
	$data['html'] = "ouch.";
	echo json_encode($data);
}

?>
