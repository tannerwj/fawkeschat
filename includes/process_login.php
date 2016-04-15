<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

$mydb = new DB_connect();

$mysqli = $mydb->getDB();

if(isset($_POST['email'], $_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	if($stmt = $mysqli->prepare('SELECT user_id, password, salt, image, privacy FROM users WHERE email =? LIMIT 1')){
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($user_id, $db_password, $salt, $image, $privacy);
		$stmt->fetch();

		$password = hash('sha512', $password . $salt);
		if($stmt->num_rows == 1){
			if ($db_password == $password) {
				$user_browser = $_SERVER['HTTP_USER_AGENT'];

				$user_id = preg_replace('/[^0-9]+/', '', $user_id);
				$_SESSION['user_id'] = $user_id;
				$_SESSION['email'] = $email;
				$_SESSION['image'] = $image;
				$_SESSION['privacy'] = $privacy;
				$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
				header('Location: ../profile.php');
			}else{
				header('Location: ../login.php?error=1');
			}
		}else{
			header('Location: ../login.php?error=1');
		}
	}
}else{
	echo 'Invalid Request';
}