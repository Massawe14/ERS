<?php 

  session_start();

  include('config/dbconn.php');

  error_reporting(0); 

  if (isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication.php");
  }

  if (isset($_POST['signupbtn'])) {
  	// code...
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = md5($_POST['password']);

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
				header("Location: authentication.php");
				$username = "";
				$email = "";
				$_POST['password'] = "";
				exit(0);
			} else {
				// echo "<script>alert('Woops! Something went wrong.')</script>";
				$_SESSION['status'] = "Woops! Something went wrong.";
				header("Location: authentication.php");
				exit(0);
			}  
  	} else {
  		// echo "<script>alert('Woops! Email Already Exists.')</script>";
  		$_SESSION['status'] = "Woops! Email Already Exists.";
  		header("Location: authentication.php");
  		exit(0);
  	}
  }
?>