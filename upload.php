<?php
	//create database connection
	require("controller/logged_in_check.php");
	include("controller/connect_db.php");
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
					<?php include('views/username_header.php'); ?>
				</a>
			</li>
			<li><a href="index.php">Home</a></li>
			<li><a href="discover.php">Discover</a></li>
			<li class="dropdown">
			<a href="javascript:void(0)" class="dropbtn">Manager</a>
			<div class="dropdown-content">
			  <a href="myuploads.php">My Uploads</a>
			</div>
			</li>
			<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
		</ul>
		
		<?php if($_GET['type'] == 'pdf'){?>

		<div class="maincont">
			<h1 style="font-size: 50px;">Upload New PDF!</h1>
			<h3>Share your pdf books with everyone!</h3>
			<form action="upload.php?type=pdf&uploader=true" method="post" enctype="multipart/form-data">
				<span style="font-size: 30px;">Select PDF File to Upload:</span></br></br>
				<input type="file" class="uploaderBtn" accept=".pdf" name="pdfFile" 
					oninput="">
				</br>
				<input placeholder="Name..." type="text" class="inputText" name="name"></br>
				<input placeholder="Description..." type="text" class="inputText" name="description">
				</br>
				<input type="submit" name="submit" class="submitBtn" value="Upload">
			</form>
			
			<?php include('controller/pdf_uploader.php'); ?>
			
		</div>
		<?php } ?>





		<?php if($_GET['type'] == 'video'){?>

		<div class="maincont">
			<h1 style="font-size: 50px;">Upload New Video!</h1>
			<h3>Share your Video with everyone!</h3>
			<form action="upload.php?type=video&uploader=true" method="post" enctype="multipart/form-data">
				<span style="font-size: 30px;">Select Video File to Upload:</span></br></br>
				<input type="file" class="uploaderBtn" name="vdofile" 
					oninput="">
				</br>
				<input placeholder="Name..." type="text" class="inputText" name="name"></br>
				<input placeholder="Description..." type="text" class="inputText" name="description">
				</br>
				<input type="submit" name="submit" class="submitBtn" value="Upload">
			</form>

			<?php include('controller/video_uploader.php'); ?>
			
		</div>
		<?php } ?>


    </body>
</html>

