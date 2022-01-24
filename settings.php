<?php  
  session_start();

  if (!isset($_SESSION['username'])) {
    // code...
    header("Location: authentication");
    exit(0);
  }
?>