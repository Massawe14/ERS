<?php 
  session_start();

  include('config/dbconn.php');

  error_reporting(0); 

  if (isset($_SESSION['username'])) {
  	// code...
  	header("Location: event.php");
  	exit(0);
  }

  if (isset($_POST['addEvent'])) {
  	// code...
  	$eventname = $_POST['eventname'];

  	$sql = "CREATE TEMPORARY TABLE '$eventname' IF NOT EXIST (id INT NOT NULL AUTO_INCREMENT, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, fullname VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, 
  		phonenumber VARCHAR(100) NOT NULL, companyname VARCHAR(100) NOT NULL, 
  		position VARCHAR(100) NOT NULL, PRIMARY KEY(id))";

    $result = mysqli_query($conn, $sql);

    if ($result) {
    	// code...
    	$_SESSION['status'] = "Table created successfully.";
		header("Location: event.php");
		exit(0);
    } else {
    	$_SESSION['status'] = "Woops! Something went wrong.";
		header("Location: event.php");
		exit(0);
    }
  }

?>