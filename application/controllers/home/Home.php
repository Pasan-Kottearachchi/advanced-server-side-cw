<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index() {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->load->model('Quiz_Model/QuizModel');
		$data['details'] = $this->QuizModel->get_all_quizzes();
		$this->load->view('navigation/navbar');
		$this->load->view('home/home_page', $data);
	}

}

