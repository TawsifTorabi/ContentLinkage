<?php

	session_start();
		
	unset($_COOKIE['contentinkage']);
	unset($_COOKIE['sessionid']);
	unset($_COOKIE['username']);
	unset($_COOKIE['userid']);
	
	setcookie('contentinkage', null, -1, '/');
	setcookie('sessionid', null, -1, '/');
	setcookie('username', null, -1, '/');
	setcookie('userid', null, -1, '/');
	

	session_destroy();
	
	echo "<script>window.open('login.php?status=loggedout','_self')</script>";

?>