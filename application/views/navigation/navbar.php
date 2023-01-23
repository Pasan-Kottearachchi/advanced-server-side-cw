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
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #797a9e;">
<!--	<div class="navbar-wrapper">-->
		<a href="<?php echo base_url('home') ?>" class="logo_a">
			<img src="<?php echo CSS_URL.'assets/img/quzzy_time_logo.png'; ?>" class="logo" alt="User Avatar">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
				aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
<!--			<span class="navbar-toggler-icon"></span>-->
			<label for="check" class="toggler-icon">
				<span></span>
				<span></span>
				<span></span>
			</label>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			</ul>
			<div class="user-account">
				<ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle navbar-user-name" href="#" id="navbardrop" data-toggle="dropdown">
							<img src="<?php echo CSS_URL.'assets/img/avtar.png'; ?>" class="user-avatar"
								 alt="User Avatar">
							Hi, <?php echo $this->session->userdata('name'); ?>
						</a>
						<div class="dropdown-menu stay-open">
							<a class="dropdown-item" href="<?php echo base_url('quiz/manage') ?>">My Quizes</a>
							<a class="dropdown-item" href="<?php echo base_url('profile/'.$this->session->userdata('user_id')) ?>">Edit Profile</a>
							<a class="dropdown-item" href="<?php echo base_url('logout') ?>">Logout</a>
						</div>
					</li>
				</ul>
			</div>
<!--		</div>-->
	</div>

</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
