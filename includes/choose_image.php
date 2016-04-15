<?php
	include_once "db_connect.php";
	include_once 'functions.php';
	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if(isset($_GET['num'])){
		$num = $_GET['num'];
		if($num <= 0 || $num >= 10){$num = 0;}
		$num = $mydb->clearText($num);

		$stmt = $mysqli->prepare("UPDATE users SET image = ? WHERE user_id = ?");
		$stmt->bind_param('ss', $num, $_SESSION['user_id']);
		$stmt->execute();

		$_SESSION['image'] = $num;
	}

	header( 'Location: ../profile.php' ) ;
?>