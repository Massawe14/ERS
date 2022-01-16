<?php  
  session_start();

  if (!isset($_SESSION['auth'])) {
  	$_SESSION['auth_status'] = "Login to Access Dashboard";
  	header('Location: authentication.php');
    exit(0);
  }
  else{
    $_SESSION['status'] = "You are not Authorized";
    header('Location: authentication.php');
    exit(0);
  }

?>