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

	$msg = "";

	if(isset($_POST['email'], $_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$msg .= '<p class="message">The email address you entered is not valid</p>';
		}

		$stmt = $mysqli->prepare("SELECT user_id FROM users WHERE email = ? LIMIT 1");

		if($stmt){
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->store_result();

			if ($stmt->num_rows == 1) {
				$msg .= '<p class="message">A user with this email address already exists.</p>';
			}
			$stmt->close();
		}else{
			$msg .= '<p class="message">Database error</p>';
			$stmt->close();
		}

		if(empty($msg)) {
			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
			$password = hash('sha512', $password . $random_salt);

			if($insert_stmt = $mysqli->prepare("INSERT INTO users (email, password, salt) VALUES (?,?,?)")){
				$insert_stmt->bind_param('sss', $email, $password, $random_salt);
				if(!$insert_stmt->execute()){
					$msg .= '<p class="message">Registration failure: INSERT</p>';
				}else{
					$msg .= "<p class='message'>Your account has been created. Would you like to <a href='login.php'>login?</a></p>";
				}
			}
		}
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
			<form class="form-horizontal" role="form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method='post' name='registration_form' id='registration_form'>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">email</label>
					<div class="col-sm-10">
						<input type="email" name='email' id='email' class="form-control" placeholder="email" autofocus>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label">password</label>
					<div class="col-sm-10">
						<input type="password" name='password' id='password' class="form-control" placeholder="password">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<?php if($msg) print $msg; ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">register</button>
					</div>
				</div>
			</form>
		 </div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
