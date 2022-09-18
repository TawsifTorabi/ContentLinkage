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

?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/Clientstyle.css"/>
		<link rel="stylesheet" type="text/css" href="css/aurna-lightbox.css"/>
    </head>

    <body>
		<script src="js/aurna-lightbox.js"></script>
		<ul>
			<li style='background: linear-gradient(to left,#2aca9d, #21884e);'>
				<a href="javascript:void(0);">
				<?php
					$userid = $_COOKIE['userid'];
					if ($conn->query("SELECT username FROM users WHERE id='$userid'")->num_rows > 0) {
						// output data of each row
						if($row = $conn->query("SELECT username FROM users WHERE id='$userid'")->fetch_assoc()) {
							echo "<span>Hello! <strong>".$row['username']."</strong></span><br>";
						}
					} else {
						echo "<b>Something Went Wrong!</b>";
					}
				?>
				</a>
			</li>
			<li><a href="index.php">Home</a></li>
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Upload</a>
					<div class="dropdown-content">
					  <a href="upload.php?type=pdf">Upload PDF</a>
					  <a href="upload.php?type=video">Upload Videos</a>
					</div>
			</li>
			<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Manager</a>
			<div class="dropdown-content">
			  <a href="#">My Uploads</a>
			  <a href="#">My Account</a>
			  <a href="#">Settings</a>
			  <a href="#">Subscription</a>
			</div>
			</li>
			<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
		</ul>
		
		<div class="maincont">
			<h1 style="font-size: 50px;">Discover The World of Contents!</h1>
			<h3>Find your videos and pdf books!</h3>

			<table>
			  <tr>
				<th></th>
				<th>Name</th>
				<th style="font-weight:bold; text-align:center;">Uploader</th>
				<th>Upload Time</th>
				<th></th>
			  </tr>
			  <?php
				mysqli_set_charset($con, "utf8");
				$sql        = "SELECT * FROM `contents` order by id desc limit 50";
				$result		= mysqli_query($con, $sql);
				if(!$result){
					echo mysqli_error($con);
				}
				else{
					while($rows=mysqli_fetch_array($result)){
				?>
					<tr>
						<td style="font-weight:bold; text-align:center;color:red;">
						<?php if($rows['filetype'] == "pdf"){ ?>
							<svg style="fill: crimson;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12.819 14.427c.064.267.077.679-.021.948-.128.351-.381.528-.754.528h-.637v-2.12h.496c.474 0 .803.173.916.644zm3.091-8.65c2.047-.479 4.805.279 6.09 1.179-1.494-1.997-5.23-5.708-7.432-6.882 1.157 1.168 1.563 4.235 1.342 5.703zm-7.457 7.955h-.546v.943h.546c.235 0 .467-.027.576-.227.067-.123.067-.366 0-.489-.109-.198-.341-.227-.576-.227zm13.547-2.732v13h-20v-24h8.409c4.858 0 3.334 8 3.334 8 3.011-.745 8.257-.42 8.257 3zm-12.108 2.761c-.16-.484-.606-.761-1.224-.761h-1.668v3.686h.907v-1.277h.761c.619 0 1.064-.277 1.224-.763.094-.292.094-.597 0-.885zm3.407-.303c-.297-.299-.711-.458-1.199-.458h-1.599v3.686h1.599c.537 0 .961-.181 1.262-.535.554-.659.586-2.035-.063-2.693zm3.701-.458h-2.628v3.686h.907v-1.472h1.49v-.732h-1.49v-.698h1.721v-.784z"/></svg>
						<?php
						}
						if($rows['filetype'] == "video"){ ?>
							<svg style="fill: 228e55;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11.266 7l12.734-2.625-.008-.042-1.008-4.333-21.169 4.196c-1.054.209-1.815 1.134-1.815 2.207v14.597c0 1.657 1.343 3 3 3h18c1.657 0 3-1.343 3-3v-14h-12.734zm8.844-5.243l2.396 1.604-2.994.595-2.398-1.605 2.996-.594zm-5.898 1.169l2.4 1.606-2.994.595-2.401-1.607 2.995-.594zm-5.904 1.171l2.403 1.608-2.993.595-2.406-1.61 2.996-.593zm-2.555 5.903l2.039-2h3.054l-2.039 2h-3.054zm4.247 10v-7l6 3.414-6 3.586zm4.827-10h-3.054l2.039-2h3.054l-2.039 2zm6.012 0h-3.054l2.039-2h3.054l-2.039 2z"/></svg>
						<?php } ?>
						</td>
						<td>
							<span style="font-size:18px; font-weight: bold;"><?php echo $rows['name']?></span></br>
							<p><?php echo $rows['description']?></p>
						</td>
				<?php
						$ambid = $rows['uploaderID'];
						if($row=mysqli_fetch_array(mysqli_query($con, "SELECT username FROM `users` Where id=$ambid"), MYSQLI_ASSOC)){
				?>		<td style="font-weight:bold; text-align:center;"><?php echo $row['username']?></td>
				<?php
						}else{
							?>
							
						<td style="font-weight:bold; text-align:center;color:red;">Deleted User</td>
							<?php
						}
				?>		<td><?php echo date("Y-m-d \ TH:i:s\Z", $rows['time']); ?></td>
						<td>
						<?php if($rows['filetype'] == "pdf"){ ?>
							<a class="button button2" href="uploads/<?php echo $rows['filename']; ?>" download>Download</a>
						<?php
						}
						if($rows['filetype'] == "video"){ ?>
							<a class="button button2" href="uploads/<?php echo $rows['filename']; ?>" download>Download</a>
							<a class="button button2" href="javascript:void(0)" onclick="aurnaIframe('preview.php?content_id=<?php echo $rows['id']; ?>')">View</a>
						<?php } ?>
						</td>
					</tr>
				<?php
					}
				}
				?>
			</table>
			
		</div>

    </body>
</html>

<?php 	}	else { echo "<script>window.open('login.php','_self')</script>"; } ?>