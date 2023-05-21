<?php
	require("controller/logged_in_check.php");
	//create database connection
	include("controller/connect_db.php");
?>

<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="css/Clientstyle.css"/>
		<link rel="stylesheet" type="text/css" href="css/aurna-lightbox.css"/>
    </head>

    <body>
		<script src="js/aurna-lightbox.js"></script>
		<script src="js/myuploads.js"></script>
		<ul>
			<li style='background: linear-gradient(to left,#2aca9d, #21884e);'>
				<a href="javascript:void(0);">
					<?php include('views/username_header.php'); ?>
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
			</div>
			</li>
			<li style="float:right"><a class="active" href="logout.php">Logout</a></li>
		</ul>
		
		<div class="maincont">
			<h1 style="font-size: 50px;">My Uploads!</h1>
			<h3>Find your videos and pdf books!</h3>
			</br>
			
			
			<input type="text" id="queryInput" onkeypress="return fireentersearch(event)" placeholder="Search Here..."/>
			<button onclick="searchAjax()" id="queryGo"><svg xmlns="http://www.w3.org/2000/svg" style="fill:white;" width="16" height="16" viewBox="0 0 24 24"><path d="M23.111 20.058l-4.977-4.977c.965-1.52 1.523-3.322 1.523-5.251 0-5.42-4.409-9.83-9.829-9.83-5.42 0-9.828 4.41-9.828 9.83s4.408 9.83 9.829 9.83c1.834 0 3.552-.505 5.022-1.383l5.021 5.021c2.144 2.141 5.384-1.096 3.239-3.24zm-20.064-10.228c0-3.739 3.043-6.782 6.782-6.782s6.782 3.042 6.782 6.782-3.043 6.782-6.782 6.782-6.782-3.043-6.782-6.782zm2.01-1.764c1.984-4.599 8.664-4.066 9.922.749-2.534-2.974-6.993-3.294-9.922-.749z"/></svg></button>
			
			
			<table style="width:98%;" id="dataTable2">
			  <tr>
				<th></th>
				<th>Name</th>
				<th>Description</th>
				<th>Download/Views</th>
				<th>Upload Time</th>
				<th>Download or View</th>
				<th style="text-align: center;">Action</th>
			  </tr>
			  <?php
				mysqli_set_charset($con, "utf8");
				$sql        = "SELECT * FROM `contents` WHERE uploaderID=$userid order by id desc limit 200";
				$result		= mysqli_query($con, $sql);
				if(!$result){
					echo mysqli_error($con);
				}
				else{
					while($rows=mysqli_fetch_array($result)){
				?>
					<tr id="datacont<?php echo $rows['id']?>">
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
							<span style="font-size:16px;font-weight:bold;"><?php echo $rows['name']?></span></br>
						</td>
						<td><p><?php echo $rows['description']?></p></td>
						<td><p><?php echo $rows['counter']?></p></td>
						<td><?php echo date("Y-m-d", $rows['time']); ?></td>
						<td>
						<?php if($rows['filetype'] == "pdf"){ ?>
							<a class="button button2" href="views/file.php?content_id=<?php echo $rows['id']; ?>" download>Download</a>
						<?php
						}
						if($rows['filetype'] == "video"){ ?>
							<a class="button button2" href="views/file.php?content_id=<?php echo $rows['id']; ?>" download>Download</a>
							<a class="button button2" href="javascript:void(0)" onclick="aurnaIframe('views/preview.php?content_id=<?php echo $rows['id']; ?>')">View</a>
						<?php } ?>
						</td>
						<td width="10" style="background: grey; text-align:center;">
							<li class="dropdown">
							<a href="javascript:void(0)" class="dropbtn">☰</a>
							<div class="dropdown-content">
							  <a style="background: linear-gradient(to left,#f04848, #711212); color: white; font-weight: bold;" href="javascript:DeleteContent('<?php echo $rows['id']; ?>','<?php echo $rows['name']; ?>')">Delete</a>
							  <a href="javascript:aurnaIframe('views/editcontent.php?content_id=<?php echo $rows['id']; ?>');">Edit</a>
							</div>
							</li>
						</td>
					</tr>
				<?php
					}
				}
				?>
			</table>
		</div>
		<?php include('model/confirm_dialogue_html.php'); ?>
		</br>
		</br>
		</br>
		</br>
    </body>
</html>