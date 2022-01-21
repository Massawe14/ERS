<?php  
  session_start();

  include('includes/header.php');
  include('includes/sidemenu.php');
  include('includes/topbar.php');

  if (!isset($_SESSION['username'])) {
  	// code...
  	header("Location: authentication.php");
  	exit(0);
  }
?>

	<!-- cards -->
	<div class="cardBox">
		<div class="card">
			<div>
				<div class="numbers">1,000</div>
				<div class="cardName">Registered</div>
			</div>
			<div class="iconBx">
				<ion-icon name="person-add"></ion-icon>
			</div>
		</div>
		<div class="card">
			<div>
				<div class="numbers">950</div>
				<div class="cardName">Attended</div>
			</div>
			<div class="iconBx">
				<ion-icon name="pulse"></ion-icon>
			</div>
		</div>
		<div class="card">
			<div>
				<div class="numbers">1,504</div>
				<div class="cardName">Registered</div>
			</div>
			<div class="iconBx">
				<ion-icon name="person-add"></ion-icon>
			</div>
		</div>
		<div class="card">
			<div>
				<div class="numbers">950</div>
				<div class="cardName">Attended</div>
			</div>
			<div class="iconBx">
				<ion-icon name="pulse"></ion-icon>
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
						<td>Full Name</td>
						<td>Branch Name</td>
						<td>Zone</td>
						<td>Created At</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Ramadhani Massawe</td>
						<td>Singida</td>
						<td>Central</td>
						<td>2022-1-11</td>
					</tr>
					<tr>
						<td>Ramadhani Massawe</td>
						<td>Singida</td>
						<td>Central</td>
						<td>2022-1-11</td>
					</tr>
					<tr>
						<td>Ramadhani Massawe</td>
						<td>Singida</td>
						<td>Central</td>
						<td>2022-1-11</td>
					</tr>
					<tr>
						<td>Ramadhani Massawe</td>
						<td>Singida</td>
						<td>Central</td>
						<td>2022-1-11</td>
					</tr>
					<tr>
						<td>Ramadhani Massawe</td>
						<td>Singida</td>
						<td>Central</td>
						<td>2022-1-11</td>
					</tr>
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
					<div class="mask full">
  					<div class="fill"></div>
  				</div>
  				<div class="mask half">
  					<div class="fill"></div>
  				</div>
  				<div class="inside-circle">80%</div>
				</div>
			</div>
		</div>
	</div>
<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
  	