<?php  
  session_start();

  error_reporting(0);

  include "eventdb.php";

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');
  include('includes/message.php');

  if (!isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication");
  	exit(0);
  }

  if (isset($_POST['addEvent'])) {
  	// code...
  	$eventname = $_POST['eventname'];
  	$venue = $_POST['venue'];
  	$image = $_FILES['image']['name'];

  	if ($eventname == '' || $venue == '' || $image == '') {
  		// code...
  		$_SESSION['status'] = "Please check the missing field";
    	$_SESSION['status_code'] = "error";
      header('Location: event');
      exit(0);
  	}
  	else {
  		$allowed_extension = array('png','jpg','jpeg');
	    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

	    $filename = time().'.'.$file_extension;

	    $check = getimagesize($_FILES["image"]["tmp_name"]);

	    if ($check == false) {
	    	// code...
	    	$_SESSION['status'] = "File is not an image.";
	    	$_SESSION['status_code'] = "error";
	      header('Location: event');
	      exit(0);
	    }
	    elseif (file_exists($filename)) {
	     $_SESSION['status'] = "Sorry, file already exists.";
	     $_SESSION['status_code'] = "error";
	     header('Location: event');
	     exit(0);
	    }
		  elseif (!in_array($file_extension, $allowed_extension)) {
		    $_SESSION['status'] = "You are allowed with only jpg, png and jpeg Image";
		    $_SESSION['status_code'] = "error";
		    header('Location: event');
		    exit(0);
		  }
		  else {
		  	$sql = $db->insert($eventname,$venue,$filename);

		  	if($sql == true)
	      {
	        $_SESSION['status'] = "Thank You. Event created successfully";
	        $_SESSION['status_code'] = "success";
	        header('Location: event');
	        exit(0);
	      }
	      else
	      {
	        $_SESSION['status'] = "cant create Event";
	        $_SESSION['status_code'] = "error";
	        header('Location: event');
	        exit(0);
	      }
		  }
  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
			padding: 15px;
		}

		.input-group {
			display: none;
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
</head>
<body>

	<div class="wrapper">
		<form method="POST" enctype="multipart/form-data">
		    <div class="event">
		      <h2 align="center">Add Event</h2>
		      <label for="ename">Event Name</label>
		      <input type="text" name="eventname" placeholder="Enter Event Name" value="<?php echo $_POST['eventname']; ?>">
		      <label for="venue">Venue</label>
		      <input type="text" name="venue" placeholder="Enter Event Venue" value="<?php $_POST['venue']; ?>">
		      <label for="artwork">Artwork</label>
		      <input type="file" name="image" value="<?php echo $_POST['filename']; ?>">  
		      <input type="submit" value="Next" name="addEvent">
		    </div>
		</form>
	</div>

	<!-- Event Modal -->
	<div class="modal" id="eventmodal">
		<form class="modal-content animate" method="POST">
			<div class="img">
				<span onclick="document.getElementById('eventmodal').style.display='none'" class="close" title="close button">&times;</span>
				<!-- <img src="" alt="Avatar" class="avater"> -->
			</div>
			<div class="eventcontainer">
				<h2 align="center">Event Registration Form</h2>
				<div class="checkbox-card">
					<label for="firstname">First Name</label>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="firstname" id="firstname"> Yes
						</label>
					</div>
					<div class="input-group" id="fname">
						<!-- <label for="firstname">First Name</label> -->
						<input type="text" name="firstname" placeholder="Enter First Name" required>
					</div>
				</div>
				<div class="checkbox-card">
					<label for="lastname">Last Name</label>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="lastname" id="lastname"> Yes
						</label>
					</div>
					<div class="input-group" id="lname">
						<!-- <label for="lastname">Last Name</label> -->
						<input type="text" name="lastname" placeholder="Enter Last Name" required>
					</div>
				</div>
				<div class="checkbox-card">
					<label for="fullname">Full Name</label>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="fullname" id="fullname"> Yes
						</label>
					</div>
					<div class="input-group" id="fullname">
						<!-- <label for="fullname">Full Name</label> -->
						<input type="text" name="fullname" placeholder="Enter Full Name" required>
					</div>
				</div>
				<div class="checkbox-card">
					<label for="email">Email</label>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="email" id="email"> Yes
						</label>
					</div>
					<div class="input-group" id="email">
						<!-- <label for="email">Email</label> -->
						<input type="email" name="email" placeholder="Enter Email Address" required>
					</div>
				</div>
				<div class="checkbox-card">
					<label for="phonenumber">Phone Number</label>
					<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="phonenumber" id="phonenumber"> Yes
						</label>
					</div>
					<div class="input-group" id="pnumber">
						<!-- <label for="phonenumber">Phone Number</label> -->
						<input type="tel" name="phonenumber" placeholder="Enter Phone Number" required>
					</div>
			  </div>
			  <div class="checkbox-card">
			  	<label for="companyname">Company Name</label>
			  	<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="companyname" id="companyname"> Yes
						</label>
					</div>
					<div class="input-group" id="cname">
						<!-- <label for="companyname">Company Name</label> -->
						<input type="text" name="companyname" placeholder="Enter Company Name" required>
					</div>
			  </div>
			  <div class="checkbox-card">
			  	<label for="position">Position</label>
			  	<div class="checkbox">
						<label>
							<input type="checkbox" class="checkme" value="position" id="position"> Yes
						</label>
					</div>
					<div class="input-group" id="position">
						<!-- <label for="position">Position</label> -->
						<input type="text" name="position" placeholder="Enter Position" required>
					</div>
				</div>	
				<input type="button" value="Save Form" name="save">
			</div>
		</form>
	</div>

	<?php include('includes/script.php'); ?>
	<!-- how to make close when click on any point of the browser -->
	<script>
		var valueList = document.getElementById('valueList');
		var text = '<span> you have selected : </span>'
		var listArray = [];
		var checkboxes = document.querySelectorAll('.checkme');

		for (var checkbox of checkboxes) {
			checkbox.addEventListener('click',function(){
				if (this.checked == true) {
					$(this).parents(".checkbox-card").find('.input-group').show();
					console.log(this.value);
					listArray.push(this.value);
					valueList.innerHTML = text + listArray.join(' / ');
				}
				else {
					$(this).parents(".checkbox-card").find('.input-group').hide();
					console.log('You unchecked the checkbox');
					listArray = listArray.filter(e => e !== this.value);
					valueList.innerHTML = text + listArray.join(' / ');
				}
			});
		}
	</script>
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