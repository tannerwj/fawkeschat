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
	 <title>fawkes chat | the worlds most impeccable anonymous chat system</title>
	 <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>

<body>
	<?php include ('includes/header.php'); ?>

	<div class="container">
		<div class="jumbotron">
			<h1>complain for some reason<?php
					$num = $_SESSION['image'];
					if($num != 0){
						$sql = "SELECT url FROM user_images WHERE image_id = $num;";
						$result = $mydb->runQuery($sql);
						$count = 0;
						while($row = mysqli_fetch_array($result)){
							echo "<img src='".$row['url']."' /></a>";
						}
					}
				?></h1>
			<p>i don't know why you would anonymous chatter #<?php echo $_SESSION['user_id']; ?></p>
		</div>
		<div class="row">
            <div class="col-md-10 " align="center">
				<form role="form" action="includes/submit_complaint.php" method="post">
					<div class="form-group">
						<textarea id="complain" name='complaint' class="form-control" rows="5" type="text" maxlength="255" placeholder="complain why don't you..." required></textarea>
					</div>
					<div align="center">
						<button type="submit" class="btn btn-default">submit</button>
					</div>
				</form>
                <div class="clearfix visible-lg"></div>
            </div>
        </div>
	</div>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
