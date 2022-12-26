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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min.js"></script>
</head>
<body>
<!--Display Quiz Marks -->
<div class="container">
	<form id="create-quiz-form">
		<div class="form-group">
			<label class="control-label col-sm-3" for="quiz_title_label">Quiz Title:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="quiz_title" name="quiz_title" placeholder="Enter Quiz Title">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="quiz_category_label">Quiz Category:</label>
			<div class="col-sm-10">
				<select class="form-control" name="quiz_category" id="quiz_category">
					<option value="default">Select Category</option>
					<?php foreach ($quiz_categories as $category) { ?>
						<option value="<?php echo $category->quiz_category_id; ?>"><?php echo $category->category_name; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" class="btn btn-success" id="createQuizIndexButton">Submit</button>
			</div>
		</div>
	</form>

</div>


</body>
<script>
	$(document).ready(function() {

		var CreateQuizIndexModel = Backbone.Model.extend({
			url: function() {
				var urlstr =
					"<?php echo base_url(); ?>quiz/meta/submit";
				return urlstr;
			}
		});

		var createQuizIndexModelInstance = new CreateQuizIndexModel();

		var CreateQuizIndexView = Backbone.View.extend({
			el: $('#create-quiz-form'), // connect view to page area
			events: {
				"click #createQuizIndexButton": "createQuizIndexAction"
			},
			createQuizIndexAction: function() {
				var quiz_title = document.getElementById('quiz_title').value;
				const quizCategorySelectElement = document.querySelector('#quiz_category');
				const quiz_category = quizCategorySelectElement.value;

				var createQuizIndexModelInstance = new CreateQuizIndexModel({
					quiz_title: quiz_title,
					quiz_category: quiz_category
				})
				createQuizIndexModelInstance.save();
				createQuizIndexModelInstance.fetch({
					async: false,
					contentType: 'application/json',
					dataType: 'json',
					success: function(response) {
						console.log("Success");
						var jsonStringifyResponse = JSON.stringify(response)
						var responseResult = JSON.parse(jsonStringifyResponse);
						console.log('responseResult', responseResult);


						// window.location.href = `quiz/new/${responseResult.quiz_id}`;
					},
					error: function(response) {
						console.log(response)

					}
				});

			}

		});

		var createQuizIndexView = new CreateQuizIndexView();
	});
</script>
</html>
