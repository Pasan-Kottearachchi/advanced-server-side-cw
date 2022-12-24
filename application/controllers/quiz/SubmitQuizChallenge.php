<?php

class SubmitQuizChallenge extends CI_Controller {

	public function index() {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url().'login');
		}
		$this->SubmitQuizChallenge();
	}

	public function SubmitQuizChallenge() {
		$this->load->model('Quiz_Model/QuizModel');
		$this->load->model('Quiz_Model/QuizAnswerModel');
		$this->load->model('Quiz_Model/QuizStatModel');
		$this->load->model('Quiz_Model/QuizAttemptModel');
		$formValues = $this->input->post('quizData');

//		access quiz_id key in form values
		$quiz_id = $formValues['quiz-id'];
		$user_id = $this->session->userdata('user_id');;

//		removing quiz_id from the array
		unset($formValues['quiz-id']);


		$quizAttemptId = $this->QuizAttemptModel->insert_quiz_attempt(intval($quiz_id), intval($user_id));
		$quizAnswers = $this->QuizAnswerModel->get_quiz_answers_by_quiz_id($quiz_id);

		foreach ($formValues as $key => $value) {
			$submittedQuestionId = intval($key);
			$submittedAnswerId = intval($value);

			$this->QuizStatModel->insert_attempt_question(array(
				"quiz_attempt_id" => $quizAttemptId,
				"quiz_question_id" => $submittedQuestionId,
				"quiz_answer_id" => $submittedAnswerId
			));

		}
		$this->addQuizStats($quiz_id);

		$response = array();
		$response['quiz_id'] = $quiz_id;
		$response['quiz_attempt_id'] = $quizAttemptId;

		$successResponse = array(
			"status" => "success",
			"data" => $response
		);

		return $this->output->set_content_type('application/json')->set_output(json_encode($successResponse));
	}

	function addQuizStats($quiz_id) {
		$this->load->model('Quiz_Model/QuizStatModel');
		$records = $this->QuizStatModel->get_quiz_correctly_answered_percentage($quiz_id);
		$correctlyAnswered = 0;
		$totalQuestions = 0;
		foreach ($records as $record) {
			$correctlyAnswered = $correctlyAnswered + intval($record->correctly_answered) ;
			$totalQuestions = $totalQuestions + intval($record->total_questions);
		}
		$this->QuizStatModel->insert_quiz_stats($quiz_id, $correctlyAnswered, $totalQuestions);
	}

}
