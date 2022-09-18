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
			<li><a href="index.php">Home</a></li>
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
		
		<?php if($_GET['type'] == 'pdf'){?>

		<div class="maincont">
			<h1 style="font-size: 50px;">Upload New PDF!</h1>
			<h3>Share your pdf books with everyone!</h3>
			<form action="upload.php?type=pdf&?uploader=true" method="post" enctype="multipart/form-data">
				<span style="font-size: 30px;">Select PDF File to Upload:</span></br></br>
				<input type="file" class="uploaderBtn" accept=".pdf" name="pdffile" 
					oninput="framePrev.src=window.URL.createObjectURL(this.files[0])">
				</br>
				<input placeholder="Name..." type="text" class="inputText" name="name"></br>
				<input placeholder="Description..." type="text" class="inputText" name="description">
				</br>
				<input type="submit" name="submit" class="submitBtn" value="Upload">
			</form>
			<iframe src="" id="framePrev"></iframe>
			
			
			<?php
			if(isset($_GET['uploader']) && isset($_FILES["pdffile"])){

			$statusMsg = '';

			// File upload path
			$targetDir = "uploads/";
			$fileName = basename($_FILES["pdffile"]["name"]);
			$targetFilePath = $targetDir . $fileName;
			//$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
			$filetype = "pdf";

			if(isset($_POST["submit"]) && !empty($_FILES["pdffile"]["name"])){
				// Allow certain file formats
				$allowTypes = array('pdf');
				if(in_array($fileType, $allowTypes)){
					// Upload file to server
					if(move_uploaded_file($_FILES["pdffile"]["tmp_name"], $targetFilePath)){
						// Insert image file name into database
						$uploaderID = $_COOKIE['userid'];
						$insert = $conn->query("INSERT into contents (name, description, uploaderID, filename, filetype, time, counter) VALUES ('".$_POST['name']."','".$_POST['description']."','".$uploaderID."','".$filetype."','".$fileName."', NOW(), 0)");
						if($insert){
							$statusMsg = "The file has been uploaded successfully.";
						}else{
							$statusMsg = "File upload failed, please try again.";
						} 
					}else{
						$statusMsg = "Sorry, there was an error uploading your file.";
					}
				}else{
					$statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
				}
			}else{
				$statusMsg = 'Please select a file to upload.';
			}

			// Display status message
			echo $statusMsg;

		}
		?>
		</div>
		<?php } ?>





		<?php if($_GET['type'] == 'video'){?>

		<div class="maincont">
			<h1 style="font-size: 50px;">Upload New Video!</h1>
			<h3>Share your Video with everyone!</h3>
			<form action="upload.php?type=video&uploader=true" method="post" enctype="multipart/form-data">
				<span style="font-size: 30px;">Select Video File to Upload:</span></br></br>
				<input type="file" class="uploaderBtn" name="vdofile" 
					oninput="framePrev.src=window.URL.createObjectURL(this.files[0]); framePrev.controls=true;">
				</br>
				<input placeholder="Name..." type="text" class="inputText" name="name"></br>
				<input placeholder="Description..." type="text" class="inputText" name="description">
				</br>
				<input type="submit" name="submit" class="submitBtn" value="Upload">
			</form>
			<video src="" id="framePrev"></video>	
			
			<?php
			if(isset($_GET['uploader']) && isset($_FILES["vdofile"])){

			$statusMsg = '';

			// File upload path
			$targetDir = "uploads/";
			$fileName = basename($_FILES["vdofile"]["name"]);
			$targetFilePath = $targetDir . $fileName;
			$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
			$filetype1 = "video";

			if(isset($_POST["submit"]) && !empty($_FILES["vdofile"]["name"])){
				// Allow certain file formats
				$allowTypes = array('mp4');
				if(in_array($fileType, $allowTypes)){
					// Upload file to server
					if(move_uploaded_file($_FILES["vdofile"]["tmp_name"], $targetFilePath)){
						// Insert image file name into database
						$uploaderID = $_COOKIE['userid'];
						$insert = $conn->query("INSERT into contents (name, description, uploaderID, filename, filetype, time, counter) VALUES ('".$_POST['name']."','".$_POST['description']."','".$uploaderID."','".$fileName."','".$filetype1."', NOW(), '".((int)0)."')");
						if($insert){
							$statusMsg = "The file has been uploaded successfully.";
						}else{
							$statusMsg = "File upload failed, please try again.";
						} 
					}else{
						$statusMsg = "Sorry, there was an error uploading your file.";
					}
				}else{
					$statusMsg = 'Sorry, only MP4 files are allowed to upload.';
				}
			}else{
				$statusMsg = 'Please select a file to upload.';
			}

			// Display status message
			echo $statusMsg;

		}
		?>
		</div>
		<?php } ?>

    </body>
</html>

<?php 	}	else { echo "<script>window.open('login.php','_self')</script>"; } ?>