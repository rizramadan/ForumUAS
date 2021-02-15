<?php
session_start();
if (isset($_SESSION['username'])) {
    
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="css/register.css">
	</head>

	<body>

		<div class="wrapper" style="background-image: url('images/signup-image.jpg');">
			<div class="inner">
				<div class="image-holder">
					<img src="images/signup-image.jpg" alt="">
				</div>
				<form action="config/register.php" method="POST">
					<h3>Registration Form</h3>
					<div class="form-group">
						<input type="text" name="namadepan" placeholder="Nama Depan" class="form-control">
						<input type="text" name="namabelakang" placeholder="Nama Belakang" class="form-control">
					</div>
					<div class="form-wrapper">
						<select name="jeniskelamin" id="" class="form-control">
							<option value="" disabled selected>Jenis Kelamin</option>
							<option value="Pria">Pria</option>
							<option value="Wanita">Wanita</option>
						</select>
						<i class="zmdi zmdi-caret-down" style="font-size: 17px"></i>
					</div>
					<div class="form-wrapper">
						<input type="text" name="username" placeholder="Username" class="form-control">
						<i class="zmdi zmdi-account"></i>
					</div>
					<div class="form-wrapper">
						<input type="email" name="email" placeholder="Email Address" class="form-control">
						<i class="zmdi zmdi-email"></i>
					</div>
					
					<div class="form-wrapper">
						<input type="password" name="password" id="password" placeholder="Password" class="form-control">
						<i class="zmdi zmdi-lock"></i>
					</div>
					<div class="form-wrapper">
						<input type="number" name="notel" placeholder="No.Telpon" class="form-control">
						<i class="zmdi zmdi-phone"></i>
					</div>
					<div class="form-wrapper">
						<input type="text" name="alamat" placeholder="Alamat" class="form-control">
						<i class="zmdi zmdi-city"></i>
					</div>
				
					<!-- <div class="form-wrapper">
						<input type="password" placeholder="Confirm Password" class="form-control">
						<i class="zmdi zmdi-lock"></i>
					</div> -->
				
					<button type="submit" name="register" class="btn btn-primary">Register
						<i class="zmdi zmdi-arrow-right"></i>
					</button>
				</form>
			</div>
		</div>
		
	</body>
</html>