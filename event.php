<?php  
  session_start();

  error_reporting(0);

  include('config/dbconn.php');

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');
  include('includes/message.php');

  if (!isset($_SESSION['username'])) {
  	header("Location: authentication");
  	exit(0);
  }

  if (isset($_POST['addEvent'])) {
		$eventname = $_POST['eventname'];
		$venue = $_POST['venue'];
		$image = $_FILES['image']['name'];
		// generate random id with string length of 10
		$eventid = substr(md5(time()), 0, 10) . "";
		//$id = date('YmdHis');
		//$id = $id . rand(10, 99);

  	if ($eventname == '' || $venue == '' || $image == '') {
  		$_SESSION['status'] = "Please check the missing field";
    	$_SESSION['status_code'] = "error";
		header('Location: event');
		exit(0);
  	}
  	else {
  		$allowed_extension = array('png','jpg','jpeg', 'PNG', 'JPG', 'JPEG');
	    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

	    $filename = time().'.'.$file_extension;

	    $check = getimagesize($_FILES["image"]["tmp_name"]);

	    if ($check == false) {
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
			$_SESSION['status'] = "You are allowed with only jpg, png, jpeg, PNG, JPG and JPEG Image";
			$_SESSION['status_code'] = "error";
			header('Location: event');
			exit(0);
		}
		else {
			$sql = "INSERT INTO event (id, name, venue, image) VALUES ('$eventid', '$eventname', '$venue', '$filename')";
			$result = mysqli_query($conn, $sql);

			if($result) {
				move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/images/'.$filename);
				$_SESSION['status'] = "Thank You. Event created successfully";
				$_SESSION['status_code'] = "success";
				header('Location: form-setting.php?event_id='.$eventid);
				exit(0);
			}
			else {
				$_SESSION['status'] = "cant create Event";
				$_SESSION['status_code'] = "error";
				header('Location: event');
				exit(0);
			}
		}
  	}
  }

  if (isset($_POST['DeleteEventbtn'])) {
	$eventid = $_POST['delete_event'];

	$sql = "DELETE FROM event WHERE n = '$eventid'";
	$result = mysqli_query($conn, $sql);

	if ($result) {
	$_SESSION['status'] = "Event Deleted Successfully";
	$_SESSION['status_code'] = "success";
	header("Location: event");
	}
	else{
	$_SESSION['status'] = "Event Deleting Failed";
	$_SESSION['status_code'] = "error";
	header("Location: event");
	}
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
	<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
	<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-classic.css" />
	<title>Event</title>
	<style>

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
			margin: 80px 25px 25px 25px;
			/* box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5); */
			/*border-radius: 20px;*/
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

		.eventcontainer {
			padding: 15px;
		}

		.deletecontainer {
			padding: 30px;
		}

		.input-group {
			display: none;
		}

		.modal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 299px;
			top: 60px;
			width: 80%;
			height: 100%;
			overflow: auto;
			background-color: rgb(0, 0, 0);
			background-color: rgba(0, 0, 0, 0.4);
			padding-top: 60px;
		}

		#DeleteEventModal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 400px;
			top: 165px;
			width: 60%;
			height: 60%;
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
			right: 30px;
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

		.table {
			border-collapse: collapse;
			padding: 25px;
			margin: 25px auto 0;
			font-size: 0.9em;
			width: 100%;
			border-radius: 5px 5px 0 0;
			overflow: hidden;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
		}

		th, td {
			border: 1px solid #bbb;
			padding: 10px;
			text-align: center;
		}

		tr:hover {
		    background-color: #e5e5e5;
		}

		.tr:nth-child(even) {
		    background-color: #f2f2f2;
		}

		th {
			background-color: #e1251b;
			color: white;
			border: #e1251b;
		}

		.table tbody tr:last-of-type {
		   border-bottom: 2px solid #e1251b;
		}

		.btn {
			background-color: #e1251b;
			border: none;
			color: white;
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
		}

		.btn:hover {
		   opacity: 0.8;
		}

		#close {
			background-color: #287bff;
		}

		.btn-edit {
			background-color: #00263A;
			border: none;
			color: white;
			border-radius: 6px;
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
		}

		.btn-edit:hover {
			opacity: 0.8;
		}

		.btn-share-link {
			background-color: #187890;
			border: none;
			color: white;
			border-radius: 6px;
			padding: 10px 10px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			cursor: pointer;
		}

		.btn-share-link:hover {
			opacity: 0.8;
		}

		#ShareLinkModal {
			display: none;
			position: fixed;
			z-index: 1;
			left: 400px;
			top: 165px;
			width: 68%;
			height: 68%;
			overflow: auto;
			background-color: rgb(0, 0, 0);
			background-color: rgba(0, 0, 0, 0.4);
			padding-top: 60px;
		}

		.share {
			padding: 30px;
		}

		.social-media {
			display: flex;
			justify-content: center;
		}

		.social-icon {
		  height: 46px;
		  width: 46px;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		  margin: 0 0.45rem;
		  color: #333;
		  border-radius: 50%;
		  border: 1px solid #333;
		  text-decoration: none;
		  font-size: 1.1rem;
		  transition: 0.3s;
		}

		#envelope:hover {
			color: #e1251b;
			border-color: #e1251b;
		}

		#whatsapp:hover {
			color: green;
			border-color: green;
		}

		#telegram:hover {
			color: #287bff;
			border-color: #287bff;
		}

		#message:hover {
			color: yellow;
			border-color: yellow;
		}

		.jssocials-share-link { 
			border-radius: 50%; 
		}

	</style>
</head>
<body>

	<div class="wrapper">
		<div class="report-container">
    <div class="print-btn">
      <p>
        <button onclick="document.getElementById('eventmodal').style.display='block'" class="btn">Add Event</button>
      </p>
    </div>
    <div class="print-table">
      <table class="table" id="table">
        <thead>
          <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Venue</th>
            <th>Artwork</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        	<?php  
        	  $sql = "SELECT * FROM event";
        	  $result = mysqli_query($conn, $sql);

        	  if (mysqli_num_rows($result) > 0) {
        	  	foreach ($result as $row) {
        	  		?>
        	  		  <tr>
        	  		  	<td><?php echo $row['id'] ?></td>
        	  		  	<td><?php echo $row['name'] ?></td>
        	  		  	<td><?php echo $row['venue'] ?></td>
        	  		  	<td>
                      <img src="<?php echo "uploads/images/".$row['image']; ?>" width="100px" alt="image">
                    </td>
                    <td>
                      <a href="#?n=<?php echo $row['n']; ?>" class="btn-edit btn-info btn-sm">Edit</a>
                      <button type="button" onclick="document.getElementById('DeleteEventModal').style.display='block'" value="<?php echo $row['n']; ?>" class="btn btn-danger btn-sm deleteEventBtn">Delete</button>
                      <button type="button" onclick="document.getElementById('ShareLinkModal').style.display='block'" value="http://localhost/ERS/forms?event_id=<?php echo $row['id']; ?>" class="btn-share-link shareLinkBtn">Share Link</button>
                    </td>
        	  		  </tr>
        	  		<?php
        	  	}
        	  }
        	  else{
              ?>
                <tr>
                  <td>No Event Found</td>
                </tr>
              <?php
            }
        	?>
        </tbody>
      </table>
    </div>
  </div>
	</div>

	<!-- Share Link -->
  <div class="modal" id="ShareLinkModal">
    <form class="modal-content animate" method="POST">
    	<div class="img">
			<span onclick="document.getElementById('ShareLinkModal').style.display='none'" class="close" title="close button">&times;</span>
		</div>
      <div class="share" align="center">
      	<h2 align="center">Share now</h2>
        <input type="hidden" name="share_link" class="share_link_id">
        <div id="share-container"></div>
      </div>
    </form>
  </div>
  <!-- Share Link -->

	<!-- Delete User -->
  <div class="modal" id="DeleteEventModal">
    <form class="modal-content animate" method="POST">
      <div class="deletecontainer" align="center">
      	<h2 align="center">Delete Event</h2>
        <input type="hidden" name="delete_event" class="delete_event_id">
        <p>
          Are you sure. you want to delete this event ?
        </p>
        <button id="close" type="button" onclick="document.getElementById('DeleteEventModal').style.display='none'" class="btn btn-secondary">Close</button>
        <button type="submit" name="DeleteEventbtn" class="btn btn-danger">Delete</button>
      </div>
    </form>
  </div>
  <!-- Delete User -->

	<!-- Event Modal -->
	<div class="modal" id="eventmodal">
		<form class="modal-content animate" method="POST" enctype="multipart/form-data">
			<div class="img">
				<span onclick="document.getElementById('eventmodal').style.display='none'" class="close" title="close button">&times;</span>
			</div>
			<div class="eventcontainer">
				<h2 align="center">Add Event</h2>
				<label for="ename">Event Name</label>
				<input type="text" name="eventname" placeholder="Enter Event Name" value="<?php echo $_POST['eventname']; ?>">
				<label for="venue">Venue</label>
				<input type="text" name="venue" placeholder="Enter Event Venue" value="<?php $_POST['venue']; ?>">
				<label for="artwork">Artwork</label>
				<input type="file" name="image" value="<?php echo $_POST['filename']; ?>">  
				<input type="submit" value="Save" name="addEvent">
			</div>
		</form>
	</div>

<?php include('includes/script.php'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<!-- how to make close when click on any point of the browser -->
<script>
	document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("home").className = "";
		document.getElementById("event").className = "btn-active";
		document.getElementById("report").className = "";
		document.getElementById("form-setting").className = "";
	});
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
<script>
	$(document).ready(function () {

		$('.deleteEventBtn').click(function (e) {
		e.preventDefault();
		var event_id = $(this).val();
		$('.delete_event_id').val(event_id);
		$('.DeleteEventModal').modal('show');
		});

	});  
</script>
<script>
  $(document).ready(function () {

	$('.shareLinkBtn').click(function (e) {
	e.preventDefault();
	var event_id = $(this).val();
	$('.share_link_id').val(event_id);
	const url = event_id;
	$("#share-container").jsSocials({
		shareIn: "popup",
		showLabel: false,
		showCount: false,
		url: url,
		text: "Registration Form",
			shares: ["email", "twitter", "facebook", "whatsapp", "telegram"],
		});
	});

  });
</script>
</body>
</html>