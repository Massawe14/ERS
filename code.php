<?php 
  session_start(); 

  include('config/dbconn.php');

  error_reporting(0);

  if (isset($_SESSION['username'])) {
    // code...
    header("Location: event");
    exit(0);
  }

  // Event
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
      header('Location: event');
      exit(0);
    }
    elseif (file_exists($filename)) {
     $_SESSION['status'] = "Sorry, file already exists.";
     header('Location: event');
     exit(0);
    }
    elseif (!in_array($file_extension, $allowed_extension)) {
     $_SESSION['status'] = "You are allowed with only jpg, png and jpeg Image";
     header('Location: event');
     exit(0);
    }
    elseif ($_FILES["image"]["size"] > 500000) {
     $_SESSION['status'] = "Sorry, your file is too large.";
     header('Location: event');
     exit(0);
    } 
    else {
      $sql = "INSERT INTO event (name, venue, image) VALUES ('$eventname', '$venue', '$filename')";
      $result = mysqli_query($conn, $sql);

      if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/images/'.$filename);
        $_SESSION['status'] = "Event Added Successfully";
        header('Location: event');
        exit(0);
      }
      else{
        $_SESSION['status'] = "Event Registration Failed";
        header('Location: event');
        exit(0);
      }
    }
    
    $sql = "CREATE TABLE '$eventname' (
      id INT NOT NULL AUTO_INCREMENT, 
      firstname VARCHAR(100) NOT NULL, 
      lastname VARCHAR(100) NOT NULL, 
      fullname VARCHAR(100) NOT NULL, 
      email VARCHAR(100) NOT NULL, 
      phonenumber VARCHAR(100) NOT NULL, 
      companyname VARCHAR(100) NOT NULL, 
      position VARCHAR(100) NOT NULL, PRIMARY KEY(id)
    )";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      // code...
      $_SESSION['status'] = "Table created successfully.";
      header("Location: event");
      exit(0);
    } else {
      $_SESSION['status'] = "Woops! Something went wrong.";
      header("Location: event");
      exit(0);
    }
  }
  
  // Registration Form
  if (isset($_POST['save'])) {
    // code...
    header("Content-Type: application/json; charset=UTF-8");

    $field1 = {
      "id" => "",
      "eventname" => $_POST['eventname'],
      "label" => "firstname",
      "type" => "text",
      "placeholder" => "Enter First Name"
    };
  }
  
?>