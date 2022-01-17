<?php 
  include('config/dbconn.php');

  error_reporting(0); 

  session_start();

  if (isset($_SESSION['username'])) {
  	// code...
  	header("Location: index.php");
  }

  if (isset($_POST['loginbtn'])) {
  	// code...
   	$username = $_POST['username'];
   	$password = md5($_POST['password']);

   	$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
   	$result = mysqli_query($conn, $sql);

   	if ($result->num_rows > 0) {
   		// code...
   		$row = mysqli_fetch_assoc($result);
   		$_SESSION['username'] = $row['username'];
   		header("Location: index.php");
   	} else {
      // echo "<script>alert('Woops! Username or Password is Wrong.')</script>";
      $_SESSION['status'] = "Woops! Username or Password is Wrong.";
   		header("Location: authentication.php");
   	}
  } 
?>