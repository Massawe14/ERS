<?php 
  include('config/dbconn.php');

  error_reporting(0); 

  session_start();

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
			echo "<script>alert('Wow! User Registration Completed.')</script>";
			$username = "";
			$email = "";
			$_POST['password'] = "";
			header("Location: authentication.php");
		} else {
			echo "<script>alert('Woops! Something went wrong.')</script>";
			header("Location: authentication.php");
		}  
  	} else {
  		echo "<script>alert('Woops! Email Already Exists.')</script>";
  		header("Location: authentication.php");
  	}
  }
?>