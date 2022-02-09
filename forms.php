<?php  
  include('config/dbconn.php');

  if (isset($_GET['event_id'])) {
  	$event_id = $_GET['event_id'];
    $sql = "SELECT * FROM event WHERE id = '$event_id'";
		$result = mysqli_query($conn, $sql);

		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$name = $row['name'];
				$image = $row['image'];
			}
		}
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration Form</title>
	<style>
		body {
		  font-family: Arial, Helvetica, sans-serif;
		  display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			overflow: auto;
		}

		/* Full-width input fields */
		input[type=text], input[type=password], input[type=phone], 
		input[type=email], input[type=tel], input[type=number] {
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

		/* Extra styles for the cancel button */
		.cancelbtn {
	    width: auto;
	    padding: 10px 18px;
	    background-color: #f44336;
		}

		/* Center the image and position the close button */
		.imgcontainer {
	    text-align: center;
	    margin: 24px 0 12px 0;
	    position: relative;
		}

		img.avatar {
	    width: 40%;
	    border-radius: 50%;
		}
        
    /* Fields container */
		.container {
		  padding: 16px;
		}
        
    /* Submit button container */
		.submit-button {
			padding: 16px;
		}

		span.psw {
	    float: right;
	    padding-top: 16px;
		}

		/* The Modal (background) */
		.modal {
	    /* Hidden by default */
	    position: fixed; /* Stay in place */
	    z-index: 1; /* Sit on top */
	    left: 0;
	    top: 0;
	    width: 100%; /* Full width */
	    height: 100%; /* Full height */
	    overflow: auto; /* Enable scroll if needed */
	    background-color: rgb(0,0,0); /* Fallback color */
	    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	    padding-top: 60px;
		}

		/* Modal Content/Box */
		.modal-content {
	    background-color: #fefefe;
	    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
	    border: 1px solid #888;
	    width: 80%; /* Could be more or less, depending on screen size */
		}

		/* The Close Button (x) */
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

		/* Add Zoom Animation */
		.animate {
	    -webkit-animation: animatezoom 0.6s;
	    animation: animatezoom 0.6s
		}

		@-webkit-keyframes animatezoom {
	    from {-webkit-transform: scale(0)} 
	    to {-webkit-transform: scale(1)}
		}
		    
		@keyframes animatezoom {
	    from {transform: scale(0)} 
	    to {transform: scale(1)}
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
	    span.psw {
       display: block;
       float: none;
	    }
	    .cancelbtn {
	      width: 100%;
	    }
		}

		#qrSucc {
		  width: 800px;
		  height: 800px;
		  margin:  8px 8px 20px 8px;
		  text-align: center;
		  overflow: auto;
		  position: relative;
		  display: flex;
		  flex-direction: column;
		}

		#result {
	    width: 800px;
	    height: 690px;
	    margin-bottom: 20px !important;
	    background: white;
	    position:  relative;
	    display: flex;
	    flex-direction: column;
	    padding: 0 !important;
	    margin: 0 !important;
		}

		#img {
	    width: inherit;
	    height: 695px;
	    position:  absolute;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    z-index: 0;
	    padding: 0 !important;
	    margin: 0 !important;
		}

		#contents {
	    width: 800px;
	    height: 695px;
	    position:  absolute;
	    z-index: 1;
	    padding: 0 !important;
	    margin: 0 !important;
	    display: flex;
	    flex-direction: column;
	    justify-content: center;
	    align-items: center;
		}

		#qrSucc a {
	    background-color: #e1251b;
	    color: white;
	    padding: 14px 20px;
	    margin: 20px 20px -40px 20px;
	    border: none;
	    cursor: pointer;
	    width: 100%;
	    text-align: center;
	    text-decoration: none;
		}

		#qrSucc a:hover {
			opacity: 0.8;
		}
	</style>
</head>
<body>
	<?php  
	  if(isset($_GET['success'])) {
		  ?>
			  <div id="qrSucc" class="convert">
		      <div id="result" class="modal-content animate container">
		        <img id="img" src="<?php echo "uploads/images/".$image; ?>" />  
		        <div id="contents">
		          <p style="color: white; font-weight: 200; font-size: 40px;"><?php echo strtoupper($_GET['field']); ?></p>
		          <p style="color: white;">YOU ARE INVITED TO THE</p>
		          <p><?php echo strtoupper($name); ?></p>
		          <img src="plugins/userQr/<?php echo $_GET['success']; ?>" alt="">
		          <p style="color: white; font-weight: 50; font-size: 15px;">Please carry this invite with you to the event</p>
		        </div>
		      </div>
		      <div id="output" hidden></div>
		      <a class="a" href="">Download Now</a>
		   </div>
		  <?php
	  } 
	  else {
			?>
				<div id="id01" class="modal">
					<form id="form" class="modal-content animate" action="code.php" method="POST" enctype="multipart/form-data">
						<div class="container" id="container">
							<h2 align="center">Registration Form</h2>
							<input type="hidden" name="event_id" value="<?php echo $_GET['event_id']; ?>">
						</div>
						<div class="submit-button">
							<input type="submit" id="submit" value="Submit" name="create">
						</div>
					</form>
				</div>
			<?php
	  }
	?>
	<script type="text/javascript">

		// Load json data from mysql
		var event_fields = <?php  
    if (isset($_GET['event_id'])) {
    	$event_id = $_GET['event_id'];
    	$sql = "SELECT * FROM form_setting WHERE event_id = '$event_id'";
			$result = mysqli_query($conn, $sql);

			$json_array = array();
			while ($row = mysqli_fetch_assoc($result)) {
			  $json_array[] = $row;
			}
			print(json_encode($json_array));
    }
		?>

		console.log(event_fields, typeof event_fields);

    const element = document.createElement("div");
    element.className = "allFields";
    element.id = "fields";
    var temp = "";
		if (event_fields.length > 0) {
			for (var item in event_fields[0]) {
				const key = item + "";
				const value = event_fields[0][item];
				console.log("key: ", key);
				console.log("value: ", value);
				if (key.startsWith("field") && value) {
					const field = value;
					const field_input_name = key + ""
					if (field.length > 0) {
						const div = document.createElement("div");
						// div.className = "input-field";
						const field_json = JSON.parse(field);
						// temp += "<div>";
						temp += "<label>" + field_json["name"] + "</label>";
						temp += "<input type=\"" + field_json["type"] + "\" name=\"" + field_input_name + "\" placeholder=\"" + field_json["hint"] + "\" />";
						element.innerHTML = temp;
						// element.appendChild(div);
					}
				}
			}

			document.getElementById("container").appendChild(element);
		}

		const submit = document.getElementById("submit");
		submit.onclick = () => {
			var form = $("#container");
			$.ajax({
			   cache: false,
			   url: form.attr('action'),
			   type: form.attr('method'),
			   dataType: 'php',
			   data: form.serialize(),
			   success: success,
			   error: error
			});
		}
	</script>
	<script src="plugins/html2canvas.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.3/html2canvas.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
	    const elm = document.querySelector("#result");
	    html2canvas(elm).then(function (canvas) {
	        document.querySelector("#output").append(canvas);
	        let cvs = document.querySelector("canvas");
	        let a = document.querySelector(".a")
	        a.href = cvs.toDataURL();
	        a.download = "invation.png";
	    });
	</script>
</body>
</html>