<?php
	//create database connection
	require("../controller/logged_in_check.php");
	include("../controller/connect_db.php");
?>

<!DOCTYPE html>
<html>
    <head>
		<style>
		body{font-family: Trebuchet MS; margin-left: 30%;}
		.uploaderBtn{max-width: 324px; background: #2aa582;padding: 17px;font-size: 14px;border-radius: 11px;box-shadow: 2px 2px 33px 3px #0000006b;}
		.submitBtn {
		  background: #2aa582;
		  padding: 17px;
		  font-size: 16px;
		  border-radius: 7px;
		  color: white;
		  text-transform: capitalize;
		  box-shadow: 2px 2px 33px 3px #0000006b;
		  font-weight: bold;
		  font-family: Trebuchet MS;
		  border: none;
		}
		.inputText{
		  border-radius: 8px;
		  border: none;
		  height: 37px;
		  margin-top: 9px;
		  margin-bottom: 9px;
		  width: 339px;
		  padding-left: 18px;
		  border: 2px solid green;
		}
		</style>
    </head>

    <body>
	<?php

	if(isset($_GET['content_id'])){
			
		mysqli_set_charset($con,"utf8");
		$userid = $_COOKIE['userid'];
		$id    = mysqli_real_escape_string($con, $_GET['content_id']);
		$sql        = "SELECT * FROM `contents` WHERE `uploaderID`=$userid AND`id`=$id";
		$result		= mysqli_query($con, $sql);
		if(!$result){
			echo mysqli_error($con);
		}
		else{
			while($rows=mysqli_fetch_array($result)){
	?>
		<div class="maincont">
			<h3>Edit Content - <?php echo mysqli_real_escape_string($con, $rows['name']) ?></h3>
			<form action="../controller/editcontent_processor.php?id=<?php echo mysqli_real_escape_string($con, $rows['id']) ?>&save" method="post" enctype="multipart/form-data">
				Name:</br>
				<input placeholder="Name..." type="text" value="<?php echo mysqli_real_escape_string($con, $rows['name']) ?>" class="inputText" name="name"></br>
				Description:</br>
				<input placeholder="Description..." type="text" value="<?php echo mysqli_real_escape_string($con, $rows['description']) ?>" class="inputText" name="description">
				</br>
				<input type="submit" name="submit" class="submitBtn" value="Save">
			</form>
		</div>
			
	<?php }}}?>
	
    </body>
</html>
