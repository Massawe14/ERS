<?php 

  session_start();
  
  include('config/dbconn.php');
  include('includes/message.php');

  error_reporting(0); 

  if (isset($_SESSION['username'])) {
  	header("Location: subscription");
    exit(0);
  }

  if (isset($_POST['loginbtn'])) {
   	$username = $_POST['username'];
   	$password = md5($_POST['password']);

    if ($username == '' || $password == '') {
      $_SESSION['status'] = "Please check the missing field";
      $_SESSION['status_code'] = "error";
      header('Location: authentication');
      exit(0);
    }
    else {
      $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $result = mysqli_query($conn, $sql);

      if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['status'] = "Logged In Successfully";
        $_SESSION['status_code'] = "success";
        header("Location: subscription");
        exit(0);
      } else {
        $_SESSION['status'] = "Woops! Username or Password is Wrong.";
        $_SESSION['status_code'] = "error";
        header("Location: authentication");
        exit(0);
      }
    }
  } 
?>