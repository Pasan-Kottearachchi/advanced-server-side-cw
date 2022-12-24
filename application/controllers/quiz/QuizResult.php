<?php

class QuizResult extends CI_Controller {
	public function index($quizId, $quizAttemptId) {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url().'login');
		}
		$this->showQuizResult($quizId, $quizAttemptId);
	}

	public function showQuizResult($quizId, $quizAttemptId) {
		$this->load->model('Quiz_Model/QuizAnswerModel');
		$this->load->model('Quiz_Model/QuizModel');
		$quiz_results = $this->QuizAnswerModel->get_quiz_results_by_quiz_attempt_id($quizAttemptId);
		$quizMetaData = $this->QuizModel->get_by_id($quizId);

		$correct_answers = 0;
		$wrong_answers = 0;
		foreach ($quiz_results as $object) {
			if ($object->is_correct) {
				$correct_answers++;
			} else {
				$wrong_answers++;
			}
		}

		$response = array();
		$response['correct_answers'] = $correct_answers;
		$response['total_questions'] = $correct_answers + $wrong_answers;
		$response['quiz_meta_data'] = $quizMetaData;

		$this->load->view('quizes/quiz_result', array("response"=>$response));

	}
}
