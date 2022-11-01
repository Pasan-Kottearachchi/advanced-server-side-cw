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
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
		  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);

		/*  Helper Styles */
		body {
			/*background: #587792;*/
			font-family: "Roboto", sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}

		a {
			text-decoration: none;
			font-family: FontAwesome, "Roboto", sans-serif;
			text-align: center;
			font-weight: bold;
			letter-spacing: 1px;
			/*font-style: normal;*/
		}

		.container {
			margin-top: 10%;
			margin-left: 20vw;
		}

		/* Card Styles */

		.card-sl {
			border-radius: 8px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			overflow: hidden;
			position: relative;
			width: 100%;
		}

		.card-image img {
			max-height: 100%;
			max-width: 100%;
			border-radius: 8px 8px 0px 0;
		}

		.card-heading {
			font-size: 18px;
			font-weight: bold;
			background: #ADA8B6;
			padding: 10px 15px;
		}

		.card-text {
			padding: 10px 15px;
			background: #ADA8B6;
			font-size: 14px;
			color: #0C1618;
			min-height: 5rem;
		}

		.card-button {
			display: flex;
			justify-content: center;
			padding: 10px 0;
			width: 100%;
			background-color: #1F487E;
			color: #fff;
			border-radius: 0 0 8px 8px;
		}

		.card-button:hover {
			text-decoration: none;
			background-color: #1D3461;
			color: #fff;

		}

		@-webkit-keyframes pulse {
			0% {
				-moz-transform: scale(0.9);
				-ms-transform: scale(0.9);
				-webkit-transform: scale(0.9);
				transform: scale(0.9);
			}

			70% {
				-moz-transform: scale(1);
				-ms-transform: scale(1);
				-webkit-transform: scale(1);
				transform: scale(1);
				box-shadow: 0 0 0 50px rgba(90, 153, 212, 0);
			}

			100% {
				-moz-transform: scale(0.9);
				-ms-transform: scale(0.9);
				-webkit-transform: scale(0.9);
				transform: scale(0.9);
				box-shadow: 0 0 0 0 rgba(90, 153, 212, 0);
			}
		}
	</style>
</head>
<body>
<div>
	<?php if ($this->session->flashdata('success')) :?>
		<div class="alert alert-success alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
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
				<td><?= $row->title?></td>
				<td><?= $row->name?></td>
				<td>
					<a href="<?php echo base_url('challenge/'.$row->quiz_id) ?>" class="btn btn-success">Challenge</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>


</body>
<script>
	if (document.querySelector('.js-alert')) {
		document.querySelectorAll('.js-alert').forEach(function($el) {
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
