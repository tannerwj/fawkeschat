<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if (login_check($mysqli) == true) {
		header('Location: profile.php');
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
</head>

<body>
	<?php include ('includes/header.php'); ?>

	<div class="container">
		<div class="jumbotron">
			<div class="alert alert-danger alert-dismissible" role="alert" <?php if(isset($_GET['error'])){if($_GET['error'] != '1'){echo "style='display: none;'";}}else{ echo "style='display: none;'";}?>>
  				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
  				<span class="sr-only">Close</span></button>
  				<strong>error: invalid creds:</strong> it appears that your credentials are incorrect.  if you have forgotten your email/password, sorry... 
			</div>
			<form class="form-horizontal" role="form" action='includes/process_login.php' method='post' name='login_form' id='login_form'>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">email</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" name='email' id='email' placeholder="email" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">password</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name='password' id='password' placeholder="password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">sign in</button>
					</div>
				</div>
			</form>
		 </div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
