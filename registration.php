
        <!-- recieved data by post method from same php file-->
        <?php

			include('controller/input_filter.php');
			
			
            $usernameErr = $emailErr = $passwordErr =$universityNameErr = "";
            $username = $email = $password = $universityName = "";
            $successfulInsert=false;

            //checking empty,invalid inputs

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(!empty($_POST["username"])){
                    $username = input_filter($_POST['username']);  
                    //pattern check 
                            
                }
                else{
                    $usernameErr = "Username missing";
                }
                if(!empty($_POST["email"])){
                    $email = input_filter($_POST['email']);
                    //pattern check 
                    //useflag
                }
                else{
                    $emailErr = "Email Missing";
                }
                if(!empty($_POST["password"])){
                    $password = input_filter($_POST['password']);
                    //pattern check 
                    //useflag
                }
                else{
                    $passwordErr = "Password Missing";
                }
                if(!empty($_POST["universityname"])){
                    $universityname = input_filter($_POST['universityname']);
                    //pattern check 
                    //useflag
                }
                else{
                    $universityNameErr = "University Name Missing";
                    //pattern check 
                    //useflag
                }

            }

                //after passing empty and valid input check

                if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["universityname"])){

                    //establishing connection
                    include_once "controller/connect_db.php";


                    $username = input_filter($_POST['username']);
                    $email = input_filter($_POST['email']);
                    $password = input_filter($_POST['password']);
                    $universityname = input_filter($_POST['universityname']);
                    
                    //inserting values into database
                    $sql = "INSERT INTO users (email,password,username,client_uni_name)
                    VALUES ('$email ', '$password', '$username','$universityname')";

                    if ($conn->query($sql) === TRUE) {
                   
                        //successfull Insert without handling duplicate data
                        

                        include('model/regsuccesspage.php');
						$conn->close();
						exit();
                        
                      
                    } else {
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                    echo "<br>Found duplicate data";
                    $conn->close();
                    }


                }

			?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Content_linkage</title>
        <style>
        .align {
           text-align:center;
        }
		* {
		  box-sizing: border-box;
		}

		/* Add padding to containers */
		.container {
		  padding: 16px;
		  background-color: white;
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
		  width: 100%;
		  padding: 15px;
		  margin: 5px 0 22px 0;
		  display: inline-block;
		  border: none;
		  background: #f1f1f1;
		}

		input[type=text]:focus, input[type=password]:focus {
		  background-color: #ddd;
		  outline: none;
		}

		/* Overwrite default styles of hr */
		hr {
		  border: 1px solid #f1f1f1;
		  margin-bottom: 25px;
		}

		/* Set a style for the submit button */
		.registerbtn {
		  background-color: #04AA6D;
		  color: white;
		  padding: 16px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  opacity: 0.9;
		}

		.registerbtn:hover {
		  opacity: 1;
		}

		/* Add a blue text color to links */
		a {
		  color: dodgerblue;
		}

		/* Set a grey background color and center the text of the "sign in" section */
		.signin {
		  background-color: #f1f1f1;
		  text-align: center;
		}
        </style>
		<link rel="stylesheet" type="text/css" href="css/Clientstyle.css"/>
    </head>
    <body style="color: white">
		</br>

        <h1 class="align" style="font-size: 40px;">CONTENT LINKAGE!</h1>      
        <center>
        <!-- registration input from user -->
		<form style="color:black;" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		  <div style="width: 600px; margin-left: 50px; margin-right: 50px;" class="container">
			<h1>Register</h1>
			<p>Please fill in this form to create an account.</p>
			<hr>

			<label for="email"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" id="username" required>			
			
			<label for="email"><b>Email</b></label>
			<input type="text" placeholder="Enter Email" name="email" id="email" required>

			<label for="email"><b>University Name</b></label>
			<input type="text" placeholder="Enter University Name" name="universityname" id="universityname" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" id="password" required>

			<hr>
			<p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

			<button type="submit" class="registerbtn">Register</button>
		  </div>
		  
		  <div class="container signin">
			<p>Already have an account? <a href="login.php">Sign in</a>.</p>
		  </div>
		</form>
		</center>
    </body>
</html>