<?php  
  session_start();

  error_reporting(0);

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');

  if (!isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication.php");
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
		input[type=text], input[type=password], input[type=file] {
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

		.event {
		    padding: 80px;
		}
	</style>
</head>
<body>
	<form action="code.php" method="post" enctype="multipart/form-data">
	    <div class="event">
	      <h2 align="center">Add Event</h2>
	      <label for="ename"><b>Event Name</b></label>
	      <input type="text" name="eventname" value="<?php echo $eventname; ?>" required/>
	      <label for="venue"><b>Venue</b></label>
	      <input type="text" name="venue" value="<?php echo $venue; ?>" required/>
	      <label for="artwork"><b>Artwork</b></label>
	      <input type="file" name="image" value="<?php echo $image; ?>" required/>  
	      <input type="submit" value="Next" name="addEvent">
	    </div>
	</form>
	<?php include('includes/script.php'); ?>
</body>
</html>