<?php 

  session_start();

  include('config/dbconn.php');
  include('includes/message.php');

  error_reporting(0); 

  if (isset($_SESSION['username'])) {
  	header("Location: authentication");
  }

  if (isset($_POST['signupbtn'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = md5($_POST['password']);

  	if ($username == '' || $email == '' || $password == '') {
  		$_SESSION['status'] = "Please check the missing field";
    	$_SESSION['status_code'] = "error";
      header('Location: authentication');
      exit(0);
  	}
  	else {
  		$sql = "SELECT * FROM users WHERE email='$email'";
	  	$result = mysqli_query($conn, $sql);

	  	if (!$result->num_rows > 0) {
	  		$sql = "INSERT INTO users (username, email, password) 
	  	        VALUES ('$username', '$email', '$password')";
			  $result = mysqli_query($conn, $sql);

				if ($result) {
					$_SESSION['status'] = "Wow! User Registration Completed.";
					$_SESSION['status_code'] = "success";
					header("Location: authentication");
					$username = "";
					$email = "";
					$_POST['password'] = "";
					exit(0);
				} else {
					$_SESSION['status'] = "Woops! Something went wrong.";
					$_SESSION['status_code'] = "error";
					header("Location: authentication");
					exit(0);
				}  
	  	} else {
	  		$_SESSION['status'] = "Woops! Email Already Exists.";
	  		$_SESSION['status_code'] = "error";
	  		header("Location: authentication");
	  		exit(0);
	  	}
  	}
  }
?>