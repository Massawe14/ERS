<?php 

  $host = "localhost"; 
  $user = "root"; 
  $pass = ""; 
  $db = "oer"; 

  // Connection
  $conn = mysqli_connect("$host","$user","$pass","$db");

  // Check connection
  if (!$conn) {
  	// header("Location: errors/db.php");
  	// die();
    echo "<script>alert('Connection Failed.')</script>";
  }

?>