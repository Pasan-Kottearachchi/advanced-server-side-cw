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
	<style type="text/css">
		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			line-height: 1.42857143;
			color: #333;
			background-color: #fff;
		}

		container {
			width: 100%;
		}

		form {
			margin: auto;
			width: 800px;
			padding: 1em;
			padding-bottom: 20px;
		}

		.form-question {
			margin: auto;
			width: 100%;
			padding: 1em;
			border: 1px solid #253341;
			border-radius: 1em;
		}


		.question-label {
			font-size: 18px;
			font-weight: 700;
			line-height: 1.1;
			color: inherit;
		}

		.quiz-form {
			width: 100%;
			max-height: 75vh;
			overflow-y: scroll;
		}

		.submit-answer-btn {
			float: right;
			margin-right: 100px;
			/*margin-top: 20px;*/
		}

		.quiz-title {
			text-align: center;
			line-height: 1.1;
			color: inherit;
		}
		input[type="radio"] {
			margin-right: 5px;
			font-weight: 700;
		}

		::-webkit-scrollbar {
			background-color: hsl(235, 24%, 19%);
			width: 8px;
			border-radius: 10px;
		}

		/* Track */
		::-webkit-scrollbar-track {
			background-color: hsla(235, 21%, 11%, 0.322);
			/*box-shadow: 0 0 3px hsl(235, 21%, 11%);*/
			border-radius: 10px;
		}

		/* Handle */
		::-webkit-scrollbar-thumb {
			background-color: hsl(232, 11%, 73%);
			border-radius: 10px;
		}

		/* Handle on hover */
		::-webkit-scrollbar-thumb:hover {
			background: hsl(240, 9%, 68%);
		}

	</style>
</head>
<body>
<div class="container">
	<h1 class="quiz-title"><?php echo $response['quiz_meta_data']->title ?></h1>
	<div class="quiz-form">
		<form id="participate-quiz-form" action="<?php echo base_url('quiz/submit') ?>" method="post">
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
	<button form="participate-quiz-form" class="submit-answer-btn btn btn-success" type="submit" formaction="<?php echo base_url('quiz/submit') ?>">
		Submit Answers
	</button>

</div>

</body>
</html>
