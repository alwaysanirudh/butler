<?php

require_once "Mail.php";

$from = "<taylorcoffelt@gmail.com>";
$to = "<taylorcoffelt@gmail.com>";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$host = "ssl://smtp.gmail.com";
$port = "465";
$username = "taylorcoffelt@gmail.com";  //<> give errors
$password = "Boondoggle!";
$username = $_GET['u'];
$password = $_GET['p'];



$headers = array ('From' => $from,
		'To' => $to,
		'Subject' => $subject);

$smtp = Mail::factory('smtp',
	array ('host' => $host,
		'port' => $port)); #,
		// 'auth' => true,
		// 'username' => $username,
		// 'password' => $password));

$smtp->auth($from, array('consumer_key' => '', 'consumer_secret' => '', 'token' => '', 'token_secret' => ''), 'XOAUTH'))
$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
	echo("<p>" . $mail->getMessage() . "</p>");
 } else {
 	echo("<p>Message successfully sent!</p>");
 }
 ?>