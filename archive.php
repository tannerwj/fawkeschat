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
				<div class="col-md-8" id="archiveChats">
					<?php
					    if(isset($_GET['pg']))
					    {
						    $page = $_GET['pg'] - 1;

	   					    $sql = "SELECT count(*) as 'count' FROM public_chats;";
						    $result2 = $mydb->runQuery($sql);

						    $numRow = mysqli_fetch_array($result2);

						    $end = $numRow['count'] - ($page * 20);
						    $begin = $end - 20;

						    if($begin < 1)
						    {
						    	$begin = 0;
						    }

						    $sql = "SELECT lower(message) as 'message', timestamp
						    			FROM public_chats
						    			WHERE chat_id > ".$begin."
						    				AND chat_id <= ".$end.
						    				" ORDER BY chat_id desc;";
						    $result = $mydb->runQuery($sql);

						    echo "<table class='table table-striped table-hover' >
						            <thead><tr><th>messages</th></tr></thead><tbody>";
						    while($row = mysqli_fetch_array($result)){
						        $message = $row['message'];
						        $time = $row['timestamp'];
						        $phpdate = strtotime( $time );
						        $time = date( 'M d, g:i', $phpdate );

						        echo "<tr><td><p>".$message."</p><p style='text-align:right;'>".$time."</p></td></tr>";
						    }
						    echo "</tbody></table>";

						    if($numRow['count'] > 20)
						    {
						        $pages = $numRow['count'] / 20;
						        if(($numRow['count'] % 20) > 0)
						        {
						            $pages = $pages + 1;
						        }
						        $page = $_GET['pg'];
						        if($page > $pages)
						        {
						        	header('Location: index.php');
						        }
						        $previous = $page - 1;
						        $next = $page + 1;

						        if($previous == 1)
						        {
						        	echo "<nav>
						                <ul class='pagination'>
						                   <li><a href='index.php'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
						        }
						        else
						        {
						       		 echo "<nav>
						                <ul class='pagination'>
						                   <li><a href='archive.php?pg=".$previous."'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
						        }
						        echo "<li><a href='index.php'>1<span class='sr-only'>(current)</span></a></li>";

						        $num = 2;

						        while($num < $page)
						        {
						            echo "<li><a href='archive.php?pg=".$num."'>".$num."</a></li>";
						            $num = $num + 1;
						        }
						        echo "<li class='active'><a href='#'>".$page."</a></li>";
						        $num = $page + 1;
						        while($num < $pages)
						        {
						        	echo "<li><a href='archive.php?pg=".$num."'>".$num."</a></li>";
						            $num = $num + 1;
						        }

						        if(($page + 1) > $pages)
						        {
						        	echo "<li class='disabled'><a><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li></ul></nav>";
						        }
						        else
						        {
						        	echo "<li><a href='archive.php?pg=".$next."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li></ul></nav>";
						        }
						    }
						}
						else
						{
							header('Location: index.php');
						}
					?>
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
