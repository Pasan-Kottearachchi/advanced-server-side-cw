<?php

class SearchQuiz extends CI_Controller {
	public function index() {
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('login'));
		}
		$this->searchQuiz();
	}

	public function searchQuiz() {
		$this->load->model('Quiz_Model/QuizModel');
		$search = $this->input->get('search');
		if ($search === null || $search === "") {
			redirect(base_url('home'));
		} else {
			$data['details'] = $this->QuizModel->search_quiz($search);
		}
		$this->load->view('navigation/navbar');
		$this->load->view('home/home_page', $data);
	}

}
