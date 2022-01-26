<?php 

  session_start();

  include('config/dbconn.php');
  include('includes/message.php');

  error_reporting(0); 

  if (isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication");
  }

  if (isset($_POST['signupbtn'])) {
  	// code...
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = md5($_POST['password']);

  	if ($username == '' || $email == '' || $password == '') {
  		// code...
  		$_SESSION['status'] = "Please check the missing field";
    	$_SESSION['status_code'] = "error";
      header('Location: event');
      exit(0);
  	}
  	else {
  		$sql = "SELECT * FROM users WHERE email='$email'";
	  	$result = mysqli_query($conn, $sql);

	  	if (!$result->num_rows > 0) {
	  		// code...
	  		$sql = "INSERT INTO users (username, email, password) 
	  	        VALUES ('$username', '$email', '$password')";
			  $result = mysqli_query($conn, $sql);

				if ($result) {
					// code...
					// echo "<script>alert('Wow! User Registration Completed.')</script>";
					$_SESSION['status'] = "Wow! User Registration Completed.";
					$_SESSION['status_code'] = "success";
					header("Location: authentication");
					$username = "";
					$email = "";
					$_POST['password'] = "";
					exit(0);
				} else {
					// echo "<script>alert('Woops! Something went wrong.')</script>";
					$_SESSION['status'] = "Woops! Something went wrong.";
					$_SESSION['status_code'] = "error";
					header("Location: authentication");
					exit(0);
				}  
	  	} else {
	  		// echo "<script>alert('Woops! Email Already Exists.')</script>";
	  		$_SESSION['status'] = "Woops! Email Already Exists.";
	  		$_SESSION['status_code'] = "error";
	  		header("Location: authentication");
	  		exit(0);
	  	}
  	}
  }
?>