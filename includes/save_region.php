<?php
	include_once "db_connect.php";

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if(isset($_POST['lat'], $_POST['lng'])){
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];

		$stmt = $mysqli->prepare("INSERT INTO region (lat, lng) VALUES (?,?)");
		$stmt->bind_param('ss', $lat, $lng);
		$stmt->execute();
	}
?>