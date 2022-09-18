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
    </head>

    <body>
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
			<li class="dropdown">
				<a href="javascript:void(0)" class="dropbtn">Upload</a>
					<div class="dropdown-content">
					  <a href="upload.php?type=pdf">Upload PDF</a>
					  <a href="upload.php?type=video">Upload Videos</a>
					</div>
			</li>
			<li><a href="discover.php">Discover</a></li>
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
			<center>
				<h1 style="font-size: 50px;">Welcome To Content Linkage!</h1>
				<h3>Find and share your pdf books with everyone!</h3>
				<h3 class="button button2" onclick="window.location.href='discover.php'">Discover PDF</h3>
			</center>
		</div>
    </body>
</html>

<?php 	}	else { echo "<script>window.open('login.php','_self')</script>"; } ?>