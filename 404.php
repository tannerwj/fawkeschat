	<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if (login_check($mysqli) == true) {
		$logged = true;
	}else{
		$logged = false;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	 <title>fawkes chat | the worlds most impeccable anonymous chat system</title>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	 <style>
	 	.quote{
	 		text-align: center;
	 		font-size: 1.2em;
	 	}
	 	.quote p{
	 		font-size:80%;
	 	}
	 </style>
</head>

<body>
	<?php include ('includes/header.php'); ?>

	<div class="container">
		<div class="jumbotron">
			<h2>whoops, you've arrived at a page that doesn't exist</h2>
			<p>but im sure it was your fault, not ours...</p>
			<p>do you even internet?</p>
			<p>please uninstall</p>
			<blockquote class='quote'>
				<p>Now, what y'all wanna do?</p>
				<p>Wanna be hackers? Code crackers? Slackers</p>
				<p>Wastin' time with all the chatroom yakkers?</p>
				<p>9 to 5, chillin' at Hewlett Packard?</p>
				<p>What??</p>
				<footer>Weird Al Yankovic <cite title="Source Title">It's All About The Pentiums</cite></footer>
			</blockquote>
		 </div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
