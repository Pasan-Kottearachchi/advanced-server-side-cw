<?php

use Restserver\Libraries\REST_Controller;

require_once APPPATH . 'libraries\REST_Controller.php';
require_once APPPATH . 'libraries\Format.php';

class QuizMetaData extends REST_Controller
{
	public function index_get()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->createQuiz();
	}

	public function index_post()
	{
		$this->create_quiz_meta_data();
	}

	public function createQuiz()
	{
		$this->load->model('Quiz_Model/QuizModel');
		$this->load->model('Quiz_Model/QuizCategoryModel');

		$quiz_categories = $this->QuizCategoryModel->get_quiz_categories();
		$this->load->view('navigation/navbar');
		$this->load->view('quizes/create_quiz_1', array('quiz_categories' => $quiz_categories));
	}

	public function create_quiz_meta_data()
	{
		$this->load->model('Quiz_Model/QuizModel');
		$user_id = $this->session->userdata('user_id');

		$quiz_name = $this->post('quiz_title');
		$quiz_category = $this->post('quiz_category');

		$quiz_id = $this->QuizModel->insert_quiz_metadata($quiz_name, $quiz_category, $user_id);
		$data = array('quiz_id' => $quiz_id);
		echo json_encode($data);

		//		return the quiz id to the client
		// $this->response($data, REST_Controller::HTTP_OK);



		//		echo json_encode($data);

		//		return json_encode($data);
	}
}
