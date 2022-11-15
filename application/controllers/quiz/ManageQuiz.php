<?php

class ManageQuiz extends CI_Controller
{
	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->manageQuiz();
	}

	public function manageQuiz(){
		$this->load->model('Quiz_Model/QuizModel');
		$user_id = $this->session->userdata('user_id');
		$quizes = $this->QuizModel->get_quizes_by_user_id($user_id);
		$this->load->view('navigation/navbar');
		$this->load->view('quizes/manage_quiz', array('quizes' => $quizes));
	}

	public function delete_quiz($quiz_id){
		$this->load->model('Quiz_Model/QuizModel');
		$this->QuizModel->update_quiz_status(intval($quiz_id), 1);
//		redirect(base_url('manage_quiz'));
//		send successful response
		$data = array(
			'status' => 'Quiz Deleted Successfully',
			'message' => 'Your Quiz has been deleted successfully'
		);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));


	}
}
