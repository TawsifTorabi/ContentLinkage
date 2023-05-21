<?php
			if(isset($_GET['uploader']) && $_GET['type'] == 'video' && isset($_FILES["vdofile"])){

			$statusMsg = '';

			// File upload path
			$targetDir = "uploads/";
			$fileName1   = uniqid() . "-" . time();
			$fileType = pathinfo($_FILES["vdofile"]["name"],PATHINFO_EXTENSION);
			$fileName2   = $fileName1 . "." . $fileType;
			$targetFilePath = $targetDir . $fileName2;
			$filetype1 = "video";

			if(isset($_POST["submit"]) && $_GET['type'] == 'video' && !empty($_FILES["vdofile"]["name"])){
				// Allow certain file formats
				$allowTypes = array('mp4');
				if(in_array($fileType, $allowTypes)){
					// Upload file to server
					if(move_uploaded_file($_FILES["vdofile"]["tmp_name"], $targetFilePath)){
						// Insert image file name into database
						$uploaderID = $_COOKIE['userid'];
						$insert = $conn->query("INSERT into contents (name, description, uploaderID, filename, filetype, time, counter) VALUES ('".$_POST['name']."','".$_POST['description']."','".$uploaderID."','".$fileName2."','".$filetype1."', NOW(), '".((int)0)."')");
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

		} ?> 