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
					  <a href="myuploads.php">My Uploads</a>
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
