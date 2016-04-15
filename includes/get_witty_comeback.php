<?php
	include_once 'db_connect.php';

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	$sql = "SELECT comeback FROM comebacks ORDER BY rand() LIMIT 1;";
	$result = $mydb->runQuery($sql);

	$row = mysqli_fetch_array($result);
	$comeback = $row['comeback'];

	echo $comeback;
