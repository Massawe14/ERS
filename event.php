<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Event</title>
	<link rel="stylesheet" type="text/css" href="css/event.css">
</head>
<body>
	<form action="#" class="form">
		<h2 class="text-center">Event Registration Form</h2>
		<!-- Progress bar -->
		<div class="progressbar">
			<div class="progress" id="progress"></div>
			<div class="progress-step progress-step-active" data-title="Intro"></div>
			<div class="progress-step" data-title="Contact"></div>
			<div class="progress-step" data-title="ID"></div>
			<div class="progress-step" data-title="Password"></div>
		</div>
		<!-- Steps -->
		<div class="form-step form-step-active">
			<div class="input-group">
				<label for="eventname">Eventname</label>
				<input type="text" name="eventname" id="eventname" />
			</div>
			<div class="input-group">
				<label for="venue">Venue</label>
				<input type="text" name="venue" id="venue" />
			</div>
			<div class="">
				<a href="#" class="btn btn-next width-50 ml-auto">Next</a>
			</div>
		</div>
		<div class="form-step">
			<div class="input-group">
				<label for="eventname">Eventname</label>
				<input type="text" name="eventname" id="eventname" />
			</div>
			<div class="input-group">
				<label for="venue">Venue</label>
				<input type="text" name="venue" id="venue" />
			</div>
			<div class="btns-group">
				<a href="#" class="btn btn-prev">Previous</a>
				<a href="#" class="btn btn-next">Next</a>
			</div>
		</div>
		<div class="form-step">
			<div class="input-group">
				<label for="eventname">Eventname</label>
				<input type="text" name="eventname" id="eventname" />
			</div>
			<div class="input-group">
				<label for="venue">Venue</label>
				<input type="text" name="venue" id="venue" />
			</div>
			<div class="btns-group">
				<a href="#" class="btn btn-prev">Previous</a>
				<a href="#" class="btn btn-next">Next</a>
			</div>
		</div>
		<div class="form-step">
			<div class="input-group">
				<label for="eventname">Eventname</label>
				<input type="text" name="eventname" id="eventname" />
			</div>
			<div class="input-group">
				<label for="venue">Venue</label>
				<input type="text" name="venue" id="venue" />
			</div>
			<div class="btns-group">
				<a href="#" class="btn btn-prev">Previous</a>
				<input type="submit" value="Submit" class="btn" />
			</div>
		</div>
	</form>
</body>
</html>