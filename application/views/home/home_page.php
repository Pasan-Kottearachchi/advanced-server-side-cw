<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Quizzy Time</title>
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/home/home.css'; ?>">
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
		  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body class="body">
<div>
	<?php if ($this->session->flashdata('success')) : ?>
		<div class="alert alert-success alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
	<div class="table-header">
		<div class="screen-name">
			<h5 class="heading">All Quizes</h5>
		</div>
		<!--		-->
		<div class="add-form">
			<a href="<?= base_url('quiz/new'); ?>" class="btn btn-info my-2 my-sm-0">Add Quiz</a>
		</div>
		<div class="search-form">
			<form action="<?= base_url('quiz/search'); ?>" method="get">
				<div class="input-group">
					<input type="text" class="form-control" name="search" placeholder="Search Quizes">
					<span class="input-group-btn">
						<button class="btn btn-secondary" type="submit">Go!</button>
					</span>
				</div>
			</form>
		</div>
		<!--		Add search and add-quiz buttons here-->
		<!--		<form class="add-form form-inline my-2 my-lg-0" action="-->
		<?php //echo base_url('quiz/new')?><!--">-->
		<!--			<button class="btn btn-info my-2 my-sm-0" type="submit">Create Quiz</button>-->
		<!--		</form>-->
		<!--		<form class="search-form form-inline my-2 my-lg-0" action="-->
		<?php //echo base_url('quiz/search')?><!--" method="get">-->
		<!--			<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search Quizes" aria-label="Search">-->
		<!--			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>-->
		<!--		</form>-->
	</div>
	<div class="table-div">
		<table class="table table-sm table-striped">
			<thead>
			<tr>
				<th scope="col">Quiz id</th>
				<th scope="col">Quiz Name</th>
				<th scope="col">Creator</th>
				<th scope="col"></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($details as $row) : ?>
				<tr>
					<th><?= $row->quiz_id ?></th>
					<td><?= $row->title ?></td>
					<td><?= $row->name ?></td>
					<td>
						<a href="<?php echo base_url('challenge/' . $row->quiz_id) ?>" class=" link btn btn-success">Challenge</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>


</body>
<script>
	if (document.querySelector('.js-alert')) {
		document.querySelectorAll('.js-alert').forEach(function ($el) {
			setTimeout(() => {
				$el.classList.remove('show');
			}, 2000);
		});
		// removeAlert div after 2 seconds
		setTimeout(() => {
			document.querySelector('.js-alert').remove();
		}, 2000);
	}
</script>

</html>
