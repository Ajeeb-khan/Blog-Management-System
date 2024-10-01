<?php 
	
	session_start();

	unset($_SESSION);
	session_destroy();


	header("location:../login.php?message=You have logged out your account successfully&color=red");





?>