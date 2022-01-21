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
    $venue = $_POST['venue'];
    $image = $_POST['image']['name'];

    $allowed_extension = array('png','jpg','jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$file_extension;

    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check == false) {
      // code...
      $_SESSION['status'] = "File is not an image.";
      header('Location: event.php');
      exit(0);
    }
    elseif (file_exists($filename)) {
     $_SESSION['status'] = "Sorry, file already exists.";
     header('Location: event.php');
     exit(0);
    }
    elseif (!in_array($file_extension, $allowed_extension)) {
     $_SESSION['status'] = "You are allowed with only jpg, png and jpeg Image";
     header('Location: event.php');
     exit(0);
    }
    elseif ($_FILES["image"]["size"] > 500000) {
     $_SESSION['status'] = "Sorry, your file is too large.";
     header('Location: event.php');
     exit(0);
    }
    else {
      $sql = "INSERT INTO event (name, venue, image) VALUES ('$eventname', '$venue', '$filename')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/images/'.$filename);
        $_SESSION['status'] = "Event Added Successfully";
        header('Location: event.php');
        exit(0);
      }
      else{
        $_SESSION['status'] = "Event Registration Failed";
        header('Location: event.php');
        exit(0);
      }
    }
  }
?>