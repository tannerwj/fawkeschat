<?php
	include_once "db_connect.php";
	include_once 'functions.php';
	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if(isset($_POST['complaint'])){
		$complaint = $_POST['complaint'];
		$complaint = $mydb->clearText($complaint);
		$complaint = strtolower($complaint);

		$stmt = $mysqli->prepare("INSERT INTO complaints (message, user_id) VALUES (?,?)");
		$stmt->bind_param('ss', $complaint, $_SESSION['user_id']);
		$stmt->execute();
	}

	header( 'Location: ../profile.php' ) ;
?>