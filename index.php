<?php
include('db_fns.php');

?><!DOCTYPE html>
<html>
	<head>
		<title>Butler</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		<link href="favicon.png" type="image/png" rel="shortcut icon">
	 	<link href="favicon.png" type="image/png" rel="icon">

		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/butler.css">
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css">
		<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>


		<!-- OPEN ID -->
		<link rel="openid2.provider" href="https://openid.stackexchange.com/openid/provider">
		<link rel="openid2.local_id" href="https://openid.stackexchange.com/user/1ab6e8f8-54a0-4943-8aa1-3c269d7cb388">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script src="https://github.com/davatron5000/FitText.js/raw/master/jquery.fittext.js"></script>
		<script src="https://github.com/zachleat/BigText/raw/master/bigtext.js"></script>

	</head>
	<body>
		<div class="login">
			<?php
			if(!check_logged_in()){
			?>
			<form action="login.php" method="POST" id="login">
				<div class='userDiv'>
					<input type="text" class="loginText" name="username" placeholder="Codename/Email">
				</div>
				<div class='passDiv'>
					<input type="password" class="loginText" name="password" placeholder="Password">
				</div>
				<div class='submitDiv'>
					<input type="submit" class="loginButton" name="login" value="login">
				</div>
			</form>
			<?php
			}
			else{
				echo "Welcome, ".$_SESSION['Name'].".";
				?>
				<a href="login.php?logout">Logout</a>
				<?php
			}
			?>
		</div>
		<div class="title">
			Butler
		</div>
		<div class="subtitle">
			At your service
		</div>
		<div class="wrap">
			<?php
				if(!check_logged_in()){
			?>
			<div class="leftInfo">
				<div class="thingsToSay">
					<div class="speech">"Butler, I have a meeting with Jeff on the 3rd. Remind me to prepare my notes tomorrow"</div>
					<div class="action">
						Butler will automatically connect to your calendar, schedule the meeting with Jeff on the next "third",
						and setup a	reminder for you to prepare your notes.
					</div>
				</div>
				<div class="thingsToSay">
					<div class="speech">"Butler, email Jeff and tell him that our next meeting has been canceled."</div>
					<div class="action">
						Butler will automatically email Jeff, and tell him that the meeting has been canceled in a very formal way.
					</div>
				</div>
			</div>
			<div class="rightSign">
				<div class="signup">
					<div class="signupwrap">
						<div class="signTitle">
							Get Butler
						</div>
						<form action="signup.php" method="POST">
							<div class="textInput">
								<input type="text" name="name" placeholder="Your Name">
								<input type="text" name="email" placeholder="Your Email">
								<input type="text" name="username" placeholder="Your Codename">
							</div>
							<div class="textInput">
								<input type="password" name="password" placeholder="Your Password">
								<input type="password" name="password2" placeholder="Your Password Again">
							</div>
						</form>
					</div>
					<div class="betaWrap">
						<div class="signTitle">
							Butler is in Alpha.
							<div class="subtitle">Sign up below for a beta invite.</div>
						</div>
						<form action="beta.php" id="beta" method="POST">
							<div class="textInput">
								<input type="text" name="name" placeholder="Your Name" x-webkit-speech speech onspeechchange="this.focus();">
								<input type="text" name="email" placeholder="Your Email">
							</div>
							<div class="submitInput">
								<input type="submit" name="submit" value="Let me Know!">
							</div>
						</form>
					</div>
				</div>

			</div>
		<?php
		}
		else{
		?>
		<div class="butlerWrap">
			<div class="butlerBack">
				<input class="butler" placeholder="Type or Speak" id="butler" x-webkit-speech speech>
			</div>
		</div>
		<div class="loading"><img src="images/trial4.gif" alt="Loading..."></div>
		<div class="cardWrap">
			<!-- <div class="card">
				<div class="cardTitle">I think..</div>
				<div class="cardContent">I think you said "Meeting".</div>
			</div> -->
		</div>
		<script type="text/javascript" src="scripts/butler.js"></script>
		<?php
		}
		?>
		</div>
		<script type="text/javascript" src="scripts/main.js"></script>
	</body>
</html>