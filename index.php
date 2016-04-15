<?php
	include_once 'includes/db_connect.php';
	include_once 'includes/functions.php';

	sec_session_start();

	$mydb = new DB_connect();
	$mysqli = $mydb->getDB();

	if (login_check($mysqli) == true) {
		$logged = true;
	}else{
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
        <link rel="stylesheet" href="css/bootstrap-table.css">
	</head>

	<body>
		<?php include ('includes/header.php'); ?>

		<div class="container">
			<div class="jumbotron">
				<h1>fawkes chat
					<?php
					if(isset($_SESSION['image'])){
						$num = $_SESSION['image'];
						if($num != 0){
							$sql = "SELECT url FROM user_images WHERE image_id = $num;";
							$result = $mydb->runQuery($sql);
							$count = 0;
							while($row = mysqli_fetch_array($result)){
								echo "<img src='".$row['url']."' /></a>";
							}
						}
					}
					?>
				</h1>
				<p>welcome to the world of anonymous chatting...</p>
			</div>

			<div class="row">
		        <div class="col-md-4">
					<form role="form" action="includes/public_chat.php" method="post">
						<div class="form-group">
							<textarea id="chatter" class="form-control" rows="5" type="text" maxlength="255" name="message" placeholder="say something..." required></textarea>
						</div>
						<div align="center">
							<button type="submit" class="btn btn-default">submit</button>
							<button id='witty' class="btn btn-danger">witty comeback</button>
						</div>
					</form>
					<br>
				</div>
				<div class="col-md-8" id="tableHolder">
				</div>
				<div class="clearfix visible-lg"></div>
			</div>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="js/bootstrap-table.js"></script>
		<script src='js/functions.js'></script>
	</body>
</html>
