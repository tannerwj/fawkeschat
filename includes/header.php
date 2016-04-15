<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href='index.php' class="navbar-brand" href="#">fawkes chat</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
			 	<?php if($logged){
						echo "<li><a href='profile.php'>welcome ".$_SESSION['email']."!</a>";
						echo "<li><a href='profile.php'>profile</a></li>";
						if($_SESSION['privacy'] != 0)
						{
							echo "<li><a href='private_chats.php'>private chats</a></li>";
						}
					}else{

					}
				?>
			</ul>
			<ul class='nav navbar-nav navbar-right'>
				<?php if($logged){
					echo "<li><a href='includes/logout.php'> logout</a></li>";
				}else{
					echo "<li><a href='login.php'>login</a></li>";
					echo "<li><a href='register.php'>register</a></li>";
				}?>
			</ul>
		</div>
	</div>
</nav>
