<?php

class CreateQuiz extends CI_Controller
{
	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->createQuiz();
	}

	public function createQuiz(){
		$this->load->model('Quiz_Model/QuizModel');
		$this->load->model('Quiz_Model/QuizCategoryModel');

		$quiz_categories = $this->QuizCategoryModel->get_quiz_categories();
		$this->load->view('navigation/navbar');
		$this->load->view('quizes/create_quiz_1', array('quiz_categories' => $quiz_categories));
	}

	public function create_quiz_meta_data(){
		$this->load->model('Quiz_Model/QuizModel');
		$user_id = $this->session->userdata('user_id');

		$quiz_name = $this->input->post('quiz_title');
		$quiz_category = $this->input->post('quiz_category');

		$quiz_id = $this->QuizModel->insert_quiz_metadata($quiz_name, $quiz_category, $user_id);
		$quiz_data = $this->QuizModel->get_by_id($quiz_id);

		$this->load->view('navigation/navbar');
		$this->load->view('quizes/create_quiz_2', array('quiz_name' => $quiz_data->title, 'quiz_id' => $quiz_data->quiz_id));


	}

	public function create_quiz_question_and_answers(){
//		Get data from for post method
		$quiz_name = $this->input->post('quiz_name');
		$quiz_id = $this->input->post('quiz_id');
		$question = $this->input->post('question');
		$answer_1 = $this->input->post('answer_1');
		$answer_2 = $this->input->post('answer_2');
		$answer_3 = $this->input->post('answer_3');
		$answer_4 = $this->input->post('answer_4');
		$correct_answer = $this->input->post('correct_answer');

//		Load model
		$this->load->model('Quiz_Model/QuizQuestionModel');
		$last_question_order = $this->QuizQuestionModel->get_quiz_question_order_by_quiz_id($quiz_id);
//		If there are no questions in the quiz, set the question order to 1
		if (empty($last_question_order)) {
			$question_order = 1;
		} else {
//			If there are questions in the quiz, set the question order to the last question order + 1
			$question_order = $last_question_order[0]->question_order + 1;
		}

//		Insert quiz question
		$quiz_question_id = $this->QuizQuestionModel->insert_quiz_question($quiz_id, $question, $question_order);

// Insert quiz question by passing is_correct = true if answer_id = correct answer
		$this->QuizQuestionModel->insert_quiz_question_answer($quiz_question_id, $answer_1, $correct_answer == 1);
		$this->QuizQuestionModel->insert_quiz_question_answer($quiz_question_id, $answer_2, $correct_answer == 2);
		$this->QuizQuestionModel->insert_quiz_question_answer($quiz_question_id, $answer_3, $correct_answer == 3);
		$this->QuizQuestionModel->insert_quiz_question_answer($quiz_question_id, $answer_4, $correct_answer == 4);


		$this->load->view('navigation/navbar');
		$this->load->view('quizes/create_quiz_2', array('quiz_name' => $quiz_name, 'quiz_id' => $quiz_id));
	}

	public function submit_quiz(){
		$quiz_id = $this->input->post('quiz_id');
		$quiz_name = $this->input->post('quiz_name');
		$this->load->model('Quiz_Model/QuizQuestionModel');
		$this->load->model('Quiz_Model/QuizModel');

		$quiz_question_count = $this->QuizQuestionModel->get_quiz_question_count_by_quiz_id($quiz_id);
		if (intval($quiz_question_count->count) < 3) {
			$this->session->set_flashdata('error', 'Quiz must have at least 3 questions');
			$this->load->view('navigation/navbar');
			$this->load->view('quizes/create_quiz_2', array('quiz_name' => $quiz_name, 'quiz_id' => $quiz_id));
		}

		$quiz = $this->QuizModel->get_by_id($quiz_id);
		if ($quiz->archived != 0) {
			$this->QuizModel->update_quiz_status($quiz_id, 0);
//		load navbar
		}
		$this->load->view('navigation/navbar');
		$this->load->view('quizes/quiz_submitted', array('title' => $quiz_name));;
	}

}
