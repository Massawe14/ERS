<?php  
  
  session_start();
  session_destroy();

  header("Location: authentication");
  exit(0);

?>