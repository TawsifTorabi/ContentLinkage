<?php
	session_start();
	//verify session id
	if(empty($_SESSION['contentinkage'])){
		echo "<script>window.open('login.php','_self')</script>";
		exit();
	}
?>