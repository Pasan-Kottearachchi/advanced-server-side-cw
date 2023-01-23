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
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
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
			<h1 class="heading">All Quizzes</h1>
		</div>
	</div>
	<div class="table-div">
		<table id="all-quizes-table" class="table table-sm table-striped">
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
						<a href="<?php echo base_url('challenge/' . $row->quiz_id) ?>" class=" link btn btn-sm btn-success">Challenge</a>
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
<script>
	$(document).ready(function () {
		$('#all-quizes-table').DataTable();
	});
</script>
</html>
