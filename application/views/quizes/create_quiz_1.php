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
<div class="table-header">
	<div class="screen-name">
		<h1 class="heading">Create New Quiz</h1>
	</div>
</div>
<div class="table-div">
	<form id="create-quiz-form">
		<div class="form-group">
			<label class="control-label col-sm-3" for="quiz_title_label">Quiz Title:</label>
			<input type="text" class="form-control" id="quiz_title" name="quiz_title" placeholder="Enter Quiz Title">
		</div>
		<div class="form-group">
			<label class="control-label col-sm-3" for="quiz_category_label">Quiz Category:</label>
			<select class="form-control" name="quiz_category" id="quiz_category">
				<option value="default">Select Category</option>
				<?php foreach ($quiz_categories as $category) { ?>
					<option value="<?php echo $category->quiz_category_id; ?>"><?php echo $category->category_name; ?></option>
				<?php } ?>
			</select>
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

		var CreateQuizOneModel = Backbone.Model.extend({
			url: function() {
				var urlstr =
					"<?php echo base_url(); ?>quiz/meta/submit";
				return urlstr;
			}
		});

		var createQuizOneModelInstance = new CreateQuizOneModel();

		var CreateQuizIndexView = Backbone.View.extend({
			el: $('#create-quiz-form'), // connect view to page area
			events: {
				"click #createQuizIndexButton": "createQuizIndexAction"
			},
			createQuizIndexAction: function() {
				var quiz_title = document.getElementById('quiz_title').value;
				const quizCategorySelectElement = document.querySelector('#quiz_category');
				const quiz_category = quizCategorySelectElement.value;

				var createQuizOneModelInstance = new CreateQuizOneModel({
					quiz_title: quiz_title,
					quiz_category: quiz_category
				})
				createQuizOneModelInstance.save();

				this.listenTo(createQuizOneModelInstance, 'error', function(collection, resp, options) {
					console.log('Error: ', resp);
				});
				this.listenTo(createQuizOneModelInstance, 'sync', function(collection, resp, options) {
					console.log('Sync: ', resp.quiz_id);
					//send the quiz id to the create quiz view with the URL
					window.location.href = `new/${resp.quiz_id}`;
				});
				// createQuizIndexModelInstance.fetch({
				// 	async: false,
				// 	contentType: 'application/json',
				// 	dataType: 'text',
				// 	success: function(model, response, xhr) {
				// 		console.log("Success");
				// 		var jsonStringifyResponse = JSON.stringify(response)
				// 		var responseResult = JSON.parse(jsonStringifyResponse);
				// 		console.log('model saved', response, xhr);

				// 		// window.location.href = `quiz/new/${responseResult.quiz_id}`;
				// 	},
				// 	error: function(response) {
				// 		console.log(response)

				// 	}
				// });

			}

		});

		var createQuizIndexView = new CreateQuizIndexView();
	});
</script>

</html>
