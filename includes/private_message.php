<?php

	include "db_connect.php";
	$mydb = new DB_connect();
	$you = $_POST['you'];
	$user = $_POST['user'];
	$message = $_POST['message'];
	$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

	$you = $mydb->clearText($you);
	$user = $mydb->clearText($user);
	$message = $mydb->clearText($message);
	$message = strtolower($message);

	$sql = "INSERT INTO private_chats(message, user_id, recipient) VALUES('$message', $you, $user);";
	$result = $mydb->runQuery($sql);

	header( 'Location: ../messages.php?anon='.$user.'' ) ;

 ?>