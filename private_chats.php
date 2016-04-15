<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if(login_check($mysqli) == true) {
		$logged = true;
	}else{
		header('Location: profile.php');
		$logged = false;
	}

	if($_SESSION['privacy'] == 0) {
		header('Location: profile.php');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	 <title>fawkes chat | the worlds most impeccable anonymous chat system</title>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<body>
	<?php include ('includes/header.php'); ?>

	<div class="container">
		<div class="alert alert-success alert-dismissible" role="alert" <?php if(isset($_GET['removed'])){if($_GET['removed'] != '1'){echo "style='display: none;'";}}else{ echo "style='display: none;'";}?>>
  			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
  			<span class="sr-only">Close</span></button>
  			<strong>deleted chat:</strong> your private chat with chatter #<?php echo $_GET['anon'] ?> was successfully deleted. 
		</div>
		<div class="jumbotron">
			<h1>fawkes private chats
			<?php
					$num = $_SESSION['image'];
					if($num != 0){
						$sql = "SELECT url FROM user_images WHERE image_id = $num;";
						$result = $mydb->runQuery($sql);
						$count = 0;
						while($row = mysqli_fetch_array($result)){
							echo "<img src='".$row['url']."' /></a>";
						}
					}
				?>
			</h1>
			<p>anonymous chatter #<?php echo $_SESSION['user_id']; ?></p>
		</div>
		<div class="row">
			<div class="alert alert-danger alert-dismissible" role="alert" <?php if(isset($_GET['failedchat'])){if($_GET['failedchat'] != '1'){echo "style='display: none;'";}}else{ echo "style='display: none;'";}?>>
  				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
  				<span class="sr-only">Close</span></button>
  				<strong>error:self-chatting:</strong> the act of being so lame that you can't have a conversation with someone else even on an anonymous chat site. 
			</div>
		</div>
		<div class="row">
            <div class="col-md-4">
				<h2>start a new private chat</h2>
				<div class="list-group">
					<form role="form" action="includes/start_chat.php" method="post">
		                <div class="form-group">
		                	<input type="hidden" name="self" value=<?php echo "'".$_SESSION['user_id']."'"; ?>>
		                    <input class="form-control" type="number" name="id" placeholder="input their chatter #..." min="1" max="999999" required>
		                </div>
		                <div>
		                    <button type="submit" class="btn btn-default">submit</button>
		                </div>
		            </form>
				</div>
			</div>
			<div class="col-md-8">
					<?php
					    $user = $_SESSION['user_id'];
					    $sql = "SELECT DISTINCT user_id FROM private_chats WHERE recipient = '$user' ORDER BY timestamp desc;";
					    $result = $mydb->runQuery($sql);
					     $num_rows = mysqli_num_rows($result);
					    if($num_rows > 0)
					    {
					    	echo "	<h2>your private chats</h2>
									<div class='list-group'>";
						    while($row = mysqli_fetch_array($result)){
						        $id = $row['user_id'];
						       	$sql = "SELECT message FROM private_chats WHERE recipient = '$user' AND user_id = '$id' ORDER BY timestamp desc LIMIT 1;";
						       	$result2 = $mydb->runQuery($sql);
						       	if(isset($result2))
						       	{
						       		$row2 = mysqli_fetch_array($result2);
						       		$message = $row2['message'];
						     		echo "	<a href='messages.php?anon=".$id."' class='list-group-item'>
											<h4 class='list-group-item-heading'>anonymous chatter #".$id."</h4>
											<p class='list-group-item-text'>".$message."</p>
										</a>";
						       	}
						    }
						    echo "</div>";
						}
					    $sql ="SELECT DISTINCT recipient 
					    			FROM private_chats 
					    			WHERE recipient NOT in (SELECT DISTINCT user_id 
					    										FROM private_chats 
					    										WHERE recipient = '$user') 
										AND user_id = '$user' 
					    			ORDER BY timestamp desc";
					    $result3 = $mydb->runQuery($sql);
					    $num_rows2 = mysqli_num_rows($result3);
					    if($num_rows2 > 0)
					    {
					    	echo "	<h2>your pending chats</h2>
									<div class='list-group'>";
						    while($row = mysqli_fetch_array($result3)){
						    	$num = $row['recipient'];
						    	echo "	<a href='messages.php?anon=".$num."' class='list-group-item'>
											<h4 class='list-group-item-heading'>anonymous chatter #".$num."</h4>
										</a>";
						    }
						    echo "</div>";
					    }

					 ?>
		</div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
