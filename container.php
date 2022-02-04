<?php  
  include('config/dbconn.php');

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');
  include('includes/message.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/container.css">
	<script src="scripts/container.js"></script>
	<title>Event Container</title>
</head>
<body>
	<form action="#" class="form">
		<ul class="nav nav-tabs">
			<li class="nav-items">
				<a href="#" class="nav-link active_tab1" style="border: 1px solid #ccc;" id="list_event_details">Event Details</a>
			</li>
			<li class="nav-items">
				<a href="#" class="nav-link inactive_tab1" style="border: 1px solid #ccc;" id="list_form_details">Create Registration Form</a>
			</li>
			<li class="nav-items">
				<a href="#" class="nav-link inactive_tab1" style="border: 1px solid #ccc;" id="list_preview_details">Preview Form</a>
			</li>
		</ul>
		<h1 class="text-center">Add Event</h1>
		<div class="form-step form-step-active">
			<div class="input-group">
				<label for="eventname">Event Name</label>
				<input type="text" id="eventname" name="eventname" placeholder="Enter Event Name">
			</div>
			<div class="input-group">
				<label for="venue">Venue</label>
	            <input type="text" id="venue" name="venue" placeholder="Enter Event Venue">
			</div>
			<div class="input-group">
				<label for="artwork">Artwork</label>
	            <input type="file" id="artwork" name="image"> 
			</div>
			<div class="">
				<a href="#" class="btn btn-next width-50 ml-auto">Next</a>
			</div>
		</div>
	</form>
	<?php include('includes/script.php'); ?>
</body>
</html>