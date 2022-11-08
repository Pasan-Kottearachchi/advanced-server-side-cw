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
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/quizes/participate_quiz.css'; ?>">
</head>
<body>
<div class="container">
	<h1 class="quiz-title"><?php echo $response['quiz_meta_data']->title ?></h1>
	<div class="quiz-form">
		<form id="participate-quiz-form" action="<?php echo base_url('quiz/challenge/submit') ?>" method="post">
			<?php
			foreach ($response['quiz'] as $question) {
				echo "<div class='form-question'>";
				echo "<label class='question-label'>" . $question->description . "</label>";
				foreach ($question->answers as $answer) {
					echo "<div class='form-answer'>";
					echo "<input class='form-answer' type='radio' name='" . $answer->quiz_question_id . "' value='" . $answer->quiz_answer_id . "' required>" . $answer->description . "<br>";
					echo "</div>";
				}
				echo "</div>";

				echo "<br>";
			}
			?>
			<input type="hidden" name="quiz-id" value="<?= $response['quiz_meta_data']->quiz_id ?>">
<!--					<input class="submit-answer-btn btn btn-success" type="submit" value="Submit">-->
		</form>
	</div>
	<button form="participate-quiz-form" class="submit-answer-btn btn btn-success" type="submit" formaction="<?php echo base_url('quiz/challenge/submit') ?>">
		Submit Answers
	</button>

</div>

</body>
</html>
