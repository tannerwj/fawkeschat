<?php
	include_once "db_connect.php";
	include_once 'functions.php';
	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if(isset($_GET['num'])){
		$num = $_GET['num'];
		if($num < 0 || $num > 1){$num = 1;}
		$num = $mydb->clearText($num);
		$stmt = $mysqli->prepare("UPDATE users SET privacy = ? WHERE user_id = ?");
		$stmt->bind_param('ss', $num, $_SESSION['user_id']);
		$stmt->execute();

		$stmt = $mysqli->prepare("DELETE FROM private_chats WHERE user_id = ?");
		$stmt->bind_param('s', $_SESSION['user_id']);
		$stmt->execute();

		$stmt = $mysqli->prepare("DELETE FROM private_chats WHERE recipient = ?");
		$stmt->bind_param('s', $_SESSION['user_id']);
		$stmt->execute();

		$_SESSION['privacy'] = $num;
	}

	header( 'Location: ../profile.php' ) ;
?>