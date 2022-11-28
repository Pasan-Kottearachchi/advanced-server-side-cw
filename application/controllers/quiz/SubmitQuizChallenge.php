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
		$formValues = $this->input->post();
		$correctAnswers = 0;
//		access quiz_id key in form values
		$quiz_id = $formValues['quiz-id'];
		$user_id = $this->session->userdata('user_id');;

//		removing quiz_id from the array
		unset($formValues['quiz-id']);

		$totalAnswers = count($formValues);


		$quizAttemptId = $this->QuizAttemptModel->insert_quiz_attempt(intval($quiz_id), intval($user_id));
		$quizAnswers = $this->QuizAnswerModel->get_quiz_answers_by_quiz_id($quiz_id);
		$quizMetaData = $this->QuizModel->get_by_id($quiz_id);

		foreach ($formValues as $key => $value) {
			$submittedQuestionId = intval($key);
			$submittedAnswerId = intval($value);
//			Check if answer is correct
			foreach ($quizAnswers as $quizAnswer) {
				if (intval($quizAnswer->quiz_question_id) === intval($submittedQuestionId) &&
					intval($quizAnswer->quiz_answer_id) === intval($submittedAnswerId)
				) {
					if (intval($quizAnswer->is_correct) === 1) {
						$correctAnswers++;
					}
				}
			}
			$this->QuizStatModel->insert_attempt_question(array(
				"quiz_attempt_id" => $quizAttemptId,
				"quiz_question_id" => intval($key),
				"quiz_answer_id" => intval($value)
			));

		}
		$this->addQuizStats($quiz_id);

		$response = array();
		$response['correct_answers'] = $correctAnswers;
		$response['total_questions'] = $totalAnswers;
		$response['quiz_meta_data'] = $quizMetaData;

		$this->load->view('quizes/quiz_result', array("response"=>$response));

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
