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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/quizes/manage_quizes.css'; ?>">
</head>
<body>
<div class="container">
	<div class="table-header">
		<div class="screen-name">
			<h5 class="heading">My Quizes</h5>
		</div>
		<div class="add-form">
			<a href="<?= base_url('quiz/new'); ?>" class="btn btn-info my-2 my-sm-0 btn-add-quiz">Add Quiz</a>
		</div>
	</div>
	<div class="table-div">
		<table class="table table-striped" id="my-quiz-table">
			<thead>
			<tr>
				<th scope="col">Quiz Name</th>
				<th scope="col">Quiz Category</th>
				<th scope="col">No of times taken</th>
				<th scope="col">Created By</th>
				<th scope="col"></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($quizes as $quiz) { ?>
				<tr>
					<td><?php echo $quiz->title; ?></td>
					<td><?php echo $quiz->category_name; ?></td>
					<td><?php echo $quiz->attempts; ?></td>
					<td><?php echo $quiz->name; ?></td>
					<!--						<td><a href="-->
					<?php //echo base_url('quiz/delete/' . $quiz->quiz_id); ?><!--"-->
					<!--							   class=" link btn btn-danger">Delete</a></td>-->
					<td>
						<button type="button" value="<?= $quiz->quiz_id . ":" . $quiz->title ?>"
								class="btn btn-danger deletebtn"> DELETE
						</button>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</body>
<script>
	$(document).ready(function () {
		$('#my-quiz-table').DataTable();
	});
</script>
<script>
	$(document).ready(function () {
		$('.deletebtn').click(function (e) {
			e.preventDefault();
			var value = $(this).val();
			var delete_id = value.split(":")[0];
			var delete_title = value.split(":").slice(1).join(":");

			swal({
				title: `Delete Quiz ${delete_title}?`,
				text: "Once deleted, no one would be able to see this quiz!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
				.then((willDelete) => {
					if (willDelete) {
						$.ajax({
							url: `delete/${delete_id}`,
							success: function (response) {
								console.log(response);
								swal({
									title: response.status,
									text: response.message,
									icon: "success",
									buttons: "OK",
								}).then((confirmed) => {
									location.reload()
								})
							}
						});
					} else {
						swal("You have cancelled the deletion!");
					}
				});
		});
	});
</script>
</html>
