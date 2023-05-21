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