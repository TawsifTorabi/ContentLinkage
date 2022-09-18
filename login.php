<?php
	session_start();
	
	//create database connection
	include("connect_db.php");
	
	//create blank variable
	$getsessionID = "";
	
	//call session data
	if(isset($_SESSION['librarypanel'])){	
		//get session id from browser and update variable
		$getsessionID = $_SESSION['librarypanel'];
	}
	
	//set the validity mode for session data
	$validity = mysqli_real_escape_string($con,"valid");
	
	//verify session id
	if(mysqli_num_rows(mysqli_query($con, "select * from sessions where session_id='$getsessionID' AND validity='$validity' ORDER BY `id` DESC LIMIT 1"))> 0){
	
		echo "<script>window.open('index.php','_self')</script>";
	
	} else {
	
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
					$privilege = $rows['adminprivilege'];
				}
				
				//create unique session id
				$ipaddress = $_SERVER['REMOTE_ADDR'];
				$sessionID = time();
				//$sessionID = hash('sha256', $user_name + $_SERVER['REMOTE_ADDR'] + time());
				$issuetime = time();
				$expirytime = "0";
				$validity = "valid";
				$browser = $_SERVER['HTTP_USER_AGENT'];
				$user_ip = getenv('REMOTE_ADDR');
				$geo = "";
				$country = "Bangladesh";
				$city = "Dhaka";
				$location = "";		  
				//save session id, IP Address, Login Information to Database
				 mysqli_query($con, "
				 Insert Into `sessions` (`session_id`, `user_id`, `issued`, `expiry_time`, `ipaddress`,`browser` ,`location`, `validity`) Values
				  (
					'$sessionID',
					'$userid',
					'$issuetime',
					'$expirytime',
					'$ipaddress',
					'$browser',
					'$location',
					'$validity'
				  )
				  ");	  

					$_SESSION['librarypanel'] = $sessionID;
					$_SESSION['username'] = $user_name;
					$_SESSION['userid']= $userid;
					$_SESSION['privilege']= $privilege;
					
					setcookie("sessionid", $sessionID, time() + 31536000, '/');
					setcookie("username", $user_name, time() + 31536000, '/');
					setcookie("userid", $userid, time() + 31536000, '/');
					setcookie("privilege", $privilege, time() + 31536000, '/');
					
					echo "<script>window.open('index.php','_self')</script>";
					//echo mysql_error();
					
			} else {
				echo "<script>alert('User Name or Password is Incorrect')</script>";
				//echo mysql_error();
			}
		}

			?>
			
			<html>
			<head>
				<title>Login</title>
				<link rel="stylesheet" type="text/css" href="css/loginstyle.css"/>
			</head>
			<body>
				<div class="container">
					<div class="screen">
						<div class="screen__content">
						</br>
						</br>
						</br>
							<h1 class="align" style="color: white;background-color: #5f57a3;padding: 9px;" class="titleheader">CONTENT LINKAGE</h1>
							<div style="color: white;background-color: #5f57a3;padding: 9px;">
							<h3 class="align">Find your suitable content here!!</h3>
							<p class="align">Here you can find premium pdf files that is totally free</p>
							<p class="align">For accessing register quick</p>
							</div>
							
							<form  method="post" class="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<div class="login__field">
									<input type="text" name="user_name" class="login__input" placeholder="User name / Email">
								</div>
								<div class="login__field">
									<input type="password" name="pass" class="login__input" placeholder="Password">
								</div>								
								<input class="button login__submit" type="submit" value="Login" name="login">

							</form>
							<button class="button login__submit">
								<span onclick="window.location.href='registration.php'" class="button__text">Register</span>
							</button>
							</br>				
							</br>				
							<center>
								<button style="padding: 5px;" onclick="window.location.href='adminlogin.php'" class="align">Go to Admin Panel</h2>
							</center>					
						</div>
						<div class="screen__background">
							<span class="screen__background__shape screen__background__shape4"></span>
							<span class="screen__background__shape screen__background__shape3"></span>		
							<span class="screen__background__shape screen__background__shape2"></span>
							<span class="screen__background__shape screen__background__shape1"></span>
						</div>		
					</div>
				</div>
			</body>
			</html>
	<?php } ?>