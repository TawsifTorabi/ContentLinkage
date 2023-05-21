	<?php
	//create database connection
	require("logged_in_check.php");
	include("connect_db.php");

	//edit or update data 
	if(isset($_GET['save'])){

		mysqli_set_charset($con,"utf8");
		$id = 				mysqli_real_escape_string($con, $_GET['id']);
		$name = 			mysqli_real_escape_string($con, $_POST['name']);
		$description = 		mysqli_real_escape_string($con, $_POST['description']);
		

		$query =	"UPDATE `contents` 
					SET `name` = '$name',  
						`description` = '$description' 
						WHERE `id`='$id'";
			  
		if(mysqli_query($con, $query)){
			echo"<script>parent.refreshTable();parent.hideIframe();</script>";
		}else{
			return 1;
			die(mysqli_error($con));	
		}

	}
	
	?>
