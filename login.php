<?php
	session_start();
	
	//create database connection
	include("controller/connect_db.php");
	

	//verify session id
	if(isset($_SESSION['contentinkage'])){
		echo "<script>window.open('index.php','_self')</script>";
	}

	include('controller/login_check.php');
	
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
