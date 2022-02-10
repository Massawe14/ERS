<?php  
  session_start();

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');
  include('config/dbconn.php');

  if (!isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication");
  	exit(0);
  }
?>

	<!-- cards -->
	<div class="cardBox">
		<div class="card">
			<div>
				<?php 
          $query = "SELECT id FROM event ORDER BY id";
          $result = mysqli_query($conn, $query);

          $row = mysqli_num_rows($result);
          echo '<div class="numbers">'.$row.'</div>';
        ?>
				<div class="cardName">Total Events</div>
			</div>
			<div class="iconBx">
				<ion-icon name="calendar"></ion-icon>
			</div>
		</div>
		<div class="card">
			<div>
				<?php 
          $query = "SELECT event_id FROM registered ORDER BY event_id";
          $result = mysqli_query($conn, $query);

          $row = mysqli_num_rows($result);
          echo '<div class="numbers">'.$row.'</div>';
        ?>
				<div class="cardName">Registered</div>
			</div>
			<div class="iconBx">
				<ion-icon name="person-add"></ion-icon>
			</div>
		</div>
		<div class="card">
			<div>
				<div class="numbers">0</div>
				<div class="cardName">Attended</div>
			</div>
			<div class="iconBx">
				<ion-icon name="stats"></ion-icon>
			</div>
		</div>
		<div class="card">
			<div>
				<?php 
          $query = "SELECT event_id FROM form_setting ORDER BY event_id";
          $result = mysqli_query($conn, $query);

          $row = mysqli_num_rows($result);
          echo '<div class="numbers">'.$row.'</div>';
        ?>
				<div class="cardName">Forms</div>
			</div>
			<div class="iconBx">
				<ion-icon name="list-box"></ion-icon>
			</div>
		</div>
	</div>

	<div class="details">
		<!-- event details list -->
		<div class="recentDetails">
			<div class="cardHeader">
				<h2>Event Details</h2>
				<a href="#" class="btn">View All</a>
			</div>
			<table>
				<thead>
					<tr>
						<td>Event ID</td>
						<td>Event Name</td>
						<td>Venue</td>
						<td>Artwork</td>
						<td>Registered At</td>
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
        	  		  	<td><?php echo $row['id']; ?></td>
        	  		  	<td><?php echo $row['name'] ?></td>
        	  		  	<td><?php echo $row['venue'] ?></td>
        	  		  	<td>
                      <img src="<?php echo "uploads/images/".$row['image']; ?>" width="100px" alt="image">
                    </td>
                    <td><?php echo $row['created_at'] ?></td>
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

		<!-- Total Register -->
		<div class="totalRegister">
			<div class="cardHeader">
				<h2>Total Registered</h2>
			</div>
			<div class="circle-wrap">
				<div class="circle">
					<!-- <div class="mask full">
  					<div class="fill"></div>
  				</div>
  				<div class="mask half">
  					<div class="fill"></div>
  				</div> -->
  				<div class="inside-circle">
  					<?php 
  					  $sql = "SELECT * FROM registered";
        	    $result = mysqli_query($conn, $sql);
        	    $totalrows = mysqli_num_rows($result);
        	    $total = $totalrows / 100;
        	    $percentage = $total * 100;
        	    $percentage = number_format($percentage, 0);
        	    // echo "$percentage%";
  					?>
  				</div>
				</div>
			</div>
		</div>
	</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
		document.getElementById("home").className = "btn-active";
		document.getElementById("event").className = "";
		document.getElementById("report").className = "";
		document.getElementById("form-setting").className = "";
	});
</script>
<script>
	let progressBar = document.querySelector(".circle-wrap");
	let valueContainer = document.querySelector(".inside-circle");

	let progressValue = 0;
	var progressEndValue = "<?=$percentage?>";
	console.log(progressEndValue);
	let speed = 20;

	let progress = setInterval(() => {
		progressValue++;
		valueContainer.textContent = `${progressValue}%`;
		progressBar.style.background = `conic-gradient(
		  #e1251b ${progressValue * 3.6}deg,
		  #f5f5f5 ${progressValue * 3.6}deg
		)`;
		if (progressValue == progressEndValue) {
			clearInterval(progress);
		}
	}, speed);
</script>