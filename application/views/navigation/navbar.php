<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>Quiz</title>
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/navigation/navbar.css'; ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #5d7c96;">
	<a href="<?php echo base_url('home') ?>"> <img src="<?php echo CSS_URL.'assets/img/logo.svg'; ?>" class="logo"
		 alt="User Avatar"> </a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
			aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		</ul>
		<div class="user-account">
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
						<img src="https://www.w3schools.com/bootstrap4/img_avatar1.png" class="user-avatar"
							 alt="User Avatar">
						<?php echo $this->session->userdata('username'); ?>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?php echo base_url('quiz/manage') ?>">My Quizes</a>
						<a class="dropdown-item" href="#">Edit Profile</a>
						<a class="dropdown-item" href="#">Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
