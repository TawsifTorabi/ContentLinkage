<?php
	session_start();
	
	//create database connection
	include("connect_db.php");
	
	//blank var
	$getsessionID = '';
	
	//call session data
	if(isset($_COOKIE['sessionid'])){
		//get session id from browser and update variable
		$getsessionID = $_COOKIE['sessionid'];
	}
	//set the validity mode for session data
	$validity = "valid";	
	//verify session id
	if(mysqli_num_rows(mysqli_query($con,"select * from sessions where session_id='$getsessionID' AND validity='$validity'"))> 0){

		if(isset($_GET['content_id'])){
					
			mysqli_set_charset($con, "utf8");

			$id 		= (int)$_GET['content_id'];
			$sql        = "SELECT * FROM `contents` where id='".$id."'";
			$result		= mysqli_query($con, $sql);
			if(!$result){
				echo mysqli_error($con);
			}
			else{
				while($rows=mysqli_fetch_array($result)){
					
					echo $rows['filename'];
					$location = "uploads/".$rows['filename'];
					$counter = (int)($rows['filename'])+1;
					mysqli_query($con,"UPDATE `contents` SET `counter`='$counter' WHERE id='$id'");
					header("Location: ".$location);

				}
			}
		}
	
	}	else { echo "<script>window.open('login.php','_self')</script>"; } ?>