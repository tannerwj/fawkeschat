<?php 
	include "db_connect.php";
    $mydb = new DB_connect();
    
    $user = $_GET['user'];
    $friend = $_GET['friend'];
    $sql = "DELETE FROM private_chats WHERE (recipient = '$user' AND user_id = '$friend') OR (recipient = '$friend' and user_id = '$user');";
    $result = $mydb->runQuery($sql);

    header('Location: ../private_chats.php?removed=1&anon='.$friend.'');
?>
