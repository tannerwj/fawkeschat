<?php 
	include "db_connect.php";
    $mydb = new DB_connect();
    
    $user = $_GET['user'];
    $id = $_GET['anon'];
    $sql = "SELECT message, recipient, timestamp FROM private_chats WHERE (recipient = '$user' AND user_id = '$id') OR (recipient = '$id' and user_id = '$user') ORDER BY timestamp desc LIMIT 50;";
    $result = $mydb->runQuery($sql);

    while($row = mysqli_fetch_array($result)){
        $message = $row['message'];
        $recipient = $row['recipient'];
        $time = $row['timestamp'];
        $phpdate = strtotime( $time );
		$time = date( 'M d, g:i', $phpdate );
        	
        if($recipient == $id)
        {
        	echo "	<a href='#' class='list-group-item list-group-item-info'>
				<h4 class='list-group-item-heading' align='right'>".$message."</h4>
				<h6 class='list-group-item-text' align='right'>".$time."</h6>
			</a>";
        }
        else
        {
        	echo "	<a href='#' class='list-group-item'>
				<h4 class='list-group-item-heading'>".$message."</h4>
				<h6 class='list-group-item-text'>".$time."</h6>
			</a>";
        } 
    }
?>
