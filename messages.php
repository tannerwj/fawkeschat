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

	if($_SESSION['user_id'] == $_GET['anon']) {
		header('Location: private_chats.php?failedchat=1');
	}

	if(!isset($_GET['anon']))
	{
		header('Location: private_chats.php');
	}
	else
	{
		if($_GET['anon'] > 999999)
		{
			header('Location: private_chats.php');
		}
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
	 <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	 <script type="text/javascript">

            $(document).ready(function(){
                refreshTable();
            });

            function refreshTable(){
                $('#messageHolder').load('includes/load_messages.php?anon=<?php echo $_GET['anon'] ?>&user=<?php echo $_SESSION['user_id'] ?>', function(){
                    setTimeout(refreshTable, 5000);
                });
            }
        </script>
</head>

<body>
	<?php include ('includes/header.php'); ?>

	<div class="container">
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
            <div class="col-md-8">
				<h2>anonymous chatter #<?php echo $_GET['anon'] ?></h2>
				<form role="form" action="includes/private_message.php" method="post">
	                    <div class="form-group">
	                    	<input type="hidden" name="you" value=<?php echo "'".$_SESSION['user_id']."'"; ?>>
	                    	<input type="hidden" name="user" value=<?php echo "'".$_GET['anon']."'"; ?>>
	                        <textarea id="myTextarea" class="form-control" rows="3" type="text" maxlength="255" name="message" placeholder="say something..." required></textarea>
	                    </div>
	                    <div>
	                        <button type="submit" class="btn btn-default">submit</button>
	                    </div>
                </form>
                <br/>
				<div class="list-group" id="messageHolder">
				</div>
			</div>
			<div class="col-md-4">
            	<br/>
            	<form role="form" action="includes/delete_message.php?user=<?php echo $_SESSION['user_id']; ?>&friend=<?php echo $_GET['anon']; ?>" method="post">
		        	<button type="submit" class="btn btn-danger pull-right btn-lg">delete private chat with #<?php echo $_GET['anon']; ?></button>
				</form>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
