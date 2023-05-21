<?php
	require("../controller/logged_in_check.php");
	//create database connection
	include("../controller/connect_db.php");
	


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
					$location = "../uploads/".$rows['filename'];
					$counter = (int)($rows['counter'])+1;
					mysqli_query($con,"UPDATE `contents` SET `counter`='$counter' WHERE id='$id'");
					//echo $location;
					header("Location: ".$location);
				}
			}
		}
	
?>