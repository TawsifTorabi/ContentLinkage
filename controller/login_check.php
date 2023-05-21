<?php

	//get login form data
	if(isset($_POST['login'])){
		//get user name and password
		$user_name = mysqli_real_escape_string($con, $_POST["user_name"]);
		$user_pass = mysqli_real_escape_string($con, $_POST["pass"]);
		
		//match the username and password from database
		if(mysqli_num_rows(mysqli_query($con, "select * from users where username='$user_name' AND password='$user_pass'"))> 0){

			//get user ID and Privilage
			$new_query="select * from users where username='$user_name' AND password='$user_pass'";				
			if($rows=mysqli_fetch_array(mysqli_query($con, $new_query), MYSQLI_ASSOC)){  
				$userid = $rows['id'];
			}
			
			//create unique session id
			$sessionID = md5(time()).uniqid();
			
			$_SESSION['contentinkage'] = $sessionID;
			$_SESSION['sessionid'] = $sessionID;
			$_SESSION['username'] = $user_name;
			$_SESSION['userid']= $userid;
			
			setcookie("contentinkage", $sessionID, time() + 31536000, '/');
			setcookie("sessionid", $sessionID, time() + 31536000, '/');
			setcookie("username", $user_name, time() + 31536000, '/');
			setcookie("userid", $userid, time() + 31536000, '/');
				
			echo "<script>window.open('index.php','_self')</script>";
				
		} else {
			echo "<script>alert('User Name or Password is Incorrect')</script>";
		}
	}


?>