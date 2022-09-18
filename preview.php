<?php
	//Strat Session
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

?>
<!DOCTYPE html>
<html>
    <head>
	<style>
	html{
		font-family: Trebuchet MS;
	}
	</style>
    </head>

    <body>
		<?php if(isset($_GET['content_id'])){
				
				$id 		= (int)$_GET['content_id'];
				mysqli_set_charset($con, "utf8");
				$sql        = "SELECT * FROM `contents` where id='".$id."'";
				$result		= mysqli_query($con, $sql);
				if(!$result){
					echo mysqli_error($con);
				}
				else{
					while($rows=mysqli_fetch_array($result)){
						?>
						<span style="font-size: 20px;"><?php echo $rows['name']; ?><span></br>
						<small style="font-size: 15px; color: grey;"> Uploaded By : 
						<?php
								$ambid = $rows['uploaderID'];
								if($row=mysqli_fetch_array(mysqli_query($con, "SELECT username FROM `users` Where id=$ambid"), MYSQLI_ASSOC)){
						?>		<b><?php echo $row['username']?></b>
						<?php
								}else{?>
									
								<b>Deleted User</b>
									<?php
								}
							?>	
						</small>
						</br>
						</br>
						<?php
						if($rows['filetype'] == "video"){
							?>
							<video controls src="uploads/<?php echo $rows['filename']?>" style="width:100%;height: 366px;background: black;""></video>
							<?php
						}
				?>

				<?php
					}
				}
				?>

    </body>
</html>

<?php	}
	
		}	else { echo "<script>window.open('login.php','_self')</script>"; } ?>
