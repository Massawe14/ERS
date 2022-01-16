<?php  
  include('auth.php');
  include('config/dbconn.php');

  if (isset($_POST['logout_btn'])) {
    // session_destroy();
    unset($_SESSION['auth']);
    // unset($_SESSION['auth_admin']);

    $_SESSION['status'] = "Logged out successfully";
    header('Location: authentication.php');
    exit(0);
  }

  // USER
  if (isset($_POST['check_Emailbtn'])) {

    $useremail = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$useremail'";
    $checkemail_result = mysqli_query($conn, $checkemail);

    if (mysqli_num_rows($checkemail_result) > 0) {
      echo "Email Already Exists";
    }
    else{
      echo "It's Available";
    }
  }

  if (isset($_POST['signupbtn'])) {
    // there are no errors so let's get data from the form
    $username = $_POST['username'];
    $useremail = $_POST['email'];
    $password = $_POST['password'];

    // password encryption
    $password_encrypt = password_hash($password, PASSWORD_DEFAULT);

    $checkemail = "SELECT email FROM users WHERE email='$useremail'";
    $checkemail_result = mysqli_query($conn, $checkemail);

   if (mysqli_num_rows($checkemail_result) > 0) {
     // Taken - Already Exists
     $_SESSION['status'] = "Email Already Exists";
     header('Location: authentication.php');
     exit(0);
   }
   else{
      // Now we have collected the form data in variables
      // Let's insert them to the table
      $query = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('$username', '$useremail', '$password_encrypt')";
      $result = mysqli_query($conn, $query); 

      if ($result) {
        $_SESSION['status'] = "Registration Successfully";
        header('Location: authentication.php');
        exit(0);
      }
      else{
        $_SESSION['status'] = "Registration Failed";
        header('Location: authentication.php');
        exit(0);
      }
    }
  }
?>