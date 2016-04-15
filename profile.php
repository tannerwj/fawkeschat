<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if (login_check($mysqli) == true) {
		$logged = true;
	}else{
		header('Location: index.php');
		$logged = false;
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
		<div class="jumbotron">
			<h1>
				welcome to fawkes chat
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
		<h2>your anonymous options</h2>
		<div class="list-group">
			<a href="index.php" class="list-group-item">
				<h4 class="list-group-item-heading">public chat</h4>
				<p class="list-group-item-text">go back and chat with the unruly public</p>
			</a>
			<a href="private_chats.php" class="list-group-item">
				<h4 class="list-group-item-heading">private chat</h4>
				<p class="list-group-item-text">private chat with another anonymous user</p>
			</a>
			<a data-toggle="modal" data-target="#myModal" class="list-group-item">
				<h4 class="list-group-item-heading">choose a user image</h4>
				<p class="list-group-item-text">these don't matter at all, but you'll choose one anyways (you can't undo this?)</p>
			</a>
			<a data-toggle="modal" data-target="#myModal2" class="list-group-item">
				<h4 class="list-group-item-heading">choose your privacy settings</h4>
				<p class="list-group-item-text">cause you're not already private enough i guess...</p>
			</a>
			<a href="complain.php" class="list-group-item">
				<h4 class="list-group-item-heading">submit a complaint</h4>
				<p class="list-group-item-text">we probably won't read it, but hey, go for it</p>
			</a>
			<a href="includes/delete_everything.php" class="list-group-item">
				<h4 class="list-group-item-heading">delete everything</h4>
				<p class="list-group-item-text">
					is the fbi at the door?	are things getting too hot? have you been compromised? delete your user and chats to leave no trace
				</p>
			</a>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">choose an image...</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
		      		<?php
						$sql = "SELECT * FROM user_images";
						$result = $mydb->runQuery($sql);
						$count = 0;
						while($row = mysqli_fetch_array($result)){
							echo "<div class='col-md-4'><a href='includes/choose_image.php?num=".$row['image_id']."'><img src='".$row['url']."' /></a></div>";
							if(++$count % 3 == 0){
								echo "</div><div class='row'>";
							}
						}
					?>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="myModalLabel">choose a setting...</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
		      		<div class="list-group">
		      		<?php
						$sql = "SELECT * FROM privacy_settings";
						$result = $mydb->runQuery($sql);
						$count = 0;
						while($row = mysqli_fetch_array($result)){
							echo "<a href='includes/choose_privacy.php?num=".$row['value']."' class='list-group-item'>";
							echo "<h4 class='list-group-item-heading'>privacy setting #".$row['privacy_id']."</h4>";
							echo "<p class='list-group-item-text'>".$row['description']."</p></a>";
						}
					?>
					</div>
				</div>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
