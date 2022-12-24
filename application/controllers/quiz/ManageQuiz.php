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
		$data = array();
		foreach ($quizes as $quiz) {
			if ($quiz->total_answers != 0) {
				$correct_answer_percentage = $quiz->correct_answers / $quiz->total_answers * 100;
			} else {
				$correct_answer_percentage = 0;
			}
			$correct_answer_percentage = round($correct_answer_percentage, 2);
			$quiz->correct_answer_percentage = $correct_answer_percentage;
			$data[] = $quiz;
		}
		$this->load->view('navigation/navbar');
		$this->load->view('quizes/manage_quiz', array('quizes' => $quizes));
	}

	public function delete_quiz($quiz_id){
		$this->load->model('Quiz_Model/QuizModel');
		$this->QuizModel->update_quiz_status(intval($quiz_id), 1);

//		sending the successful response
		$data = array(
			'status' => 'success',
			'data' => array(
			'title' => "Poof! Your quiz has been deleted!",
			'message' => 'Your Quiz has been deleted successfully'
			)
		);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));


	}
}
