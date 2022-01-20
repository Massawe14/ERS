<?php  
  session_start();

  error_reporting(0);

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');

  if (!isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication.php");
  	exit(0);
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event</title>
	<style>
		/*body {
			font-family: Arial, Helvetica, sans-serif;
		    display: flex;
		    flex-direction: column;
		    justify-content: center;
		    align-items: center;
		    overflow: auto;
		}*/

		/* Full-width input fields */
		input[type=text], input[type=password], input[type=file], input[type=email], 
		input[type=tel] {
		    width: 100%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #ccc;
		    box-sizing: border-box;
		}

		/* Set a style for all buttons */
		input[type=submit]{
		    background-color: #e1251b;
		    color: white;
		    padding: 14px 20px;
		    margin: 8px 0;
		    border: none;
		    cursor: pointer;
		    width: 100%;
		    text-align: center;
		    text-decoration: none;

		}

		input[type=submit]:hover {
		    opacity: 0.8;
		}

		.wrapper {
			background-color: #fff;
			width: 1000px;
			padding: 25px;
			margin: 25px auto 0;
			box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
			border-radius: 20px;
		}

		.event {
		    padding: 80px;
		}

		input[type='button'] {
			background-color: #e1251b;
			color: white;
			padding: 14px 20px;
			border: none;
			cursor: pointer;
			width: 100%;
		}

		input[type='button']:hover {
			opacity: 0.8;
		}

		/*.cancel {
			width: 100%;
			background-color: #e1251b;
		}*/

		/*img.avatar {
		  width: 40%;
		  border-radius: 50%;
		}*/

		.eventcontainer {
			padding: 16px;
		}

		.modal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0, 0, 0);
			background-color: rgba(0, 0, 0, 0.4);
			padding-top: 60px;
		}

		.modal-content {
			background-color: #fefefe;
			margin: 5% auto 15% auto;
			border: 1px solid #888;
			width: 80%;
		}

		.close {
			position: absolute;
			right: 25px;
			top: 0;
	    color: #000;
	    font-size: 35px;
	    font-weight: bold;
		}

		.close:hover,
		.close:focus {
		  color: red;
		  cursor: pointer;
		}

		/* add animation */
		.animate {
		  -webkit-animation: animatezoom 0.6s;
		  animation: animatezoom 0.6s;
		}

		@-webkit-keyframes animatezoom {
	    from {-webkit-transform: scale(0)} 
	    to {-webkit-transform: scale(1)}
		}
		    
		@keyframes animatezoom {
	    from {transform: scale(0)} 
	    to {transform: scale(1)}
		}

		/*@media screen and (max-width: 300px) {
	    .cancel {
	      width: 100%;
	    }
		}*/

		.controls {
			width: 294px;
			margin: 15px auto;

		}

		#remove_fields {
			float: right;
		}

		.controls a ion-icon {
			margin-right: 5px;
		}

		a {
			color: black;
			text-decoration: none;
		}

	</style>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("fname").style.display = "block";
			else document.getElementById("fname").style.display = "none";
			return;
		}
	</script>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("lname").style.display = "block";
			else document.getElementById("lname").style.display = "none";
			return;
		}
	</script>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("fullname").style.display = "block";
			else document.getElementById("fullname").style.display = "none";
			return;
		}
	</script>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("email").style.display = "block";
			else document.getElementById("email").style.display = "none";
			return;
		}
	</script>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("pnumber").style.display = "block";
			else document.getElementById("pnumber").style.display = "none";
			return;
		}
	</script>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("cname").style.display = "block";
			else document.getElementById("cname").style.display = "none";
			return;
		}
	</script>
	<script>
		function text(x) {
			if (x == 0) document.getElementById("position").style.display = "block";
			else document.getElementById("position").style.display = "none";
			return;
		}
	</script>
</head>
<body>

	<div class="wrapper">
		<form action="code.php" method="POST" enctype="multipart/form-data">
		    <div class="event">
		      <h2 align="center">Add Event</h2>
		      <label for="ename">Event Name</label>
		      <input type="text" name="eventname" placeholder="Enter Event Name" value="<?php echo $eventname; ?>" required/>
		      <label for="venue">Venue</label>
		      <input type="text" name="venue" placeholder="Enter Event Venue" value="<?php echo $venue; ?>" required/>
		      <label for="artwork">Artwork</label>
		      <input type="file" name="image" value="<?php echo $image; ?>" required/>  
		      <input type="submit" value="Next" name="addEvent" onclick="document.getElementById('eventmodal').style.display='block'">
		    </div>
		</form>
	</div>

	<!-- Event Modal -->
	<div class="modal" id="eventmodal">
		<form class="modal-content animate" action="#" method="POST">
			<div class="img">
				<span onclick="document.getElementById('eventmodal').style.display='none'" class="close" title="close button">&times;</span>
				<!-- <img src="" alt="Avatar" class="avater"> -->
			</div>
			<div class="eventcontainer">
				<h2 align="center">Event Registration Form</h2>
				<div class="input-group" id="fname">
					<label for="firstname">First Name</label>
					<input type="text" name="firstname" placeholder="Enter First Name" required>
					<span class="radio"></span>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="firstname" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="firstname" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="input-group" id="lname">
					<label for="lastname">Last Name</label>
					<input type="text" name="lastname" placeholder="Enter Last Name" required>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="lastname" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="lastname" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="input-group" id="fullname">
					<label for="fullname">Full Name</label>
					<input type="text" name="fullname" placeholder="Enter Full Name" required>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="fullname" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="fullname" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="input-group" id="email">
					<label for="email">Email</label>
					<input type="email" name="email" placeholder="Enter Email Address" required>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="email" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="email" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="input-group" id="pnumber">
					<label for="phonenumber">Phone Number</label>
					<input type="tel" name="phonenumber" placeholder="Enter Phone Number" required>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="phonenumber" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="phonenumber" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="input-group" id="cname">
					<label for="companyname">Company Name</label>
					<input type="text" name="companyname" placeholder="Enter Company Name" required>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="companyname" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="companyname" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<div class="input-group" id="position">
					<label for="position">Position</label>
					<input type="text" name="position" placeholder="Enter Position" required>
				</div>
				<div class="p-t-10">
					<label class="radio-container">Yes
						<input type="radio" name="position" value="YES" onclick="text(0)" checked>
						<span class="checkmark"></span>
					</label>
					<label class="radio-container">No
						<input type="radio" name="position" value="NO" onclick="text(1)">
						<span class="checkmark"></span>
					</label>
				</div>
				<input type="button" value="Save" name="submit">
			</div>
		</form>
	</div>

	<?php include('includes/script.php'); ?>
	<!-- how to make close when click on any point of the browser -->
	<script>
		var modal = document.getElementById('eventmodal');
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
	</script>
</body>
</html>