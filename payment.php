<?php  
  session_start();

  if (!isset($_SESSION['username'])) {
    // code...
    header("Location: authentication");
    exit(0);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Payment</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/payment.css">
</head>
<body>
	<div class="card-box">
		<div class="card-title">
			<h1>Select Payment Method</h1>
		</div>
		<div class="card">
			<input type="radio" id="tigopesa" name="card">
			<label for="tigopesa">
				<!-- <i class="fa fa-cc-visa"></i> -->
				<img src="assets/tigopesa.png" class="fa">
				<span>Tigo Pesa</span>
			</label>
		</div>
		<div class="card">
			<input type="radio" id="mpesa" name="card">
			<label for="mpesa">
				<!-- <i class="fa fa-cc-visa"></i> -->
				<img src="assets/mpesa.png" class="fa">
				<span>Mpesa</span>
			</label>
		</div>
		<div class="card">
			<input type="radio" id="airtelmoney" name="card">
			<label for="airtelmoney">
				<!-- <i class="fa fa-cc-visa"></i> -->
				<img src="assets/airtelmoney.png" class="fa">
				<span>Airtel Money</span>
			</label>
		</div>
		<div class="card">
			<input type="radio" id="visa" name="card">
			<label for="visa">
				<!-- <i class="fa fa-cc-visa"></i> -->
				<img src="assets/visa.png" class="fa">
				<span>Visa</span>
			</label>
		</div>
		<div class="card">
			<input type="radio" id="mastercard" name="card">
			<label for="mastercard">
				<!-- <i class="fa fa-cc-mastercard"></i> -->
				<img src="assets/mastercard.png" class="fa">
				<span>Mastercard</span>
			</label>
		</div>
	</div>
</body>
</html>