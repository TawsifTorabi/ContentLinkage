<?php
	require("../controller/logged_in_check.php");
	//create database connection
	include("../controller/connect_db.php");
	
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
						<span style="font-size: 20px;"><?php echo $rows['name']; ?></span>
						</br>
						<small style="font-size: 15px; color: black;"> UPLOADER : 
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
							<video controls src="file.php?content_id=<?php echo $rows['id']; ?>" style="width:100%;height: 366px;background: black;"></video>
							<?php
						}
				?>

				<?php
					}
				}
			}
		?>
    </body>
</html>
