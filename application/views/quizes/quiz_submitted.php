<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Quizzy Time</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/quizes/quiz_submitted.css'; ?>">
</head>
<body>
<!--Display Quiz Marks -->
<div class="container">
<!--	Quiz Successfully Submitted Screen -->
	<h1><?php echo $title?></h1>
	<h3>Quiz Successfully Submitted</h3>
	<h5>Your quiz stats can be user <strong>My Quizes</strong> section.</h5>

	<a class="home-label btn btn-success" href="<?php echo base_url('home')?>">Home</a>
</div>
</body>
</html>

</body>
</html>
