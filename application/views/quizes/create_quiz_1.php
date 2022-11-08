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
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/quizes/create_quiz_1.css'; ?>">
</head>
<body>
<!--Display Quiz Marks -->
<div class="container">
	<form id="create-quiz-form" action="<?php echo base_url('quiz/meta/submit') ?>" method="post">
		<div class="form-group">
			<label class="control-label col-sm-3" for="quiz_title_label">Quiz Title:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="quiz_title" placeholder="Enter Quiz Title">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="quiz_category_label">Quiz Category:</label>
			<div class="col-sm-10">
				<select class="form-control" name="quiz_category">
					<option value="default">Select Category</option>
					<?php foreach ($quiz_categories as $category) { ?>
						<option value="<?php echo $category->quiz_category_id; ?>"><?php echo $category->category_name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
	</form>

</div>


</body>
</html>
