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
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/quizes/quiz_result.css'; ?>">
</head>
<body>
<!--Display Quiz Marks -->
<div class="container">
	<h1><?php echo $response['quiz_meta_data']->title?></h1>
	<h3>Number of Correct Answers: <?php echo $response['correct_answers']?></h3>
	<h3>Total Number of Questions: <?php echo $response['total_questions']?></h3>
	<a class="retake-quiz-label btn btn-secondary" href="<?php echo base_url('challenge/'.$response['quiz_meta_data']->quiz_id)?>">Retake Quiz</a>
	<a class="home-label btn btn-success" href="<?php echo base_url('home')?>">Home</a>
</div>
</body>
</html>

</body>
</html>
