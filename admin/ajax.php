<?php 


	

	if($_SERVER['REQUEST_METHOD'] == "POST"){


		// Registration Process Start ////////////////////
		if(isset($_POST['registration'])){
			if(empty($_POST['username'])){
				echo '<div class="alert alert-danger" role="alert">
						 Filed must not be empty
						</div>';
			}elseif(empty($_POST['email'])){
				echo '<div class="alert alert-danger" role="alert">
						 Filed must not be empty
						</div>';
			}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				echo '<div class="alert alert-danger" role="alert">
						 '. $_POST['email'] .' not an email..!
						</div>';
			}elseif(empty($_POST['pass']) && empty($_POST['pass2'])){
				echo '<div class="alert alert-danger" role="alert">
						 Password is blank..!
						</div>';
			}elseif(strlen($_POST['pass']) <= 5){
				echo '<div class="alert alert-danger" role="alert">
							Password should be 6 characters long..!
						</div>';
			}elseif($_POST['pass'] !== $_POST['pass2']){
				echo '<div class="alert alert-danger" role="alert">
						 Password doesn\'t match..!
						</div>';
			}else{

				require 'config.php';

				$username = $_POST['username'];	
				$email = $_POST['email'];
				$password = $_POST['pass'];

				$sql = "SELECT * FROM users WHERE username='$username'";
				$checkUser = $conn->query($sql);
				$checkUser = $checkUser->num_rows;

				$sql = "SELECT * FROM users WHERE email='$email'";
				$checkEmail = $conn->query($sql);
				$checkEmail = $checkEmail->num_rows;


				if($checkUser == 1){
					echo '<div class="alert alert-danger" role="alert">
							This '. $username .' already exeist..! Please try another one
						</div>';
				}elseif ($checkEmail == 1) {
					echo '<div class="alert alert-danger" role="alert">
							This '. $email .' already exeist..! Please try another one
						</div>';
				}else{

					$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password' )";
					$result = $conn->query($sql);

					if($result){
						echo '<div class="alert alert-success" role="alert">
								Registration Successfull..! Please <a href="login.php" class="alert-link"> login </a>
							</div>';
					}else{
						echo '<div class="alert alert-danger" role="alert">
							Ragistration Filed. Please try agan.
						</div>';
					}
				}
			}
		}

		// Registration Process is End//////////




		// Login Process is Start
		if(isset($_POST['login_success'])){

			if(empty($_POST['username']) && empty($_POST['pass'])){
				echo '<div class="alert alert-danger" role="alert">
					Filed must not be empty..!
				</div>';
			}else{

				$pass = $_POST['pass'];
				$check = isset($_POST['check']) ? $_POST['check'] : NULL;


				if(isset($_POST['username'])){
					$username = $_POST['username'];

					require 'config.php';
					$sql = "SELECT username FROM users WHERE username = '$username' OR email= '$username'";
					$matchUser = $conn->query($sql);

					$ifMatch = $matchUser->num_rows;

					if($ifMatch){
						$ifUser = $matchUser->fetch_object();
						$sql = "SELECT * FROM users WHERE username ='$ifUser' ";
						$loginQuery = $conn->query($sql);
						$loginSuccess = $loginQuery->fetch_object();

						if($loginSuccess->password == $pass){
							$_SESSION['username'] = "$ifUser";
							$_SESSION['pass'] =$loginSuccess->password;
							header('location: index.php');
						}else{
							echo '<div class="alert alert-danger" role="alert">
								Password Don\'t match..!
							</div>';
						}
					}else{
						echo '<div class="alert alert-danger" role="alert">
							This ( '. $username .') Username / Email Don\'t match..!
						</div>';
					}
				}
			}
		}
		// Login Process is end



		
	}else{
		header('location: login.php');
	}