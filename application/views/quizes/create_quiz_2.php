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
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/quizes/create_quiz_2.css'; ?>">
</head>
<body>
<!--Add quiz name as a heading-->
<div class="container">
	<?php if ($this->session->flashdata('error')) :?>
		<div class="alert alert-danger alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success')) :?>
		<div class="alert alert-success alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
	<div class="quiz-name">
		<h1><?php echo $quiz_name ?></h1>
	</div>
	<div>
		<form id="add-question-form" method="post">
			<div class="question-container">
				<label for="exampleFormControlTextarea1">Question Description</label>
				<textarea name="question" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			</div>
			<div class="answer-container">
				<div class="form-row">
					<div class="col">
						<label for="answer1" class="ans-label">Answer 1</label>
						<input name="answer_1" type="text" class="form-control" placeholder="Answer 1">
					</div>
					<div class="col">
						<label for="answer2" class="ans-label">Answer 2</label>
						<input name="answer_2" type="text" class="form-control" placeholder="Answer 2">
					</div>
				</div>
				<div class="form-row">
					<div class="col">
						<label for="answer3" class="ans-label">Answer 3</label>
						<input name="answer_3" type="text" class="form-control" placeholder="Answer 3">
					</div>
					<div class="col">
						<label for="answer4" class="ans-label">Answer 4</label>
						<input name="answer_4" type="text" class="form-control" placeholder="Answer 4">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="col">
					<label for="correctAnswer" class="ans-label">Correct Answer</label>
					<select class="form-select" name="correct_answer">
						<option value="1">Answer 1</option>
						<option value="2">Answer 2</option>
						<option value="3">Answer 3</option>
						<option value="4">Answer 4</option>
					</select>
				</div>
			</div>
			<input type="hidden" name="quiz_name" value="<?= $quiz_name ?>">
			<input type="hidden" name="quiz_id" value="<?= $quiz_id ?>">
		</form>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button form="add-question-form"
						type="submit"
						class="btn btn-success"
						formaction="<?php echo base_url('quiz/submit') ?>">
					Submit Quiz
				</button>
				<button form="add-question-form"
						type="submit"
						class="btn btn-secondary"
						formaction="<?php echo base_url('quiz/question/submit') ?>">
					Submit Question
				</button>
			</div>
		</div>
	</div>

	</form>
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
