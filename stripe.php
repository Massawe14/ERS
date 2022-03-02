<?php 
  require_once('vendor/autoload.php');
  
  $stripe = new \Stripe\StripeClient('sk_test_51Ece');
  echo 'Making requests!'; 
?>