<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->load->model('Quiz_Model/QuizModel');
		$user_id = $this->session->userdata('user_id');
		$data['details'] = $this->QuizModel->get_all_quizzes($user_id);
		$this->load->view('navigation/navbar');
		$this->load->view('home/home_page', $data);
	}

}

