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
	<div class="table-header">
		<div class="screen-name">
			<h1 class="heading">My Quizzes</h1>
			<div class="add-form">
				<a href="<?= base_url('quiz/new'); ?>" class="btn btn-info btn-add-quiz">Add New Quiz</a>
			</div>
		</div>
	</div>
	<div class="table-div">
		<table class="table table-striped" id="my-quiz-table">
			<thead>
			<tr>
				<th scope="col">Quiz Name</th>
				<th scope="col">Quiz Category</th>
				<th scope="col">No of times taken</th>
				<th scope="col">Correctly Answered Percentage</th>
				<th scope="col"></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($quizes as $quiz) { ?>
				<tr>
					<td><?php echo $quiz->title; ?></td>
					<td><?php echo $quiz->category_name; ?></td>
					<td><?php echo $quiz->attempts; ?></td>
					<td>
						<div class="progress">
							<div
									class="progress-bar progress-bar-striped bg-info"
									role="progressbar"
									style="width: <?php echo $quiz->correct_answer_percentage.'%'?>"
									aria-valuemin="0"
									aria-valuemax="200">
								<?php if ($quiz->correct_answer_percentage > 0) { ?>
									<?php echo $quiz->correct_answer_percentage. '%'; ?>
								<?php } ?>

							</div>
						</div>
					</td>
					<td class="action-td">
						<button type="button" class="btn btn-danger btn-sm action-btn" value="<?= $quiz->quiz_id . ":" . $quiz->title ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 20 20">
								<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
							</svg> Delete
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
	// table = $('#my-quiz-table').DataTable();

	// Event listener for DT 1.10+
	$("#my-quiz-table tbody").delegate("button", 'click', function () {
		var value = $(this).val();
		var delete_id = value.split(":")[0];
		var delete_title = value.split(":").slice(1).join(":");

		swal({
			title: `Delete Quiz ${delete_title}?`,
			text: "Once deleted, no one would be able to see this quiz!",
			buttons: true,
			dangerMode: true,
		})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url: `delete/${delete_id}`,
						type: 'DELETE',
						dataType: 'json',
					success: function (response) {
							data = response.data
							swal({
								title: data.title,
								text: data.message,
								icon: "success",
								buttons: "OK",
							}).then((confirmed) => {
								location.reload()
							})
						}
					});
				}
			});
	});
</script>
</html>
