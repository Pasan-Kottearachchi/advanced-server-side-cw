<?php

class ChallengeQuiz extends CI_Controller {
	public function index($id) {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->challengeQuiz($id);
	}

	public function challengeQuiz($id) {
		$this->load->model('Quiz_Model/QuizModel');
		$this->load->model('Quiz_Model/QuizAnswerModel');
		$this->load->model('Quiz_Model/QuizQuestionModel');

		$quiz_meta_data = $this->QuizModel->get_by_id($id);

		$questions = $this->QuizQuestionModel->get_quiz_questions_by_quiz_id($id);
		$quiz_question_ids = array();
		foreach ($questions as $object) {
			array_push($quiz_question_ids, $object->quiz_question_id);
		}
		$question_answers = $this->QuizAnswerModel->get_quiz_ans_by_quiz_questions_ids($quiz_question_ids);


		$response = array();
		$quiz = array();
		foreach ($questions as $object) {
			$quiz[$object->quiz_question_id] = $object;
			$quiz[$object->quiz_question_id]->answers = array();
			foreach ($question_answers as $object2) {
				if ($object2->quiz_question_id === $object->quiz_question_id) {
					array_push($quiz[$object->quiz_question_id]->answers, $object2);
				}
			}

		}

		$response['quiz_meta_data'] = $quiz_meta_data;
		$response['quiz'] = $quiz;


		$this->load->view('navigation/navbar');
		$this->load->view('quizes/participate_quiz', array("response"=>$response));
	}

}
