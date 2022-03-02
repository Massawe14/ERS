<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/payment.css">
	<title>Payment Form</title>
</head>
<body>
	<form class="form-content">
		<div class="paymentcontainer">
			<h2 align="center">Payment Form</h2>
		    <label for="fname">Full Name</label>
		    <input type="text" name="fname" placeholder="Enter Full Name" value="">
		    <label for="pnumber">Phone Number</label>
		    <input type="text" name="pnumber" placeholder="Enter Phone Number" value="">
		    <label for="amount">Amount</label>
		    <input type="text" name="amount" placeholder="Enter Amount" value=""> 
		    <label for="currency_code">Currency Code</label> 
		    <select class="currency_code">
		    	<option value="text">TZS</option>
		        <option value="text">USD</option>             
		        <option value="text">KSH</option>             
		        <option value="text">EURO</option> 
		    </select>
		    <!-- <a href="index" class="button">Pay now</a> -->
		    <input type="submit" value="Checkout" name="checkout">
		</div>
	</form>
</body>
</html>