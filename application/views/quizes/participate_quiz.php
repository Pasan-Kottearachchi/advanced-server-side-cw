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
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			font-size: 14px;
			line-height: 1.42857143;
			color: #333;
			background-color: #fff;
		}

		form {
			margin: auto;
			width: 800px;
			padding: 1em;
			border: 1px solid #CCC;
			border-radius: 1em;
		}
		.question-label {
			font-size: 18px;
			font-weight: 700;
			line-height: 1.1;
			color: inherit;
		}
		/*		Make the page a bit more responsive */
		@media (min-width: 768px) {
			.container {
				width: 750px;
			}
		}
		@media (min-width: 992px) {
			.container {
				width: 970px;
			}
		}
		@media (min-width: 1200px) {
			.container {
				width: 1170px;
			}
		}
	</style>
</head>
<body>
<div class="container">
	<h1><?php echo $response['quiz_meta_data']->title?></h1>
	<form  action="<?php echo base_url('quiz/submit')?>" method="post">
		<?php
		foreach ($response['quiz'] as $question) {
			echo "<label class='question-label'>".$question->description."</label>" . "<br>";
			foreach ($question->answers as $answer) {
				echo "<input type='radio' name='" .$answer->quiz_question_id ."' value='" . $answer->quiz_answer_id . "' required>" . $answer->description . "<br>";
			}

			echo "<br><br>";
		}
		?>
		<input type="hidden" name="quiz-id" value="<?= $response['quiz_meta_data']->quiz_id?>">
		<input type="hidden" name="user-id" value="<?=  $this->session->userdata('user_id');?>">
		<input type="submit" value="Submit">
	</form>

</div>

</body>
</html>
