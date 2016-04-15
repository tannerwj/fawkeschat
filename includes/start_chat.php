<?php 

	$id = $_POST['id'];
	$self = $_POST['self'];
	
	if($id == $self)
	{
		header( 'Location: ../private_chats.php?failedchat=1' ) ;
	}
	else
	{
		header( 'Location: ../messages.php?anon='.$id.'' ) ;
	}
 ?>