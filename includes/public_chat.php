<?php
	include "db_connect.php";
	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();
	$message = $_POST['message'];
	$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

	$message = strtolower($message);

	$sql = "SELECT * FROM substitutions;";
	$result = $mydb->runQuery($sql);

	while($row = $result->fetch_assoc()){
		$message = str_replace($row['text_from'], $row['text_to'], $message);
	}
	$stmt = $mysqli->prepare("INSERT INTO public_chats (message) VALUES (?)");
	$stmt->bind_param('s', $message);
	$stmt->execute();

	header( 'Location: ../index.php' ) ;
?>