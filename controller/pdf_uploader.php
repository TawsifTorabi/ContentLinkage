<?php
if(isset($_GET['uploader']) && $_GET['type'] == 'pdf' && isset($_FILES["pdfFile"])){

	$statusMsg = '';

	$targetDir = "uploads/";
	$fileName = uniqid() . "-" . time();
	$fileType = pathinfo($_FILES["pdfFile"]["name"],PATHINFO_EXTENSION);
	$fileName2   = $fileName . "." . $fileType;
	$targetFilePath = $targetDir . $fileName2;
	$filetype1 = "pdf";

	if(isset($_POST["submit"]) && $_GET['type'] == 'pdf' && !empty($_FILES["pdfFile"]["name"])){
		// Allow certain file formats
		$allowTypes = array('pdf');
		if(in_array($fileType, $allowTypes)){
			// Upload file to server
			if(move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFilePath)){
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
			$statusMsg = 'Sorry, only PDF files are allowed to upload.';
		}
	}else{
		$statusMsg = 'Please select a file to upload.';
	}

	// Display status message
	echo $statusMsg;

}
?>