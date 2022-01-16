<!-- main -->
  	<div class="main">
  		<div class="topbar">
  			<div class="toggle">
  				<ion-icon name="menu"></ion-icon>
  			</div>
  			<!-- search -->
  			<div class="search">
  				<label>
  					<input type="text" placeholder="Search here">
  					<ion-icon name="search"></ion-icon>
  				</label>
  			</div>
  			<!-- userimg -->
  			<div class="user">
  				<?php echo "Welcome" . $_SESSION['username']; ?>
  				<img src="assets/Passport.jpg">
  			</div>
  		</div>