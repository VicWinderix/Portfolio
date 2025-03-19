<?php
	session_start();
	if(isset($_SESSION['email']))
	{
		session_unset();
		session_destroy();
		header( "Location: ../PHP/home.php" );
	}
	else
	{
		header( "Location: ../PHP/home.php" );
	}
?>