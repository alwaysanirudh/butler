<?php
// Last edited: 12/09/12, 3:41pm EST by Taylor Coffelt

/*  --------------IMPORTANT!!!-------------------
	This file is run every minute. Any changes to
	this file are effective IMMEDIATELY and affect
	ALL users.

	Do NOT make changes to this file unless you
	know what you are doing, AND have stopped the
	cron job running under "root" using:
	
	crontab -e
	---------------------------------------------
 */

/* SUMMARY:
	This file is for fetching the jobs out of the 'jobs' table in the Butler
	database and executing them. (e.g. Emails, Phone Calls, Notifications)

	Executed jobs should be stored in the database in another table so that
	the Butler AI can figure out future events are reminders on it's own.
*/

	// Include the Database file.
	include('db_fns.php');

	// Connect to the Database
	db_connect();

	// Testing:
	//email('taylorcoffelt@gmail.com', 'Hello, from Butler.', 'Testing at'.time().'</html>');

	// Disconnect from the Database
	db_disconnect();
?>