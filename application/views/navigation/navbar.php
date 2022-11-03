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
	<style type="text/css">
		.navbar {
			background-color: #253341;
		}
		.navbar-brand {
			color: #fff;
		}
		.navbar-brand:hover {
			color: #fff;
		}
		.navbar-nav li a {
			color: #fff;
			font-weight: 400;
		}
		.navbar-nav li a:hover {
			color: #5299D3;
		}
		.navbar-nav li.active a {
			color: #962b2b;
		}
		.navbar-nav li.active a:hover {
			color: #fff;
		}
	/*	add padding to button */
		.btn {
			margin-left: 10px;
			margin-right: 10px;
		}
	</style>
	<title>Quiz</title>


	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<a class="navbar-brand" href="#">Hidden brand</a>
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item">
				<a class="nav-link" href="#">Manage Quiz's</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">User Account</a>
			</li>
		</ul>
<!--		Conditionally Render if search and create quiz fields -->
		<?php if ($show_search_bar) : ?>
			<form class="form-inline my-2 my-lg-0" action="<?php echo base_url('quiz/search')?>" method="get">
				<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search Quizes" aria-label="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
		<?php endif; ?>
		<?php if ($show_action_button) : ?>
			<button class="btn btn-info my-2 my-sm-0" type="submit">Create Quiz</button>
		<?php endif; ?>

	</div>
</nav>

</body>
</html>
