<?php
include_once 'db_connect.php';
include_once 'functions.php';

sec_session_start();

$mydb = new DB_connect();
$mysqli = $mydb->getDB();

$id = $_SESSION['user_id'];

$sql = "DELETE FROM `users` WHERE `user_id` = $id";
$result = $mydb->runQuery($sql);

$sql = "DELETE FROM `private_chats` WHERE `user_id` = $id";
$result = $mydb->runQuery($sql);

$sql = "DELETE FROM `private_chats` WHERE `recipient` = $id";
$result = $mydb->runQuery($sql);

$_SESSION = array();
$params = session_get_cookie_params();
setcookie(session_name(),'', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

session_destroy();

$sql = "SELECT site FROM random_sites ORDER BY rand() LIMIT 1;";
$result = $mydb->runQuery($sql);

$row = mysqli_fetch_array($result);
$site = $row['site'];

header("Location: $site");